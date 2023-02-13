<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dictionary;
use App\Models\Barcode;
use Carbon\Carbon;
use storage;
use File;
use PDF;
class BarcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list = Barcode::with('showdictionary')->orderby('id','DESC')->get();
        return view('admincp.Barcode.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        $dictionary = Dictionary::pluck('name','id');
       
         $list = Barcode::with('showdictionary')->orderby('id','DESC')->get();

       return view('admincp.Barcode.form',compact('list','dictionary'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
              //
              $data = $request->all();
            //   dd($data);
              if(isset($data['clickinput2']))
              {
                 
                  $barcode = new Barcode();
                    $barcode->quantity = $data['quantity'];
                    
                    $barcode->dictionary_id = $data['dictionary_id'];
                    $barcode->created_at = Carbon::now('Asia/Ho_Chi_minh');
                    $barcode->updated_at = Carbon::now('Asia/Ho_Chi_minh');
                    // dd($barcode);
                    $barcode->save();   
                    $idbarcode = $barcode->id;
                    return redirect('print-order/'.$idbarcode)->with('success_msg', 'Barcode added!');
              }
              else{
                $barcode = new Barcode();
                $barcode->quantity = $data['quantity'];
                $barcode->dictionary_id = $data['dictionary_id'];
                $barcode->created_at = Carbon::now('Asia/Ho_Chi_minh');
                $barcode->updated_at = Carbon::now('Asia/Ho_Chi_minh');
                // dd($barcode);
                $barcode->save();   
                return redirect()->back()->with('message','Data added Successfully');
              }
           
              
              
              // tiến hành thêm thể loại cho phim
            //   $moviebarcode->movie_genre_relati()->attach($data['genre']);
            //    return redirect()->back()->with('message','Data added Successfully');
            //    return redirect()->route('barcode.index');
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
    }
    public function getdictionary(Request $request)
    {
        $search = $request->search;
        if($search == ""){
            $dictionary = Dictionary::orderby('id', 'desc')->select('id','name')->limit(8)->get();
        }else{
            $dictionary = Dictionary::orderby('id', 'desc')->select('id','name')->where('name','like','%'.$search.'%')->limit(30)->get();
        }
        $response = array();
        foreach($dictionary as $val){
            $response[] = array(
                'id' => $val->id,
                'text' => $val->name
            );
        };
        return response()->json($response);
    }
    public function print_order($checkout_code)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));

        return $pdf->stream();
    }
    public function print_order_convert($checkout_code)
    {
        $printbarcode = Barcode::with('showdictionary')->where('id',$checkout_code)->orderby('id','DESC')->get();
        $output='';
        $output.='<style>
                    body{font-family:DejaVu Sans;}
                    div.wapper-printcode{
                        display: flex;
                        flex-wrap: wrap;
                        // width:100%;
                        border:1px solid red;
                        padding:5px;
                      
                        overflow: auto;
                    }
                    // .wapper-printcode::after {
                    //     content: "";
                    //     clear: both;
                    //     display: table;
                    //   }
                    div.content {
                       
                        width: 160px;
                        max-width: 160px;
                        border: 1px solid darkgray;
                        padding: 15px;
                        margin: 2px;
                    }
                    </style>';
       foreach ($printbarcode as $barcodesn) {
        //    $output.=  $barcodesn->quantity ;
        //    $output.=  '<br>';
        //    $output.=  $barcodesn->id;
        //     $output.=  '<br>';
        //     $output.=  $barcodesn->name;
            $output.=  '<h2 style="text-align:center"> thông tin barcode</h2>';
            $output.=  '<div class= "wapper-printcode">';
            for($i = 1; $i <= $barcodesn->id; $i++){
                $output.='<div class="content">
                <p> đây là tấm'. $i.'</p>
                <p> id là:'. $barcodesn->id.'</p>
                <p> tên là:'. $barcodesn->showdictionary->name.'</p>
                <p> số lượng:'. $barcodesn->quantity.'</p>
                        </div>';
            }
            $output.=  '</div>';
        }
       
      
      
      
        
        return $output;
    }
} 