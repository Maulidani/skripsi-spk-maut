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

        return view('dashboard.data.kwb.data-kwb', [
            'kwb' => $kwb,
            'category_kwb' => $categoryKwb
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
