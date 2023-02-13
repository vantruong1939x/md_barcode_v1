@extends('admin_layout')
@section('content_admin')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">List Barcode</div>
            </div>
            <div class="listcp">
            	<a role="button" class="btn btn-primary" href="{{ route('barcode.create')}}">Add new barcode</a>
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
                  {{-- <td scope="row">{{$key}}</td> --}}
                  <td scope="row">{{$cate->id}}</td>
                    <td scope="row">{{$cate->showdictionary->name}}</td>
                    <td>{{$cate->quantity}}</td>
                    <td scope="row">{{$cate->created_at}}</td>
                    
                </tr>
               @endforeach
              </tbody>
            </table>
            
            {{-- test --}}
            <div style='text-align: center;'>
              <!-- insert your custom barcode setting your data in the GET parameter "data" -->
              <img alt='Barcode Generator TEC-IT'
                   src='https://barcode.tec-it.com/barcode.ashx?data=ABC-abc-1234&code=Code128&translate-esc=on'/>
            </div>
            <div style='padding-top:8px; text-align:center; font-size:15px; font-family: Source Sans Pro, Arial, sans-serif;'>
              <!-- back-linking to www.tec-it.com is required -->
             
            </div>
            <div class="barcode">
              <p class="name">tên barcode</p>
              <p class="price">Price: 20.000</p>
              {!! DNS1D::getBarcodeHTML(4445645656, "C128",1.4,22) !!}
              <p class="pid">8</p>
            </div>
            {{-- end test --}}
        </div>
    </div>
</div>

  @endsection
