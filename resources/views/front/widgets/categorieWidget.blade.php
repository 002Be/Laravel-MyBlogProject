<div class="col-md-3">
    <div class="list-group">
        <div class="list-group-item" style="text-align:center;">
            Kategoriler
        </div>
        @foreach($categories as $categorie)
            <a href="{{route('categorie',$categorie->slug)}}" class="list-group-item d-flex justify-content-between align-items-center" @if(Request::segment(1)==$categorie->slug) style="background-color:gray;" @endif>
                {{$categorie->name}}
                <span class="badge bg-primary rounded-pill">{{$categorie->articleCount()}}</span>
            </a>
        @endforeach
    </div>
</div>