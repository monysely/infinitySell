<x-layout>
<x-slot name="title">InfinitySell - {{ __('ui.I tuoi preferiti') }}</x-slot>

<x-second-hero/>

<!-- Vista Articoli Preferiti -->

<section class="container py-5">
    <p class="text-center h4 pb-5"> {{__('ui.I tuoi preferiti')}}</p>


    @if(!empty($favorites))
        @foreach($favorites as $favorite)
            @foreach($favorite->articles as $article)
                <a href="{{route('article.detail', ['title'=> Str::slug($article->title), 'id'=> $article->id])}}" class="row align-items-center border border-1 mx-1 mx-md-0 border-primary border-opacity-25 bianco-sporco mb-4 text-decoration-none shadow text-dark">
                    <div class="col-md-1 py-3 d-flex justify-content-center position-relative">
                        <img src="{{Storage::url('public/' . $article->id . '/crop_1000x1000' . $article->articleImages->first()->file_name) }}" class="img-fluid rounded-3" alt="">
                        <i class="fa-solid fa-heart fa-2x text-danger position-absolute top-0 start-0 translate-middle"></i>
                    </div>
                    <div class="col-md-2 d-flex justify-content-start justify-content-md-center">
                        <p class="m-0 text-truncate">{{ ucfirst($article->title) }}</p>
                    </div>
                    <div class="col-md-3 d-flex justify-content-start justify-content-md-center">
                        <p class="m-0 text-truncate">{{ ucfirst($article->content) }}</p>
                    </div>
                    <div class="col-md-2 d-flex justify-content-start justify-content-md-center">
                        <p class="m-0">€ {{number_format($article->price, 2,',','.' )}}</p>
                    </div>
                    <div class="col-md-1 d-flex justify-content-start justify-content-md-center">
                        <p class="m-0">ID ann: {{$article->id}}</p>
                    </div>
                    <div class="col-md-1 d-flex justify-content-start justify-content-md-center">
                        <p class="m-0">{{$article->created_at->format('d/m/Y')}}</p>
                    </div>
                    <div class="col-md-2 d-flex justify-content-end mb-3 justify-content-md-center">
                        <form action="{{ route('user.remove-favourite', ['myArticle'=>$article->id, 'user' => auth()->user()->id]) }}" method="post">
                            @csrf
                            <button class="btn btn-warning"><i class="fa-solid fa-minus me-1"></i>{{__('ui.Rimuovi dai preferiti')}}</button>
                        </form>
                    </div>
                </a>
            @endforeach
        @endforeach
    @else
        <p class="text-center">Non hai ancora nessun annuncio tra i preferiti.</p>
    @endif

    
</section>












</x-laypout>

