@foreach($articles as $article)
<div class="post-preview">
    <a href="{{route('single', [$article->getCategorie->slug, $article->slug])}}">
        <h2 class="post-title">{{$article->title}}</h2>
        <img src="{{$article->image}}" alt="{{$article->slug}}" width="640" height="480" class="rounded">
        <!-- <img src="https://picsum.photos/id/{{rand(1,300)}}/640/480"> -->
        <h3 class="post-subtitle">{!!Str::limit($article->content, 98)!!}</h3>
    </a>
    <p class="post-meta">
        <a href="{{$article->getCategorie->slug}}">Kategori : {{$article->getCategorie->name}}</a> |
        {{$article->created_at->diffForHumans()}}
    </p>
</div>
    @if(!$loop->last)
    <hr class="my-4" />
    @endif
@endforeach