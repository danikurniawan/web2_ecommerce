@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12"><h3>Video Gallery</h3>
            <a href="{{ route('admin.videos.create') }}" class="btn btn-primary">Add Video</a>
        </div>
    </div>
    <hr>
    <div class="row" style="margin-top: 15px;">
        @isset($videos)

            @foreach($videos as $v)
            <div class="col-md-4">
                <video controls width="300">
                    <source src="{{ url('admin/videos/view/'.$v->src) }}" type="video/mp4">
                </video>
                <b>{!! $v->description !!}</b>
            </div>
            @endforeach
            
        @endisset
    </div>
</div>
@endsection
