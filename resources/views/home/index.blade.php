<x-layout>

<x-slot name="title">InfinitySell - Home</x-slot>



<!-- Sezione Hero -->

<x-hero/>
@if (session('access.denied'))
    <div class="alert alert-danger index-error" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">
        {{ session('access.denied') }}
    </div>
@endif

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

<section class="container py-5" id="categoryCards" >
    <div class="row py-5">
        <p class="text-center py-3 fs-3">{{ __('ui.preferite') }}</p>
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2500">
            <div class="carousel-inner">
                <div class="carousel-item active pt-4">
                    <div class="row" >
                        <div class="col-6 col-md-4">
                            <a href="/annunci/categoria/10" class="text-decoration-none">
                                <div class="card shadow position-relative border border-primary border-1 border-opacity-10 index-cards opacity-75" style="background-image: url('https://images.pexels.com/photos/14610788/pexels-photo-14610788.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');">
                                    <!-- <img src="https://images.pexels.com/photos/14610788/pexels-photo-14610788.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top rounded-3 opacity-75" alt="..."> -->
                                    <p class="position-absolute start-50 top-50 translate-middle text-white shadow display-6 w-100 text-center text-truncate">{{ __('ui.Abbigliamento') }}</p>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-md-4">
                            <a href="/annunci/categoria/3"  class="text-decoration-none">
                                <div class="card shadow position-relative border border-primary border-1 border-opacity-10 index-cards opacity-75" style="background-image: url('https://images.pexels.com/photos/4112723/pexels-photo-4112723.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');">
                                    <!-- <img src="https://images.pexels.com/photos/4112723/pexels-photo-4112723.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top rounded-3 opacity-75" alt="..."> -->
                                    <p class="position-absolute start-50 top-50 translate-middle text-white shadow display-6 w-100 text-center text-truncate">{{ __('ui.Elettrodomestici') }}</p>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-md-4 d-none d-md-block">
                            <a href="/annunci/categoria/5" class="text-decoration-none">
                                <div class="card shadow position-relative border border-primary border-1 border-opacity-10 index-cards opacity-75" style="background-image: url('https://images.pexels.com/photos/12211/pexels-photo-12211.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');">
                                    <!-- <img src="https://images.pexels.com/photos/12211/pexels-photo-12211.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top rounded-3 opacity-75" alt="..."> -->
                                    <p class="position-absolute start-50 top-50 translate-middle text-white shadow display-6 w-100 text-center text-truncate">{{ __('ui.Giochi') }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="carousel-item pt-4">
                    <div class="row">
                        <div class="col-6 col-md-4">
                            <a href="/annunci/categoria/4" class="text-decoration-none">
                                <div class="card shadow position-relative border border-primary border-1 border-opacity-10 index-cards opacity-75" style="background-image: url('https://images.pexels.com/photos/11984943/pexels-photo-11984943.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');">
                                    <!-- <img src="https://images.pexels.com/photos/11984943/pexels-photo-11984943.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top rounded-3 opacity-75" alt="..."> -->
                                    <p class="position-absolute start-50 top-50 translate-middle text-white shadow display-6 w-100 text-center text-truncate">{{ __('ui.Libri') }}</p>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-md-4">
                            <a href="/annunci/categoria/1" class="text-decoration-none">
                                <div class="card shadow position-relative border border-primary border-1 border-opacity-10 index-cards opacity-75" style="background-image: url('https://images.pexels.com/photos/12761688/pexels-photo-12761688.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');">
                                    <!-- <img src="https://images.pexels.com/photos/12761688/pexels-photo-12761688.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top rounded-3 opacity-75" alt="..."> -->
                                    <p class="position-absolute start-50 top-50 translate-middle text-white shadow display-6 w-100 text-center text-truncate">{{ __('ui.Motori') }}</p>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-md-4 d-none d-md-block">
                            <a href="/annunci/categoria/6" class="text-decoration-none">
                                <div class="card shadow position-relative border border-primary border-1 border-opacity-10 index-cards opacity-75" style="background-image: url('https://images.pexels.com/photos/18320061/pexels-photo-18320061/free-photo-of-uomo-saltando-giocando-sport.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2');">
                                    <!-- <img src="https://images.pexels.com/photos/18320061/pexels-photo-18320061/free-photo-of-uomo-saltando-giocando-sport.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" class="card-img-top rounded-3 opacity-75" alt="..."> -->
                                    <p class="position-absolute start-50 top-50 translate-middle text-white shadow display-6 w-100 text-center text-truncate">{{ __('ui.Sport') }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <hr class="border-danger border-opacity-100 border-1" id="hr"> -->

<!-- CONTATORI -->
<section class="container-fluid py-5 bg-3 shadow mb-5" id="contatori">
    <div class="row">
        <div class="col-12 col-md-3" id="contPubblicati">
            <div class="card border-0 text-white bg-transparent">
                <div class="card-body">
                    <p class="card-title text-center" style="font-style: italic;">{{__('ui.Annunci pubblicati')}}</p>
                    <p class="card-text text-center mt-2 display-3">+<span id="annunciPubblicati">{{App\Models\Article::articlesCounter()}}</span></p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3" id="contRecensioni">
            <div class="card border-0 text-white bg-transparent">
                <div class="card-body">
                    <p class="card-title text-center" style="font-style: italic;">{{__('ui.Recensioni')}}</p>
                    <p class="card-text text-center mt-2 display-3">+<span id="recensioni">{{App\Models\Review::reviewsCounter()}}</span></p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3" id="contSpediti">
            <div class="card border-0 text-white bg-transparent">
                <div class="card-body">
                    <p class="card-title text-center" style="font-style: italic;">{{__('ui.Articoli spediti')}}</p>
                    <p class="card-text text-center mt-2 display-3">+<span id="articoliSpediti">{{App\Models\Article::articlesCounter() * 10}}</span></p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3" id="contRegistrati">
            <div class="card border-0 text-white bg-transparent">
                <div class="card-body">
                    <p class="card-title text-center" style="font-style: italic;">{{__('ui.Utenti registrati')}}</p>
                    <p class="card-text text-center mt-2 display-3">+<span id="utentiRegistrati">{{App\Models\User::usersCounter()}}</span></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container py-5">
    <div class="row px-1 align-items-center">
        <div class="col-md-6 d-flex justify-content-center justify-content-md-start align-items-center" id="ultimiAnnunci">
            <p class="fs-3 m-0">{{ __('ui.Ultimi annunci inseriti') }}</p>
        </div>
        <div class="col-md-6 d-flex justify-content-center justify-content-md-end align-items-center mt-4 mt-md-0" id="bottoneUltimiAnnunci">
            <a href="{{ route('article.index') }}" class="btn bg-2 text-white my-btn">{{ __('ui.Vai agli annunci') }}</a>
        </div>
    </div>
</section>


<div class="container py-5 mb-5">
    <div class="row">
        @forelse ($articles as $article)
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <a href="{{ route('article.detail', ['title'=> Str::slug($article->title), 'id'=>$article->id]) }}" class="text-decoration-none text-dark">
                    <div class="card mb-5 shadow position-relative announcementsCard bianco-sporco">
                        <img src="{{ asset('storage/' . $article->id . '/crop_1000x1000' . $article->articleImages()->first()->file_name) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h4 class="card-title text-truncate">{{ ucfirst($article->title) }}</h4>
                            <p class="card-text text-truncate text-black-50">{{ ucfirst($article->content) }}</p>
                            <p class="card-text text-black-50 small">{{ __('ui.Pubblicato il:') }}  {{$article->created_at->format('d/m/Y')}}</p>
                            <p class="card-text"></p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mx-3">
                            <p>
                                @if ($article->stars)
                                    @for ($i=0;$i<$article->stars /  $article->votants;$i++)
                                        <i class="fa-solid fa-star text-warning"></i>
                                    @endfor
                                @endif
                            </p>
                            <p class="text-black-50">{{ (!$article->clicks) ? '0' : $article->clicks }} {{__('ui.visite')}}</p>
                        </div>

                        <div class="card-footer d-flex align-items-center justify-content-around">
                            <p class="card-text m-0 w-50">€ {{number_format($article->price, 2,',','.' )}}</p>
                            <p class="border-start border-1 ps-4 m-0 text-truncate"><i class="fa-regular fa-circle-user me-2"></i>{{ucfirst($article->user->name)}}</p>
                        </div>

                        <div class="position-absolute bagde bg-2 text-white ms-2 mt-2 px-1 rounded-3 top-0 start-0 small">
                            <a href="{{route('article.category', ['category' => $article->category_id])}}" class="text-decoration-none text-white">
                            @if (App::getLocale() == 'it') {{ucfirst($article->category->ita)}}  @elseif(App::getLocale() == 'en') {{ucfirst($article->category->en)}} @else {{ucfirst($article->category->ro)}} @endif
                            </a>
                        </div>

                    </div>
                </a>
            </div>
            @empty
                <div class="col-12 col-md-8 d-flex justify-content-end align-items-center ">
                    <p class="text-center m-0">{{ __('ui.Non ci sono annunci da visualizzare, inseriscine uno nuovo:') }} </p>
                </div>
                <div class="col-12  mt-4 mt-md-0 col-md-4 d-flex justify-content-center justify-content-md-start">
                    <a href="{{route('article.create')}}" class="btn btn-success">{{ __('ui.Inserisci annuncio') }}</a>
                </div>
            @endforelse
    </div>
</div>

<section class="container-fluid py-5 bg-2-transparent text-white" id="comeFunzionaCont">
    <div class="container">
        <div class="row">
            <p class="display-5 text-center">{{ __('ui.Come funziona?') }}</p>
            <p class="text-center">{{ __('ui.Le 4 funzioni principali del nostro sito') }}</p>
            <div class="col-12 py-4 col-md-6 d-flex flex-column justify-content-center" id="comeFunzionaSinistra">
                <div class="row mb-3">
                    <div class="col-2 d-flex align-items-center justify-content-center position-relative">
                        <p class="m-0 shadow border border-1 border-black border-opacity-25 p-4 rounded-circle"><i class="fa-regular fa-user fa-2x"></i></p>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-3">
                            1
                        </span>
                    </div>
                    <div class="col-10">
                        <p class="h5">{{ __('ui.Registrazione gratuita') }}</p>
                        <p class="p-1">{{ __('ui.Pochi semplici passi per effettuare il login e creare il tuo account') }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-2 d-flex align-items-center justify-content-center position-relative">
                        <p class="m-0 shadow border border-1 border-black border-opacity-25 p-4 rounded-circle"><i class="fa-regular fa-pen-to-square fa-2x"></i></p>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-3">
                            2
                        </span>
                    </div>
                    <div class="col-10">
                        <p class="h5">{{ __('ui.Crea annunci') }}</p>
                        <p class="p-1">{{ __('ui.Inserisci il tuo annuncio in pochi click e vendi online a milioni di utenti') }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-2 d-flex align-items-center justify-content-center position-relative">
                        <p class="m-0 shadow border border-1 border-black border-opacity-25 p-4 rounded-circle"><i class="fa-solid fa-bullhorn fa-2x"></i></p>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-3">
                            3
                        </span>
                    </div>
                    <div class="col-10">
                        <p class="h5">{{ __('ui.Fai affari') }}</p>
                        <p class="p-1">{{ __('ui.I migliori articoli a prezzi imperdibili') }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-2 d-flex align-items-center justify-content-center position-relative">
                        <p class="m-0 shadow border border-1 border-black border-opacity-25 p-4 rounded-circle"><i class="fa-regular fa-credit-card fa-2x"></i></p>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-3">
                            4
                        </span>
                    </div>
                    <div class="col-10">
                        <p class="h5">{{ __('ui.Check-out') }}</p>
                        <p class="p-1">{{ __('ui.Paga comodamente con il tuo metodo preferito') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center" id="comeFunzionaDestra">
                <img src="{{ asset('storage/site/info.png') }}" alt="" class="img-fluid rounded-3">
            </div>
        </div>
    </div>
</section>


<section class="container py-5 mt-5 mb-5" id="corrieri">
    <div class="row justify-content-center">
        <div class="col-12 d-flex justify-content-center">
            <img src="{{ asset('storage/site/corrieri.png') }}" alt="" class="img-fluid">
        </div>
    </div>
</section>

<section class="container-fluid py-5 lavora-main" style="background-image: url('{{ asset('storage/site/lavora.jpg') }}');">
    <div class="lavora-inner d-flex align-items-center">
        <div class="container">
            <div class="row py-4 justify-content-center align-items-center">
                <div class="col-md-10 d-flex flex-column align-items-center">
                    <p class="text-center text-white fs-3">{{ __('ui.slogan') }}</p>
                    <a class="btn bg-2 my-btn" href="{{route('candidatura')}}" id="candidatiBTN">{{ __('ui.Lavora con noi') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>


</x-layout>



