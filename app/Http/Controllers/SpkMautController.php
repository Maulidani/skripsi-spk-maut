<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Bantuans;
use App\Models\CategoryKwbs;
use App\Models\Kwbs;
use App\Models\Results;
use App\Models\Users;
use App\Models\Kriterias;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use PDF;

class SpkMautController extends Controller
{

    public function indexCriteria()
    {
        $result = Kriterias::get();
            
        return view('dashboard.data.kriteria.data-kriteria', [
            'result' => $result,
        ]);
    }

    public function editCriteria(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'id' => 'required',
            'bobot' => 'required',
        ]);

        $model = Kriterias::find($request->id);
        $model->bobot = $request->bobot;
        $model->save();

        if($model) {
            return redirect()->back()->with('message-add-kwb', 'Sukses edit KWB');

        } else {
            return redirect()->back()->with('message-add-kwb', 'terjadi kesalahan');
        }

    }

    public function index()
    {
        $result = Results::join('bantuans', 'bantuans.id', 'results.bantuan_id')
            ->join('kwbs', 'kwbs.id', 'results.kwb_id')
            ->select('results.rank', 'results.bantuan_id', 'results.version', 'results.created_at','bantuans.name as name_bantuan', 'kwbs.name as name_kwb')
            ->orderBy('results.created_at', 'desc')->get()->unique('version');
            
        return view('dashboard.spk.maut.result.result-maut', [
            'result' => $result,
        ]);
    }

    public function resultDetail(Request $request)
    {
        
        $versionId = $request->version_id;
        $result = Results::join('bantuans', 'bantuans.id', 'results.bantuan_id')
            ->join('kwbs', 'kwbs.id', 'results.kwb_id')
            ->where('results.version', $versionId)
            ->select('results.rank', 'results.score', 'kwbs.name' )
            ->orderBy('results.rank', 'asc')->get();

        return view('dashboard.spk.maut.result.result-maut-detail', [
            'result' => $result,
        ]);
    }

    public function kwb(Request $request)
    {

        $unChecked = Kwbs::get();

        foreach ($unChecked as $i) {
            $unChecked = Kwbs::find($i->id);
            $unChecked->checked = 0;
            $unChecked->save();
        }

        if($unChecked) {

            $getCategoryId = Bantuans::where('id',$request->bantuan_id)->first();   
            // dd($getCategoryId->category_id);  

            if($getCategoryId->category_id == 1) {

                $kwb = Kwbs::join('category_kwbs','category_kwbs.id', 'kwbs.category_id')
                ->join('bantuans', 'bantuans.category_id', 'kwbs.category_id')
                // ->where('bantuans.id', $request->bantuan_id)
                ->select('kwbs.*', 'bantuans.detail as bantuan_detail' , 'category_kwbs.name as category_name')
                ->orderBy('kwbs.created_at', 'desc')->get();

            // dd($kwb);  

                return view('dashboard.spk.maut.add.add-maut', [
                    'kwb' => $kwb,
                    'bantuan' => 1,
                ]);

            } else {

                $kwb = Kwbs::join('category_kwbs','category_kwbs.id', 'kwbs.category_id')
                    ->join('bantuans', 'bantuans.category_id', 'kwbs.category_id')
                    ->where('bantuans.id', $request->bantuan_id)
                    // ->where('kwbs.id', $getCategoryId->category_id )
                    ->select('kwbs.*', 'bantuans.detail as bantuan_detail' , 'category_kwbs.name as category_name')
                    ->orderBy('kwbs.created_at', 'desc')->get();

            // dd($kwb);  

                return view('dashboard.spk.maut.add.add-maut', [
                    'kwb' => $kwb,
                    'bantuan' => $request->bantuan_id,
                ]);
                
            }

        } else {
            return redirect()->back()->with('message-select-bantuan', 'Tidak ada kwb yang sesuai');

        }
    }

    public function selectBantuan(Request $request)
    {
        $bantuan = Bantuans::get();

        return view('dashboard.spk.maut.add.select-bantuan', [
            'bantuan' => $bantuan
        ]);
    }


    public function checkedKwb(Request $request)
    {

        $model;

        if(
            $request->kwb_id == null ||
            $request->bantuan == null ||
            $request->secretariat == null ||
            $request->structural == null ||
            $request->skill == null
        ) {
            return redirect()->back()->with('message-error-checked', 'Lengkapi data yang dicentang');
        } else {

            if(
                count($request->kwb_id) > count($request->bantuan) ||
                count($request->kwb_id) > count($request->secretariat) ||
                count($request->kwb_id) > count($request->structural) ||
                count($request->kwb_id) > count($request->skill)
            ) {
                return redirect()->back()->with('message-error-checked', 'Lengkapi data yang dicentang');
            } else {

                $model = Kwbs::get();

                foreach ($model as $i) {
                    $model = Kwbs::find($i->id);
                    $model->checked = 0;
                    $model->save();
                }

                if ($model) {

                    // dd($request->all());

                    $result = [];
                    $kwb_id = $request->kwb_id;
                    $bantuan = $request->bantuan;
                    $secretariat = $request->secretariat;
                    $structural = $request->structural;
                    $skill = $request->skill;

                    foreach ($kwb_id as $index => $id) {
                        $filteredBantuan = null;
                        $filteredSecretariat = null;
                        $filteredStructural = null;
                        $filteredSkill = null;

                        foreach ($bantuan as $value) {
                            $elements = explode(', ', $value);
                            if ($elements[1] == $id) {
                                $filteredBantuan = $elements[0];
                                break;
                            }
                        }

                        foreach ($secretariat as $value) {
                            $elements = explode(', ', $value);
                            if ($elements[1] == $id) {
                                $filteredSecretariat = $elements[0];
                                break;
                            }
                        }

                        foreach ($structural as $value) {
                            $elements = explode(', ', $value);
                            if ($elements[1] == $id) {
                                $filteredStructural = $elements[0];
                                break;
                            }
                        }

                        foreach ($skill as $value) {
                            $elements = explode(', ', $value);
                            if ($elements[1] == $id) {
                                $filteredSkill = $elements[0];
                                break;
                            }
                        }

                        $result[] = [
                            'kwb_id' => $id,
                            'criteria' => [
                                'Bantuan' => $filteredBantuan,
                                'Secretariat' => $filteredSecretariat,
                                'Structural' => $filteredStructural,
                                'Skill' => $filteredSkill,
                            ],
                        ];
                    }

                    // Printing the result
                    // dd($result);


                    $weightsData = Kriterias::get();

                    // Initialize an empty array to store the structured data
                    $weights = [];

                    // Iterate through the retrieved data and structure it as an associative array
                    foreach ($weightsData as $weight) {
                        $weights[$weight->name] = $weight->bobot;
                    }

                    // $weights = [
                    //     'bantuan' => 3,
                    //     'secretariat' => 7,
                    //     'structural' => 5,
                    //     'skill' => 9,
                    // ];

                    $resultData = $this->calculateRanking($result, $weights);
                    $ranking = $resultData['ranking'];
                    $rankedKwbs = $resultData['rankedKwbs'];
                      
                    $randomText = Str::random(10); // Generate a random string of length 10
                    $timestamp = time(); // Get the current timestamp
                    // Combine the random text and timestamp
                    $uniqueText = $randomText . '_' . $timestamp;
                    
                    foreach ($ranking as $rank => $kwb_id) {
                        // echo "Rank $rank: Kwb $kwb_id\n";
                        // echo "";
                        // dd("Rank $rank: Kwb $kwb_id\n") ;

                        // $score = $rankedKwbs[$kwb_id]; // Get the score for the current Kwb ID
                        // echo "Rank $rank: Kwb $kwb_id (Score: $score)\n";
                
                        $add_result = new Results;
                        $add_result->bantuan_id = $request->bantuan_id;
                        $add_result->kwb_id = $kwb_id['shopId'];
                        $add_result->score = $kwb_id['score'];
                        $add_result->rank = $rank;
                        $add_result->version = $uniqueText;
                        $add_result->save();
                    }

                    return view('dashboard.spk.maut.add.add-maut-result', [
                        'ranking' => $ranking,
                        'rankedKwbs' => $rankedKwbs,
                    ]);

                } else {
                    return redirect()->back()->with('message-error-checked', 'Lengkapi data yang dicentang');

                }

            }

            // foreach ($request->kwb_id as $i) {
            //     $model = Kwbs::find($i);
            //     $model->checked = 1;
            //     $model->save();
            // }
        }

        // if($model) {
        //     $count = Kwbs::where('checked', 1)
        //     ->get();

        //     if($count) {
        //         return redirect()->back()->with('message-add-checked', count($count));

        //     } else {
        //         return redirect()->back()->with('message-add-checked', 'terjadi kesalahan');

        //     }

        // } else {
        //     return redirect()->back()->with('message-add-checked', 'terjadi kesalahan');
        // }



    }

    public function processSpkMaut(Request $request)
    {

        // proses maut

        // get bantuan
        // get checked


        // unchecked
        $model = Kwbs::get();

        foreach ($model as $i) {
            $model = Kwbs::find($i->id);
            $model->checked = 0;
            $model->save();
        }

        if($model) {
            return redirect()->back()->with('message-add-spk-maut', '');

        } else {
            return redirect()->back()->with('message-add-spk-maut', 'terjadi kesalahan');
        }

    }

    /**
     * Calculate the ranking of shops based on criteria and their values.
     *
     * @param array $shops       The array of shop data.
     *                           Each shop should have an 'id' and 'criteria' sub-array.
     *                           'criteria' sub-array should contain the criterion name as key and the criterion value as value.
     * @param array $weights     The array of weights assigned to each criterion.
     *                           Each weight should correspond to the criterion name in the same order.
     * @return array             The ranked array of shops based on their calculated scores.
     */

    // public function calculateRanking(array $shops, array $weights)
    // {
    //     $rankedKwbs = [];

    //     // Calculate scores for each shop
    //     foreach ($shops as $shop) {
    //         $shopId = $shop['kwb_id'];
    //         $criteria = $shop['criteria'];

    //         $score = 0;
    //         foreach ($criteria as $criterion => $value) {
    //             $criterionWeight = $weights[$criterion] ?? 0;
    //             $score += $value * $criterionWeight;
    //         }

    //         $rankedKwbs[$shopId] = $score;
    //     }

    //     // Sort the shops by scores in descending order
    //     arsort($rankedKwbs);

    //     // Reassign ranks to the shops
    //     $ranking = [];
    //     $rank = 1;
    //     foreach ($rankedKwbs as $shopId => $score) {
    //         $ranking[$rank] = $shopId;
    //         $rank++;
    //     }

    //     return ['ranking' => $ranking, 'rankedKwbs' => $rankedKwbs];
    // }


// public function calculateRanking(array $shops, array $weights)
// {
//     $rankedKwbs = [];

//     // Calculate scores for each shop
//     foreach ($shops as $shop) {
//         $shopId = $shop['kwb_id'];
//         $criteria = $shop['criteria'];

//         $score = 0;
//         foreach ($criteria as $criterion => $value) {
//             $criterionWeight = $weights[$criterion] ?? 0;
//             $score += $value * $criterionWeight;
//         }

//         $rankedKwbs[$shopId] = $score;
//     }

//     // Sort the shops by scores in descending order
//     arsort($rankedKwbs);

//     // Reassign ranks to the shops
//     $ranking = [];
//     $rank = 1;
//     foreach ($rankedKwbs as $shopId => $score) {
//         $shop = Kwbs::find($shopId); // Retrieve the shop using Eloquent
//         $shopName = $shop ? $shop->name : 'Unknown'; // Access the name attribute from the Shop model

//         $ranking[$rank] = ['shopId' => $shopId, 'shopName' => $shopName, 'score' => $score];
//         $rank++;
//     }

//     return ['ranking' => $ranking, 'rankedKwbs' => $rankedKwbs];
// }

    public function calculateRanking(array $shops, array $weights)
    {
        $rankedKwbs = [];

        // Find the minimum and maximum values for each criterion
        $minValues = array_fill_keys(array_keys($weights), INF);
        $maxValues = array_fill_keys(array_keys($weights), -INF);

        foreach ($shops as $shop) {
            $criteria = $shop['criteria'];

            foreach ($criteria as $criterion => $value) {
                $minValues[$criterion] = min($minValues[$criterion], $value);
                $maxValues[$criterion] = max($maxValues[$criterion], $value);
            }
        }

        // Calculate scores for each shop
        foreach ($shops as $shop) {
            $shopId = $shop['kwb_id'];
            $criteria = $shop['criteria'];

            $score = 0;
            foreach ($criteria as $criterion => $value) {
                $criterionWeight = $weights[$criterion] ?? 0;

                // Skip the calculation if the weight is zero
                if ($criterionWeight === 0) {
                    continue;
                }

                // Normalize the criterion value between 0 and 1
                $normalizedValue = ($value - $minValues[$criterion]) / ($maxValues[$criterion] - $minValues[$criterion]);

                // Calculate the score by multiplying the normalized value with the criterion weight
                $score += $normalizedValue * $criterionWeight;

            }

            $rankedKwbs[$shopId] = $score;
        }

        // Sort the shops by scores in descending order
        arsort($rankedKwbs);

        // Reassign ranks to the shops
        $ranking = [];
        $rank = 1;
        foreach ($rankedKwbs as $shopId => $score) {
            $shop = Kwbs::find($shopId); // Retrieve the shop using Eloquent
            $shopName = $shop ? $shop->name : 'Unknown'; // Access the name attribute from the Shop model

            $ranking[$rank] = ['shopId' => $shopId, 'shopName' => $shopName, 'score' => $score];
            $rank++;
        }

        return ['ranking' => $ranking, 'rankedKwbs' => $rankedKwbs];
    }


    public function print(Request $request)
    {

        $versionId = $request->version_id;
        $result = Results::join('bantuans', 'bantuans.id', 'results.bantuan_id')
            ->join('kwbs', 'kwbs.id', 'results.kwb_id')
            ->where('results.version', $versionId)
            ->select('results.rank', 'results.score', 'results.created_at', 'bantuans.name as name_bantuan', 'kwbs.name as name_kwb')
            ->orderBy('results.rank', 'asc')->get();

        // dd($request->version_id);
        // dump($result->toArray());

        $bantuan_name = $result->first()['name_bantuan'];
        $created_at = $result->first()['created_at'];

        $pdf = PDF::loadView('pdf_view', [
            'result' => $result->toArray(),
            'bantuan_name' => $bantuan_name,
            'created_at' => $created_at,
        ]);
        return $pdf->download('RESULT_SPK_MAUT.pdf');

        // // print fun 
        // if(printFun){
        //     // success
                   
        // } else {
        //     // failed
        // }
            
    }


}
