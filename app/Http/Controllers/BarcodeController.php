<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dictionary;
use App\Models\Barcode;
use Carbon\Carbon;
use storage;
use File;
use PDF;
use DNS1D;
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
                    body{
                        font-family:DejaVu Sans;
                    }
                    .table-style{
                        border: 1px solid #f00;
                      }
                      .table-style tr td{
                        border: 1px solid #000;
                      }
                    </style>
                    <table class="table-style"><thead><tr><th>sssss</th><th>sssss1</th><th>sssss2</th></tr></thead></table>';
           
       foreach ($printbarcode as $barcodesn) {
        //    $output.=  $barcodesn->quantity ;
        //    $output.=  '<br>';
        //    $output.=  $barcodesn->id;
        //     $output.=  '<br>';
        //     $output.=  $barcodesn->name;
        $name = $barcodesn->showdictionary->name;
        $code = $barcodesn->id;

         $output='';
            // $output.=  '<table style="width:100%; border:1px solid #f00;">';
            $output.=  '<table class="table-style">';
                  for($i = 0; $i < $barcodesn->quantity; $i++){
                    if($i==0){
                        $output.=  '<tr style=" border:1px solid #123;">';
                    }
                    if($i == 5){
                            $output.=  '</tr>';
                      }
                      if($i % 5 == 0){
                        $output.=  '<tr class="vong'.$i.'" style="border:1px solid #333;" >';
                        $output.= '<td class="lanso: '.$i.'" style="text-align:center;width:35px ;"><p>'.DNS1D::getBarcodeHTML(1111111111, "C128",1.4,22).'</p><p>'.$name.'</p><p>'.$code.'</p></td>';
                       
                      }
                      else {
                        // $output.=  '<td class="banso: '.$i.'"><p>'.$code.'</p><p>'.$name.'</p></td>';
                        $output.= '<td class="bangenre: '.$i.'" style="text-align:center;width:35px ;"><p>'.DNS1D::getBarcodeHTML(4445645656, "C128",1.4,22).'</p><p>'.$name.'</p><p>'.$code.'</p></td>';
                       
                      }
                     
                      if($i== $barcodesn->quantity){ 
                        $output.=  '</tr>';
                      }
                    
                    
                  }
                  $output.=  '
                  </div>
            </table>';
        }
       
        return $output;
    }
} 