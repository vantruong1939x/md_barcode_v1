@extends('admin_layout')
@section('content_admin')
<div class="container-fluid">
    <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add dictionary</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {{-- custom new --}}
                <div class="card">
                  <div class="card-header">{{ __('Quản lý danh mục') }}</div>
  
                  <div class="card-body">
                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif
                      {{-- {!! dd($dictionary) !!} --}}
                      @if(!isset($dictionary))
                    
                      {!! Form::open(['route'=>'dictionary.store','method'=>'POST'])  !!}
                      @else
                        <!-- {!! print_r($dictionary) !!} -->
                       {!! Form::open(['route'=>['dictionary.update',$dictionary->id],'method'=>'PUT'])  !!}
                      @endif
                      <div class="form-group">
                        {!! Form::label('title','Title',[]) !!}
                        {!! Form::text('title',isset($dictionary) ? $dictionary->name : '',['class'=>'form-control','placeholder'=>'name','id'=>'id_slug','onkeyup'=>'ChangeToSlug()'])!!}
                      </div>
                      @if(!isset($dictionary))
                      {!! Form::submit('Thêm dữ liệu',['class'=>'btn btn-success']) !!}
                      @else
                      {!! Form::submit('Cập nhật dữ liệu',['class'=>'btn btn-success']) !!}
                      @endif
  
                      {!! Form::close() !!}
                  </div>
              </div>
                {{-- end custom new --}}
    </div>
  
</div>
@endsection