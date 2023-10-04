<x-layout>

<x-slot name="title">InfinitySell - {{ __('ui.I tuoi annunci') }} Gli annunci di {{ $name }}</x-slot>


<x-second-hero/>
@if (session('success'))
    <div class="alert alert-success index-error" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">
        {{ session('success') }}
    </div>
@endif

@if (session('fail'))
    <div class="alert alert-danger index-error" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">
        {{ session('fail') }}
    </div>
@endif

<!-- Vista Articoli -->

<section class="container py-5 px-4 px-md-0">
    <p class="text-center h4 pb-5">Gli annunci di {{ ucfirst($name) }}</p>
        @forelse($articles as $article)
            <a href="{{route('article.detail', ['title'=> Str::slug($article->title), 'id'=> $article->id])}}" class="row align-items-center border border-1 mb-4 mb-md-3 text-decoration-none shadow text-dark bianco-sporco">
                <div class="col-md-1 py-3 d-flex justify-content-center">
                    <img src="{{Storage::url('public/' . $article->id . '/crop_1000x1000' . $article->articleImages->first()->file_name) }}" class="img-fluid rounded-3" alt="">
                </div>
                <div class="col-md-3 d-flex justify-content-start justify-content-md-center">
                    <p class="m-0 text-truncate">{{ ucfirst($article->title) }}</p>
                </div>
                <div class="col-md-4 d-flex justify-content-start justify-content-md-center">
                    <p class="m-0 text-truncate">{{ ucfirst($article->content) }}</p>
                </div>
                <div class="col-md-2 d-flex justify-content-start justify-content-md-center">
                    <p class="m-0">€ {{number_format($article->price, 2,',','.' )}}</p>
                </div>
                <div class="col-md-2 d-flex justify-content-start justify-content-md-center">
                    <p class="m-0">{{$article->created_at->format('d/m/Y')}}</p>
                </div>
            </a>
        @empty
            <p class="m-0 text-center">Non hai pubblicato nessun annuncio</p> 
        @endforelse
</section>


</x-layout>