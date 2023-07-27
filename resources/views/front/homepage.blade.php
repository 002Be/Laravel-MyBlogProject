@extends("front.layouts.master")
@section("title","Blog Sitesi - Ana Sayfa")
@section("content")

<div class="col-md-2"></div>
<div class="col-md-7 col-xl-7">
@include("front.widgets.articleList")
<div class="d-flex justify-content-center">{{$articles->links('pagination::bootstrap-4')}}</div>
</div>

@include("front.widgets.categorieWidget")
@endsection