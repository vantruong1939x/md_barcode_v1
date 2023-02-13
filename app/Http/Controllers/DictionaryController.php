<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dictionary;

class DictionaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list = Dictionary::orderBy('id','ASC')->get();
        return view('admincp.Dictionary.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // tạo mới dữ liệu 
        $list = Dictionary::orderBy('id','ASC')->get();
        return view('admincp.Dictionary.form',compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // store của các thông tin
               //ten cot = name cua form
               $data = $request->all();
               $dictionary = new Dictionary();
               // tror toi bang = truong name cua form
               $dictionary->name = $data['title'];
               $dictionary->save();
               return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $dictionary = Dictionary::find($id);
        $list = Dictionary::orderBy('id','ASC')->get();
      return view('admincp.Dictionary.form',compact('list','dictionary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
                //ten cot = name cua form
        $data = $request->all();
        $dictionary = Dictionary::find($id);
        // tror toi bang = truong name cua form
        $dictionary->name = $data['title'];
        $dictionary->save();
        return redirect()->to('dictionary');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Dictionary::find($id)->delete();
        return redirect()->back();
    }
}