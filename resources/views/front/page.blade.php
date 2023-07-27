@extends("front.layouts.master")
@section("title",$page->title)
@section("content")
@section("bg",asset($page->image))
<div class="col-md-10 col-lg-8 col-xl-7">
    <p>{!! $page->content !!}</p>
</div>
@endsection