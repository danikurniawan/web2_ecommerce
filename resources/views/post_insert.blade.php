@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12"><h3>Menampilkan Rich Text Editor</h3></div>
        <div class="col-md-12">
            <form>
                <textarea name="editor" id="ckview"></textarea>
            </form>
        </div>
    </div>
</div>
<script src="{{url('plugins/tinymce/jquery.tinymce.min.js')}}"></script>
<script src="{{url('plugins/tinymce/tinymce.min.js')}}"></script>
<script>tinymce.init({selector:'#ckview'});</script>
@endsection
