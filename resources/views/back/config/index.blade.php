@extends("back.layouts.master")
@section("title") {{$config->title}} @endsection
@section("content")

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <strong> Ayarlar </strong>
        </h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.config.update')}}" method="POST" enctype="multipart/form-data"> @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Site Başlığı</label>
                        <input type="text" name="title" value="{{$config->title}}" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Site Aktiflik Durumu</label>
                        <select name="active" class="form-control">
                            <option @if($config->active==1) selected @endif value="1">Açık</option>
                            <option @if($config->active==0) selected @endif value="0">Kapalı</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Site Logo</label>
                        <input type="file" name="logo" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Site Favicon</label>
                        <input type="file" name="favicon" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Linkedin</label>
                        <input type="text" name="linkedin" value="{{$config->linkedin}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Github</label>
                        <input type="text" name="github" value="{{$config->github}}" class="form-control">
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-block">Kaydet</button>
        </form>
    </div>
</div>

@endsection