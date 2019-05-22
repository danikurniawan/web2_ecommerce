@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12"><h3>Image Gallery</h3>
            <a href="{{ route('admin.images.create') }}" class="btn btn-primary">Add Image</a>
        </div>
    </div>

    <div class="row" style="margin-top: 15px;">
        @isset($images)

            @foreach($images as $v)
            <div class="col-md-4">
                <img src="{{ url('admin/images/view/'.$v->src) }}" class="img-thumbnail">
                <b>{!! $v->description !!}</b>
            </div>
            @endforeach
            
        @endisset
    </div>
</div>
@endsection
