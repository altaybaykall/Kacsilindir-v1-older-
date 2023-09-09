<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\CompareList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
    public function compareselect()
    {

        return view('cars/compareselect');
    }

    public function selectresult($ids)
    {
        $query = explode('-', $ids);
        $datas = Cars::whereIn('model_id', $query)->get();
        return view('cars/compareresult',compact('datas'));
    }


    public function storecomparelist(request $request)
    {
        CompareList::create($request->except('_token'));
        return "Model Karşılaştırmaya Eklendi";
    }

    public function showcompareList()
    {
        if (Auth::Check()) {
            $data = CompareList::where('user_id', Auth::user()->id)->get();
            return view('cars/compare')->with('datas', $data);
        } else
            $data = CompareList::all()->take('2');
        return view('cars/compare')->with('datas', $data);
    }

    public function removecomparelist($id)
    {
        $data = CompareList::where([['user_id', Auth::user()->id], ['model_id', $id]])->first()->delete();
        return back();
    }

}
