<x-layout>

<x-slot name="title">InfinitySell - {{ __('ui.Dettaglio') }} {{ ucfirst($article->title) }}</x-slot>


    <x-second-hero/>

    
    
    
    <section class="container">
        <div class="row py-5">
            <div class="col-12 shadow py-5 rounded-3 border border-1 border-primary border-opacity-25 bianco-sporco">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-5">
                        <div id="carouselExample" class="carousel carousel-dark">
                            <div class="carousel-inner slides">
                                @foreach($article->articleImages as $image)
                                    <div class="carousel-item @if($loop->first) active @endif">
                                        <img src="{{ asset('storage/' . $article->id . '/crop_1000x1000' . $image->file_name) }}" class="d-block w-100 rounded-4" alt="...">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-12 col-xl-5 py-3 px-4 position-relative">
                        <div class="row">
                        @if (session('success'))
                            <div class="alert alert-success index-error position-absolute" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('fail'))
                            <div class="alert alert-warning index-error position-absolute" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">
                                {{ session('fail') }}
                            </div>
                        @endif  
                            <div class="col-6 d-flex align-items-center">
                                <p class="text-white badge bg-secondary bg-opacity-50 fs-3 m-0">@if (App::getLocale() == 'it') {{ucfirst( $category->ita)}}  @elseif(App::getLocale() == 'en') {{ucfirst($category->en)}} @else {{ucfirst($category->ro)}} @endif</p>
                            </div>
                            <div class="col-6 d-flex justify-content-end gap-3 align-items-center">
                                <p class="text-black-50 m-0"><i class="fa-solid fa-share-nodes"></i></p>
                                @if(auth()->check())
                                    @php
                                        $cuoricini = [];
                                    @endphp
                                    <!-- BOTTONE AGGIUNGI AI PREFERITI -->
                                    @if (!empty(auth()->user()->likes))
                                        @foreach (auth()->user()->likes as $likes)
                                            @foreach ($likes->articles as $announce)
                                                @if($announce->id == $article->id)
                                                    @php
                                                        array_push($cuoricini, $announce->id)
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif
                                    @if (count($cuoricini) > 0)
                                        <form action="{{ route('user.remove-favourite', ['myArticle'=>$article->id, 'user'=>auth()->user()->id]) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn"><i class="fa-solid fa-heart text-danger fa-2x"></i></button>
                                        </form>
                                    @else
                                        <form action="{{ route('user.add-favourite', ['myArticle'=>$article->id, 'user'=>auth()->user()->id]) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn"><i class="fa-regular fa-heart fa-2x text-black-50"></i></button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                    </div>

                        <hr class="my-4">

                        @if(auth()->check())
                            <div class="row py-3">
                                @livewire('stars-manager', ['id'=>$article->id])
                            </div>
                        @endif
                    
                        <div class="row py-4">
                            <div class="col-6">
                                <p class="m-0">{{__('ui.il')}} {{$article->created_at->format('d/m/Y')}} {{__('ui.ore')}} {{ $article->created_at->format('H:m') }}</p>
                            </div>
                            <div class="col-3 d-flex justify-content-center">
                                <p class="text-black-50 m-0"><i class="fa-regular fa-eye me-2"></i>{{ (!$article->clicks) ? '0' : $article->clicks }} {{__('ui.visite')}}</p>
                            </div>
                            <div class="col-3 d-flex justify-content-end">
                                <p class="m-0 text-black-50">ID: {{ $article->id }}</p>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <p class="h4">{{ ucfirst($article->title) }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <p class="m-0 display-6 text-2">€ {{number_format($article->price, 2,',','.' )}}</p>
                            </div>
                        </div>

                        <!-- FORM DI CONTATTO PER VENDITORE - UTENTE -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('ui.Messaggio al venditore')}}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                @if (auth()->check())
                                    <div class="modal-body">
                                        <form action="{{ route('user.contact.seller') }}" method="POST" id="contattaVenditore">
                                            @csrf
                                            <div class="mb-3">
                                                <input type="email" value="{{ $article->user->email }}" name="seller_email" hidden>
                                                <input type="text" value="{{ $article->title }}" name="article_title" hidden>
                                                <input type="text" value="{{ $article->user->name }}" name="seller_name" hidden>
                                                <input type="text" value="{{ $article->id }}" name="article_id" hidden>
                                                <input type="email" class="form-control" id="user_mail" name="user_mail" value="{{ auth()->user()->email }}" hidden>
                                                @error('user_mail') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="user_message" class="col-form-label">{{__('ui.Testo del messaggio:')}}</label>
                                                <textarea class="form-control" id="user_message" name="user_message">{{__('ui.Ciao, è ancora disponibile?')}}</textarea>
                                                @error('user_message') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                        </form>
                                    </div>
                                @endif

                                <div class="modal-footer d-flex justify-content-between">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__('ui.Annulla')}}</button>
                                    <button type="submit" class="btn btn-success" form="contattaVenditore">{{__('ui.Invia messaggio')}}</button>
                                </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="row mt-5 py-5">
                            <hr>
                            
                            <div class="col-6 d-flex align-items-start justify-content-center flex-column">
                                <p class="text-white badge bg-secondary bg-opacity-50 m-0 small">{{ __('ui.Venditore') }} </p>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6 d-flex justify-content-start align-items-center">
                                        @if (auth()->check())
                                            @if($article->user_id == auth()->user()->id)
                                                <a href="{{route('user.profile', ['name'=>Str::slug(auth()->user()->name)])}}" class="text-decoration-none border-bottom border-2 border-warning text-black fst-italic">
                                                    <p class="m-0">{{ucfirst($article->user->name)}}
                                                        @if(!$reviews)
                                                            <span>
                                                                0 {{__('ui.Recensioni')}}
                                                            </span>
                                                        @else
                                                            <span>
                                                                {{ $reviews->count() }} {{__('ui.Recensioni')}}
                                                            </span>
                                                        @endif
                                                    </p>
                                                </a>
                                            @else
                                                <a href="{{ route('user.profilePeoples', ['name'=>Str::slug($article->user->name), 'id'=>$article->user_id]) }}" class="text-decoration-none border-bottom border-2 border-warning text-black fst-italic">
                                                    <p class="m-0">{{ucfirst($article->user->name)}}
                                                        @if(!$reviews)
                                                            <span>
                                                                0 {{__('ui.Recensioni')}}
                                                            </span>
                                                        @else
                                                            <span>
                                                                {{ $reviews->count() }} {{__('ui.Recensioni')}}
                                                            </span>
                                                        @endif
                                                    </p>
                                                </a>
                                            @endif
                                        @else
                                            <p class="m-0">{{ucfirst($article->user->name)}}
                                                @if(!$reviews)
                                                    <span>
                                                        0 {{__('ui.Recensioni')}}
                                                    </span>
                                                @else
                                                    <span>
                                                        {{ $reviews->count() }} {{__('ui.Recensioni')}}
                                                    </span>
                                                @endif
                                            </p>
                                        @endif

                                    </div>
                                    <div class="col-6 d-flex justify-content-end align-items-center">
                                        @if(auth()->check())
                                            @if($article->user->id !== auth()->user()->id)
                                                <button type="button" class="btn bg-3-transparent text-white my-btn-3" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">{{__('ui.Contatta Venditore')}}</button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- parte bassa del dettaglio -->
                <section class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-xl-6">
                            <div class="row pt-5">
                                <p class="fs-4">{{ __('ui.DATI PRINCIPALI') }}</p>
                                <div class="col-12">
                                    <p class="m-0 mb-5 mb-md-0"><strong>{{ __('ui.E-mail del venditore:') }}</strong> {{ $article->user->email }}</p>
                                </div>
                            </div>
                            
                            <hr class="py-3 w-50 d-none d-md-block">

                            <div class="row">
                                <p class="fs-4">{{ __('ui.DESCRIZIONE') }}</p>
                                <div class="col-12">
                                    <p class="m-0">{{ ucfirst($article->content) }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-xl-4 d-none d-xl-block pt-5">
                            <img src="{{ asset('storage/site/buste.png') }}" alt="" class="img-fluid rounded-1">
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>


</x-layout>