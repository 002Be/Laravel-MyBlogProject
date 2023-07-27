@extends("front.layouts.master")
@section("title",$article->title)
@section("content")
@section("bg",$article->image)
<div class="col-md-2">

</div>
<!-- Main Content-->
<div class="col-md-7">
    <article class="mb-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div>
                            <h2>{{$article->title}}</h2>
                            <img src="https://picsum.photos/id/{{rand(1,300)}}/640/480">
                            <p>{!!$article->content!!}</p>
                            <!-- <p>{!!$article->content!!}</p> | Eğer verinin içerisinde taglar varsa bu şekil yazarsak bu taglar işlenir hale gelir -->
                            <p class="post-meta">
                                <a href="{{$article->getCategorie->slug}}">Kategori : {{$article->getCategorie->name}}</a> |
                                {{$article->created_at->diffForHumans()}}
                            </p>
                            <span style="color:red;">Okunma Sayısı : <b>{{$article->hit}}</b></span>
                        </div>
                    </div>
                </div>
            </article>

    <!-- Pager-->
    <div class="justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="/">← Geri Dön</a></div>
</div>
@include("front.widgets.categorieWidget")
@endsection