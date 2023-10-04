<x-layout>

<x-slot name="title">InfinitySell - {{ __('ui.I tuoi annunci') }}</x-slot>


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
    <p class="text-center h4 pb-5"> {{__('ui.I tuoi annunci')}}</p>
        @forelse($articles as $article)
            <a href="{{route('article.detail', ['title'=> Str::slug($article->title), 'id'=> $article->id])}}" class="row align-items-center border border-1 mb-4 mb-md-3 text-decoration-none shadow text-dark bianco-sporco @if($article->is_accepted == '1') border-success @elseif($article->is_accepted == '0') border-danger @else border-warning @endif">
                <div class="col-md-1 py-3 d-flex justify-content-center">
                    <img src="{{Storage::url('public/' . $article->id . '/crop_1000x1000' . $article->articleImages->first()->file_name) }}" class="img-fluid rounded-3" alt="">
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
                    @if ($article->is_accepted == '1')
                        <p class="m-0"><i class="fa-solid fa-check text-success fa-2x"></i></p>
                    @elseif($article->is_accepted == '0')
                        <p class="m-0"><i class="fa-solid fa-xmark text-danger fa-2x"></i></p>
                    @else
                        <p class="m-0"><i class="fa-solid fa-hourglass-end fa-2x text-warning"></i></p>
                    @endif
                </div>
                <div class="col-md-1 d-flex justify-content-start justify-content-md-center">
                    <p class="m-0"><i class="fa-regular fa-eye me-2"></i> @if( !$article->clicks) 0 @else {{$article->clicks}} @endif</p>
                </div>
                <div class="col-md-1 d-flex justify-content-start justify-content-md-center">
                    <p class="m-0">{{$article->created_at->format('d/m/Y')}}</p>
                </div>
                <div class="col-md-1 d-flex justify-content-end justify-content-md-center mb-4 mb-md-0">
                    <form action="{{ route('article.destroy', ['id'=>$article->id]) }}" method="post">
                        @csrf
                        <button class="btn btn-danger">{{__('ui.Elimina')}}</button>
                    </form>
                </div>
            </a>
        @empty
            <p class="m-0 text-center">Non hai pubblicato nessun annuncio</p> 
        @endforelse
</section>


</x-layout>