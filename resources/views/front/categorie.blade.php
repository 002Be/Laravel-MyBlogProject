@extends("front.layouts.master")
@section("title",$categorie->name)
@section("content")
<div class="col-md-2"></div>
<!-- Main Content-->
<div class="col-md-7 col-xl-7">
    @if(count($articles)>0)
    <div><p style="text-align: center;">Bu kategoride {{count($articles)}} yazı bulundu</p><hr></div>
        @include("front.widgets.articleList")
    @else
    <div class="alert alert-danger">
        <h1>Bu kategoriye ait yazı bulunamadı</h1>
    </div>
    @endif
    <div class="d-flex justify-content-center">{{$articles->links('pagination::bootstrap-4')}}</div>
</div>
@include("front.widgets.categorieWidget")
@endsection