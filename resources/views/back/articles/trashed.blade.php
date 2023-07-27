@extends("back.layouts.master")
@section("title") Silinen Makaleler @endsection
@section("content")

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <strong>{{$articles->count()}} makale bulundu </strong>
            <a href="{{route('admin.makaleler.index')}}" class="btn btn-warning btn-sm float-right"><i class="fa fa-list-alt"></i> Makaleler</a>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Resim</th>
                        <th>Başlık</th>
                        <th>Kategori</th>
                        <th>Görüntüleme</th>
                        <th>Yayınlama Tarihi</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                    <tr>
                        <td>
                            <img src="{{asset($article->image)}}" width="150" alt="Mini Resim">
                        </td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->getCategorie->name}}</td>
                        <td>{{$article->hit}}</td>
                        <td>{{$article->created_at->diffForHumans()}}</td>
                        <td>
                            <a href="{{route('admin.recover.article', $article->id)}}" title="Geri Al" class="btn btn-sm btn-success"><i class="fa fa-recycle"></i> </a>
                            <a href="{{route('admin.hard.delete.article', $article->id)}}" type="submit" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@section("css")
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section("js")
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function() {
            $('.switch').change(function() {
                id = $(this)[0].getAttribute("article-id");
                statu = $(this).prop("checked");
                $.get("{{route('admin.switch')}}", {id:id, statu:statu}, function(data, status){});
            })
        })
    </script>
@endsection