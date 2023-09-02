<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Bantuans;
use App\Models\CategoryKwbs;
use App\Models\Kwbs;
use App\Models\Results;
use App\Models\Users;

class BantuanController extends Controller
{

    public function index()
    {
        $bantuan = Bantuans::join('category_kwbs', 'category_kwbs.id', 'bantuans.category_id')
            ->select('bantuans.*', 'category_kwbs.name as category_name')
            ->orderBy('bantuans.created_at', 'desc')->get();
        
        $categoryKwb = CategoryKwbs::get();

        return view('dashboard.data.bantuan.data-bantuan', [
            'bantuan' => $bantuan,
            'category_kwb' => $categoryKwb
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|numeric',
            'detail' => 'required',
        ]);

        $model = new Bantuans;
        $model->name = $request->name;
        $model->category_id = $request->category_id;
        $model->detail = $request->detail;
        $model->save();

        if($model) {
            return redirect()->back()->with('message-add-bantuan', 'Sukses menambah bantuan');

        } else {
            return redirect()->back()->with('message-add-bantuan', 'terjadi kesalahan');
        }

    }


    public function edit(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'category_id' => 'required|numeric',
            'detail' => 'required',
        ]);

        $model = Bantuans::find($request->id);
        $model->name = $request->name;
        $model->category_id = $request->category_id;
        $model->detail = $request->detail;
        $model->save();

        if($model) {
            return redirect()->back()->with('message-add-kwb', 'Sukses edit KWB');

        } else {
            return redirect()->back()->with('message-add-kwb', 'terjadi kesalahan');
        }

    }
    
    public function delete(Request $request)
    {
        $model = Bantuans::where(
            'id',
            $request->id
        )->delete();

        if($model) {
            return redirect()->back()->with('message-add-bantuan', 'Sukses hapus bantuan');

        } else {
            return redirect()->back()->with('message-add-bantuan', 'terjadi kesalahan');
        }

    }

}
