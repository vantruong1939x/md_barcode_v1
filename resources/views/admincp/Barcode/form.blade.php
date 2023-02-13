@extends('admin_layout')
@section('content_admin')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Barcode') }}</div>

                <div class="card-body">
                   
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!isset($barcode))
                  
                    {!! Form::open(['route'=>'barcode.store','method'=>'POST','enctype' => 'multipart/form-data'])  !!}
                    @else
                    {!! print_r($barcode) !!} 
                     {!! Form::open(['route'=>['barcode.update',$barcode->id],'method'=>'PUT','enctype' => 'multipart/form-data'])  !!}
                    @endif
                    <div class="row">
                    <div class="form-group col-md-3">
                    	{!! Form::label('title','Barcodeid',[]) !!}
                    	{!! Form::text('title',isset($barcode) ? $barcode->id : '',['class'=>'form-control','placeholder'=>'idcode','id'=>'id_slug','disabled'])!!}
                    </div>
                     <div class="form-group col-md-4">
                       
                        {!! Form::label('Dictionary','Dictionary',[]) !!}
                        {{-- {!! Form::select('dictionary_id',$dictionary,isset($barcode) ? $barcode->dictionary_id : '',['class'=>'form-control js-data-ajax']) !!} --}}
                        <select id="js-data-ajax" style="width:100%" name="dictionary_id" class="form-control">
                          <option value="0">--select dictionary--</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                    	{!! Form::label('quantity','Quantity',[]) !!}
                    	{!! Form::text('quantity',isset($barcode) ? $barcode->quantity : '',['class'=>'form-control','placeholder'=>'quantity','id'=>'id_slug'])!!}
                    </div>
                    {{-- {!! dd($list[0]->id); !!} --}}
                    @if(!isset($barcode))
                    <div class="form-group col-md-2 text-center" style="align-self: end;"> {!! Form::submit('Lưu',['class'=>'btn btn-success btn-submit']) !!} <input type="submit" class='btn btn-success btn-submit' value="Lưu và in" name="clickinput2"> </div>
                    @else
                    <div class="form-group col-md-2 text-center" style="align-self: end;">  {!! Form::submit('Cập nhật dữ liệu',['class'=>'btn btn-success btn-submit']) !!} </div>
                    @endif

                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
              <!-- table -->
              <table class="table" id="myTable">
                <thead>
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Ngày tạo</th>
                      {{-- <th scope="col">Ngày cập nhật</th> --}}
                      {{-- <th scope="col">Manage</th> --}}
                  </tr>
                </thead>
                <tbody>
                  @foreach($list as $key => $cate)
                  <tr>
                    <th scope="row">{{$key}}</th>
                      <th scope="row">{{$cate->showdictionary->name}}</th>
                      <td>{{$cate->quantity}}</td>
                      <th scope="row">{{$cate->created_at}}</th>
                      {{-- <th scope="row">{{$cate->update_at}}</th> --}}
                    {{-- <td>
                        {!! Form::open(['method'=>'DELETE','route'=>['barcode.destroy',$cate->id],'onsubmit'=>'return confirm("Đồng ý xóa ?")'
                        ]) !!}
                       {!! Form::submit('Xóa',['class'=> 'btnxoa btn btn-danger']) !!} 
                       {!! Form::close() !!}
                       <a href="{{ route('barcode.edit',$cate->id)}}" class="btn btn-warning">Sửa</a>
                    </td> --}}
                  </tr>
                 @endforeach
                </tbody>
              </table>
              <!-- end table -->
        </div>
    </div>
</div>

  @endsection
