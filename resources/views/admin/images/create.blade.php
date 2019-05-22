@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12"><h3>Insert Image</h3></div>
        <div class="col-md-12">
            <form action="{{ route('admin.images.store') }}" method="POST" enctype="multipart/form-data">
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
                    <input type="file" name="img_src" class="btn btn-info" accept="image/*">
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{url('plugins/tinymce/jquery.tinymce.min.js')}}"></script>
<script src="{{url('plugins/tinymce/tinymce.min.js')}}"></script>
<script>tinymce.init({selector:'#ckview'});</script>
@endpush
