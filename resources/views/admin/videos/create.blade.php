@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12"><h3>Insert Video</h3></div>
        <div class="col-md-12">
            <form action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="ckview"></textarea>
                </div>

                <div class="form-group">
                    <label>Upload</label>
                    <input type="file" name="vid_src" class="btn btn-info">
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{url('plugins/tinymce/jquery.tinymce.min.js')}}"></script>
<script src="{{url('plugins/tinymce/tinymce.min.js')}}"></script>
<script>tinymce.init({selector:'#ckview'});</script>
@endsection
