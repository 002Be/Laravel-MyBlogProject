@extends("back.layouts.master")
@section("title") Sayfa Oluştur @endsection
@section("content")

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">@yield("title")</h6>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </div>
        @endif
        <form action="{{route('admin.page.create.post')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Başlık</label>
                <input type="text" name="title" class="form-control" required>
                <br>
                <label>İçerik</label>
                <textarea id="summernote" name="content" cols="30" rows="10" class="form-control" required></textarea>
                <br>
                <label>Resim</label><br>
                <input type="file" name="image" required>
                <br><br>
                <button type="submit" class="btn btn-block btn-primary">Oluştur</button>
            </div>
        </form>
    </div>
</div>

@endsection
@section("css")
<!-- include summernote css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section("js")
<!-- include summernote js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#summernote').summernote(
            {
                'height':300
            }
        );
    });
</script>
@endsection