@extends("back.layouts.master")
@section("title") Tüm Sayfalar @endsection
@section("content")

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <strong>{{$pages->count()}} sayfa bulundu </strong>
            <!-- <a href="{ {route('admin.trashed.article')}}" class="btn btn-warning btn-sm float-right"><i class="fa fa-trash"></i> Silinenler</a> -->
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <!-- <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> -->
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sıralama</th>
                        <th>Resim</th>
                        <th>Başlık</th>
                        <th>Güncellenme Tarihi</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody id="orders">
                    @foreach($pages as $page)
                    <tr id="page_{{$page->id}}">
                        <td style="text-align:center; padding:50px; cursor:move; width:10px;" class="handle"><i class="fa fa-bars fa-2x"></i></td>
                        <td style="text-align:center;">
                            <img src="{{asset($page->image)}}" width="150" alt="Mini Resim">
                        </td>
                        <td>{{$page->title}}</td>
                        <td>{{$page->updated_at->diffForHumans()}}</td>
                        <td style="text-align:center; padding:50px;"><input class="switch" page-id="{{$page->id}}" @if($page->status==1) checked @endif type="checkbox" data-toggle="toggle" data-on="Yayında" data-off="Yayınlanmamış" data-onstyle="success" data-offstyle="danger"></td>
                        <td style="text-align:center; padding:55px;">
                            <a href="{{route('page', $page->slug)}}" target="_blank" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> </a>
                            <a href="{{route('admin.page.update',$page->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i> </a>
                            <a href="{{route('admin.page.delete', $page->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="orderSuccess" style="display: none; text-align:center;" class="alert alert-success">Sayfa sıralaması değiştirildi</div>
    </div>
</div>

@endsection
@section("css")
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section("js")
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $("#orders").sortable({
            handle:".handle",
            update:function(){
                var siralama = $("#orders").sortable("serialize");
                $.get("{{route('admin.page.orders')}}?"+siralama, function(data, status){
                    $("#orderSuccess").show().delay(1000).fadeOut();
                });
            }
        });
    </script>
    <script>
        $(function() {
            $('.switch').change(function() {
                id = $(this)[0].getAttribute("page-id");
                statu = $(this).prop("checked");
                $.get("{{route('admin.page.switch')}}", {id:id, statu:statu}, function(data, status){});
            })
        })
    </script>
@endsection