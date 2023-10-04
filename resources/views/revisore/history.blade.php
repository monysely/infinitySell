<x-layout>

<x-slot name="title">InfinitySell - {{ __('ui.Storico revisioni') }}</x-slot>


    <!-- Vista storico revisioni -->
<x-second-hero/>



@if (session('success'))
    <div class="alert alert-success" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">
        {{ session('success') }}
    </div>
@endif

@if (session('fail'))
    <div class="alert alert-danger" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">
        {{ session('fail') }}
    </div>
@endif



<section class="container py-5">
    <div class="row">
        <div class="col-12">
            <p class="text-center fs-3">{{ __('ui.Storico revisioni') }}</p>
        </div>
    </div>
</section>

<section class="container pb-5">
    <div class="row justify-content-center mb-4 p-3 d-none d-md-flex">
        <div class="col-2 d-flex justify-content-center align-items-center">
            <p class="m-0 text-truncate"><i class="fa-solid fa-pen-fancy me-2"></i><strong>{{ __('ui.Titolo') }}</strong></p>
        </div>
        <div class="col-3 d-flex justify-content-center align-items-center">
            <p class="m-0 text-truncate"><i class="fa-solid fa-align-left me-2"></i><strong>{{ __('ui.Testo dell\'annuncio') }}</strong></p>
        </div>
        <div class="col-2 d-flex justify-content-center align-items-center">
            <p class="m-0 text-truncate"><i class="fa-solid fa-hand-holding-dollar me-2"></i><strong>{{ __('ui.Prezzo') }}</strong></p>
        </div>
        <div class="col-2">
            <p class="m-0 text-truncate text-center"><i class="fa-solid fa-gavel me-2"></i><strong>{{ __('ui.Azione') }}</strong></p>
        </div>
        <div class="col-2 d-flex justify-content-center align-items-center">
            <p class="m-0 text-truncate"><i class="fa-solid fa-user-gear me-2"></i><strong>{{ __('ui.revisore') }}</strong></p>
        </div>
        <div class="col-1 d-flex justify-content-center align-items-center">
            <p class="m-0 text-truncate text-truncate"><i class="fa-solid fa-traffic-light me-2"></i><strong>{{ __('ui.Status') }}</strong></p>
        </div>
    </div>
    @forelse($articles as $article)
        <div class="row justify-content-center p-3 mb-4 mx-1 mx-md-0 shadow rounded-3 border border-1 bianco-sporco {{ ($article->is_accepted == 1) ? 'border-success' : 'border-danger' }}">
            <div class="col-md-2  d-flex justify-content-start justify-content-md-center align-items-center">
                <p class="m-0 d-md-none d-block"><i class="fa-solid fa-pen-fancy me-1"></i></p>
                <a href="{{route('article.detail', ['title'=> Str::slug($article->title), 'id'=> $article->id])}}" class="text-truncate">{{ ucfirst($article->title) }}</a>
            </div>
            <div class="col-md-3 py-3 py-md-0 d-flex justify-content-start justify-content-md-center align-items-center">
                <p class="m-0 d-md-none d-block"><i class="fa-solid fa-align-left me-1"></i></p>
                <p class="text-truncate m-0">{{ ucfirst($article->content) }}</p>
            </div>
            <div class="col-md-2 d-flex justify-content-start justify-content-md-center align-items-center">
                <p class="m-0 d-md-none d-block"><i class="fa-solid fa-hand-holding-dollar me-1"></i></p>
                <p class="m-0">€ {{number_format($article->price, 2,',','.' )}}</p>
            </div>
            <div class="col-md-2 py-3 py-md-0 d-flex justify-content-start justify-content-md-center align-items-center">
                @if($article->revisor_id == auth()->user()->id)
                    <form action="{{route('revisor.undo-article' , ['id'=> $article->id])}}" method="post" class="w-100 d-flex justify-content-start justify-content-md-center">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-warning text-truncate"><i class="fa-solid fa-scale-unbalanced-flip me-2"></i>{{ __('ui.Rivaluta annuncio') }}</button>
                    </form>
                @else
                    <p class="m-0 text-danger text-truncate"><i class="fa-solid fa-ban me-1"></i> {{ __('ui.Non revisionato da te!') }}</p>
                @endif
            </div>
            <div class="col-6 col-md-2 d-flex justify-content-start justify-content-md-center align-items-center">
                @foreach($users as $user)
                    @if($article->revisor_id == $user->id) 
                        <p class="m-0 d-md-none d-block"><i class="fa-solid fa-user-gear me-1"></i></p>
                        <p class="m-0">{{ucfirst($user->name)}}</p>
                    @endif
                @endforeach
            </div>
            <div class="col-6 col-md-1 d-flex justify-content-end justify-content-md-center align-items-center">
                @if ($article->is_accepted == 1)
                    <p class="m-0"><i class="fa-solid fa-check text-success fa-2x"></i></p>
                @else
                    <p class="m-0"><i class="fa-solid fa-xmark text-danger fa-2x"></i></p>
                @endif
            </div>
        </div>
    @empty
        <p class="text-center text-danger">{{ __('ui.Non hai ancora revisionato nessun annuncio!') }}</p>
    @endforelse  
</section>

<section class="row justify-content-center">
        <div class="d-flex justify-content-center col-12 col-md-6">
            {{$articles->links()}}
        </div>
    </section>

</x-layout>