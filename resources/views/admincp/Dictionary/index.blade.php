@extends('admin_layout')
@section('content_admin')
<div class="container-fluid">
    <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">List Dictionary</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="row justify-content-center">
                    <div class="col-md-12">
                          <div class="listcp mt-3 mb-3 ml-1">
                            <a role="button" class="btn btn-primary" href="{{ route('dictionary.create')}}">Add new Dictionary</a>
                        </div>
                        <!-- table --> 
                        <table class="table" id="myTable">
                          <thead>
                            <tr>
                              {{-- <th scope="col">#</th> --}}
                              <th scope="col">id</th>
                              <th scope="col">Name</th>
                              {{-- <th scope="col">Quantity</th> --}}
                              <th scope="col">Manage</th>
                            </tr>
                          </thead>
                          <tbody class = "order_position">
                            @foreach($list as $key => $infos)
                            <tr id="{{$infos->id}}">
                              {{-- <th scope="row">{{$key}}</th> --}}
                              <td>{{$infos->id}}</td>
                              <td>{{$infos->name}}</td>
                              {{-- <td>số lượng tại bảng barcode</td> --}}
                              <td>
                                  {!! Form::open(['method'=>'DELETE','route'=>['dictionary.destroy',$infos->id],'onsubmit'=>'return confirm("Đồng ý xóa ?")'
                                  ]) !!}
                                 {!! Form::submit('Xóa',['class'=> 'btnxoa btn btn-danger']) !!} 
                                 {!! Form::close() !!}
                                 <a href="{{ route('dictionary.edit',$infos->id)}}" class="btn btn-warning">Sửa</a>
                              </td>
                            </tr>
                           @endforeach
                          </tbody>
                        </table>
                        <!-- end table -->
                    </div>
                </div>
                
    </div>
  
</div>
@endsection