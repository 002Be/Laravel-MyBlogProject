@extends("back.layouts.master")
@section("title") Tüm Kategoriler @endsection
@section("content")

<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kategori Oluştur</h6>
            </div>
            <div class="card-body">
                <form action="{{route('admin.categorie.create')}}" method="POST">
                    @csrf
                    @if($errors->any())
                        <div class="alert alert-danger">
                            Kategori adı 2 karakterden uzun olmalıdır!
                        </div>
                    @endif
                    <div class="form-group">
                        <Label>Adı</Label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Oluştur</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kategoriler</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <!-- <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> -->
                        <thead>
                            <tr>
                                <th>Adı</th>
                                <th>Makale Sayısı</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $categorie)
                            <tr>
                                <td>{{$categorie->name}}</td>
                                <td>{{$categorie->articleCount()}}</td>
                                <td><input class="switch" categorie-id="{{$categorie->id}}" @if($categorie->status==1) checked @endif type="checkbox" data-toggle="toggle" data-on="Yayında" data-off="Yayınlanmamış" data-onstyle="success" data-offstyle="danger"></td>
                                <td>
                                    <a href="{{route('categorie', $categorie->slug)}}" target="_blank" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> </a>
                                    <a data-toggle="modal" data-target="editModal" categorie-id="{{$categorie->id}}" title="Düzenle" class="btn btn-sm btn-primary edit-click"><i class="fa fa-pen"></i> </a>
                                    <a categorie-name="{{$categorie->name}}" @if($categorie->id==1) style="visibility: hidden;" @endif data-toggle="modal" data-target="removeModal" categorie-id="{{$categorie->id}}" title="Sil" class="btn btn-sm btn-danger remove-click" categorie-count="{{$categorie->articleCount()}}"><i class="fa fa-trash"></i> </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit - Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kategoriyi Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.categorie.update')}}" method="POST">
                    @csrf
                    @if($errors->any())
                        <div class="alert alert-danger">
                            Kategori adı 2 karakterden uzun olmalıdır!
                        </div>
                    @endif
                    <div class="form-group">
                        <Label>Adı</Label>
                        <input id="modalName" type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <Label>Slug</Label>
                        <input id="modalSlug" type="text" class="form-control" name="slug">
                    </div>
                    <input type="hidden" name="id" id="modalId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                    <button type="submit" class="btn btn-success">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Remove - Modal -->
<div class="modal fade" id="removeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kategoriyi Sil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    <p id="articleAlert"></p>
                </div>
            </div>
            <div class="modal-footer">
                <form action="{{route('admin.categorie.delete')}}" method="POST"> @csrf
                    <input type="hidden" name="id" id="removeModalId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                    <button type="submit" class="btn btn-danger" id="removeModalName"></button>
                </form>
            </div>
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
            $('.edit-click').click(function(){
                id = $(this)[0].getAttribute("categorie-id");
                $.ajax({
                    type:"GET",
                    url:"{{route('admin.categorie.getdata')}}",
                    data:{id:id},
                    success:function(data){
                        $("#modalName").val(data.name);
                        $("#modalSlug").val(data.slug);
                        $("#modalId").val(data.id);
                        $("#editModal").modal();
                    }
                })
            })

            $('.remove-click').click(function(){
                id = $(this)[0].getAttribute("categorie-id");
                count = $(this)[0].getAttribute("categorie-count");
                name = $(this)[0].getAttribute("categorie-name");
                if(count>0){
                    $("#articleAlert").html(name+" kategorisini ait "+count+" tane makale bulunmaktadır! Silmek istediğinize emin misiniz?")
                }else{
                    $("#articleAlert").html(name+" kategorisini silmek istediğinize emin misiniz?")
                }
                $("#removeModalId").val(id);
                $("#removeModalName").html(name+" Kategorisini Sil");
                $("#removeModal").modal();
            })

            $('.switch').change(function() {
                id = $(this)[0].getAttribute("categorie-id");
                statu = $(this).prop("checked");
                $.get("{{route('admin.categorie.switch')}}", {id:id, statu:statu}, function(data, status){});
            })
        })
    </script>
@endsection