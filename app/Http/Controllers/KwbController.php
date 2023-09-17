<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Bantuans;
use App\Models\CategoryKwbs;
use App\Models\Kwbs;
use App\Models\Results;
use App\Models\Users;

class KwbController extends Controller
{

    public function index()
    {
        $kwb = Kwbs::join('category_kwbs', 'category_kwbs.id', 'kwbs.category_id')
            ->select('kwbs.*', 'category_kwbs.name as category_name')
            ->orderBy('kwbs.created_at', 'desc')->get();

        $categoryKwb = CategoryKwbs::get();

        // Tambahkan data kecamatan dan kelurahan
        
        $dataKecamatan = array(
            'Biringkanaya' => array(
                'Bakung',
                'Berua',
                'Bulurokeng',
                'Daya',
                'Katimbang',
                'Laikang',
                'Paccerakkang',
                'Pai',
                'Sudiang',
                'Sudiang Raya',
                'Untia',
            ),
            'Bontoala' => array(
                'Baraya',
                'Bontoala',
                'Bontoala Parang',
                'Bontoala Tua',
                'Bunga Ejaya',
                'Gaddong',
                'Layang',
                'Malimongan Baru',
                'Parang Layang',
                'Timungan Lompoa',
                'Tompo Balang',
                'Wajo Baru',
            ),
            'Kepulauan Sangkarrang' => array(
                'Barrang Caddi',
                'Barrang Lompo',
                'Kodingareng',
            ),
            'Makassar' => array(
                'Bara-Baraya',
                'Bara-Baraya Selatan',
                'Bara-Baraya Timur',
                'Bara-Baraya Utara',
                'Barana',
                'Lariang Bangi',
                'Maccini',
                'Maccini Gusung',
                'Maccini Parang',
                'Maradekaya',
                'Maradekaya Selatan',
                'Maradekaya Utara',
                'Maricaya',
                'Maricaya Baru',
            ),
            'Mamajang' => array(
                'Baji Mappakasunggu',
                'Bonto Biraeng',
                'Bonto Lebang',
                'Karang Anyar',
                'Labuang Baji',
                'Mamajang Dalam',
                'Mamajang Luar',
                'Mandala',
                'Maricaya Selatan',
                'Pa\'batang',
                'Parang',
                'Sambung Jawa',
                'Tamparang Keke',
            ),
            'Manggala' => array(
                'Antang',
                'Bangkala',
                'Batua',
                'Biring Romang',
                'Bitowa',
                'Borong',
                'Manggala',
                'Tamangapa',
            ),
            'Mariso' => array(
                'Bontorannu',
                'Kampung Buyang',
                'Kunjung Mae',
                'Lette',
                'Mario',
                'Mariso',
                'Mattoangin',
                'Panambungan',
                'Tamarunang',
            ),
            'Panakkukang' => array(
                'Karampuang',
                'Masale',
                'Pampang',
                'Panaikang',
                'Pandang',
                'Sinrijala',
                'Tamamaung',
                'Karuwisi',
                'Karuwisi Utara',
                'Paropo',
                'Tello Baru',
            ),
            'Rappocini' => array(
                'Balla Parang',
                'Banta-Bantaeng',
                'Bonto Makkio',
                'Bua Kana',
                'Gunung Sari',
                'Karunrung',
                'Kassi-Kassi',
                'Mapala',
                'Minasa Upa',
                'Rappocini',
                'Tidung',
            ),
            'Tallo' => array(
                'Buloa',
                'Bunga Eja Beru',
                'Kalukuang',
                'Kaluku Bodoa',
                'La\'latang',
                'Lakkang',
                'Lembo',
                'Pannampu',
                'Rappojawa',
                'Rappokalling',
                'Suangga',
                'Tallo',
                'Tammua',
                'Ujung Pandang Baru',
                'Wala-Walaya',
            ),
            'Tamalanrea' => array(
                'Bira',
                'Buntusu',
                'Kapasa',
                'Kapasa Raya',
                'Parang Loe',
                'Tamalanrea',
                'Tamalanrea Indah',
                'Tamalanrea Jaya',
            ),
            'Tamalate' => array(
                'Balang Baru',
                'Barombong',
                'Bongaya',
                'Bonto Duri',
                'Jongaya',
                'Maccini Sombala',
                'Mangasa',
                'Mannuruki',
                'Pa\'baeng-Baeng',
                'Parang Tambung',
                'Tanjung Merdeka',
            ),
            'Ujung Pandang' => array(
                'Baru',
                'Bulogading',
                'Lae-Lae',
                'Lajangiru',
                'Losari',
                'Maloku',
                'Mangkura',
                'Pisang Selatan',
                'Pisang Utara',
                'Sawerigading',
            ),
            'Ujung Tanah' => array(
                'Camba Berua',
                'Cambaya',
                'Gusung',
                'Pattingalloang',
                'Pattingalloang Baru',
                'Tabaringan',
                'Tamalabba',
                'Totaka',
                'Ujung Tanah',
            ),
            'Wajo' => array(
                'Butung',
                'Ende',
                'Malimongan',
                'Malimongan Tua',
                'Mampu',
                'Melayu',
                'Melayu Baru',
                'Pattunuang',
            )
        );

        // Kirim data ke view
        return view('dashboard.data.kwb.data-kwb', [
            'kwb' => $kwb,
            'category_kwb' => $categoryKwb,
            'dataKecamatan' => $dataKecamatan,
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|numeric',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'address' => 'required',
            'name_leader' => 'required',
            'member' => 'required|numeric',
        ]);

        $model = new Kwbs;
        $model->name = $request->name;
        $model->category_id = $request->category_id;
        $model->kecamatan = $request->kecamatan;
        $model->kelurahan = $request->kelurahan;
        $model->address = $request->address;
        $model->name_leader = $request->name_leader;
        $model->member = $request->member;
        $model->save();

        if($model) {
            return redirect()->back()->with('message-add-kwb', 'Sukses menambah KWB');

        } else {
            return redirect()->back()->with('message-add-kwb', 'terjadi kesalahan');
        }

    }

    public function edit(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'category_id' => 'required|numeric',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'address' => 'required',
            'name_leader' => 'required',
            'member' => 'required|numeric',
        ]);

        $model = Kwbs::find($request->id);
        $model->name = $request->name;
        $model->category_id = $request->category_id;
        $model->kecamatan = $request->kecamatan;
        $model->kelurahan = $request->kelurahan;
        $model->address = $request->address;
        $model->name_leader = $request->name_leader;
        $model->member = $request->member;
        $model->save();

        if($model) {
            return redirect()->back()->with('message-add-kwb', 'Sukses edit KWB');

        } else {
            return redirect()->back()->with('message-add-kwb', 'terjadi kesalahan');
        }

    }

    public function delete(Request $request)
    {
        $model = Kwbs::where(
            'id',
            $request->id
        )->delete();

        if($model) {
            return redirect()->back()->with('message-add-kwb', 'Sukses hapus KWB');

        } else {
            return redirect()->back()->with('message-add-kwb', 'terjadi kesalahan');
        }

    }

}
