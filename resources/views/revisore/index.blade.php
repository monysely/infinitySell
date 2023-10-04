<x-layout>
<x-slot name="title">InfinitySell - {{ __('ui.revisore') }} {{ucfirst(auth()->user()->name)}}</x-slot>



    <x-second-hero/>


    @if (session('success'))

        <div class="alert alert-success" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">

         {{ session('success') }}

        </div>

    @endif

    @if (session('fail'))

        <div class="alert alert-warning" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">

            {{ session('fail') }}

        </div>

    @endif

    @if (session('info'))

        <div class="alert alert-info" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">

            {{ session('info') }}

        </div>

    @endif

    

    <!-- Pagina revisore -->

    

    <section class="container py-5 mt-4">

        <div class="row">

            <div class="col-12">

                <p class="text-center fs-3 mb-5">{{ $article ? __('ui.Annuncio da revisionare:') . ucfirst($article->title)  : __('ui.Non ci sono annunci da revisionare') }}</p>

                <div class="row">

                    <div class="col-md-6 mb-4 mb-md-0 d-flex justify-content-center justify-content-md-start">

                        <a href="{{route('revisor.history')}}" class="btn btn-info"><i class="fa-solid fa-clock-rotate-left me-2"></i>{{ __('ui.Cronologia revisioni') }}</a>

                    </div>

                    <div class="col-md-6 d-flex justify-content-center justify-content-md-end">

                        @if($prevArticle)

                            @if ($date->diffInMinutes($prevArticle->updated_at) <= 1)

                                <form action="{{route('revisor.undo-article' , ['id'=> $prevArticle->id])}}" method="post">

                                    @csrf

                                    @method('PATCH')

                                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-rotate-left me-2"></i>{{ __('ui.Annulla operazione precedente') }}</button>

                                </form>

                            @endif

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </section>

    

    <!-- Dati del annuncio -->

    @if($article)

    <section class="container py-3 shadow px-3 rounded-3 border border-1 border-primary border-opacity-25 mb-5 bianco-sporco">
        <div class="row justify-content-around justify-content-md-between ">
            <div class="col-2 d-flex align-items-center justify-content-start">
                <form action="{{route('revisor.accept-article' , ['id'=> $article])}}" method="post" >
                    @csrf
                    @method('PATCH') 
                    <button type="submit" class="btn btn-success">{{ __('ui.Approva') }}</button>
                </form>
            </div>
            <div class="col-2 d-flex align-items-center justify-content-end">
                <form action="{{route('revisor.reject-article' , ['id'=> $article])}}" method="post" >
                    @csrf
                    @method('PATCH') 
                    <button type="submit" class="btn btn-danger">{{ __('ui.Rifiuta') }}</button>
                </form>
            </div>
        </div>
        <hr>
        <div class="row px-3 py-5 justify-content-start">
            <div class="col-md-4">
                <div id="carouselExample" class="carousel slide carousel-dark" data-bs-ride="carousel">
                    <div class="carousel-inner slides">
                        @foreach($article->articleImages as $image)
                            <div class="carousel-item position-relative @if($loop->first) active @endif">
                                <img src="{{ asset('storage/' . $article->id . '/crop_1000x1000' . $image->file_name) }}" class="d-block w-100 rounded-4" alt="...">
                                <div class="py-4 ms-2 row">
                                    <div class="col-12 d-flex gap-2">
                                        <p><i class="fa-solid {{$image->adult}} "></i> {{__('ui.Adult')}}</p>
                                        <p><i class="fa-solid {{$image->spoof}} "></i> {{__('ui.Spoof')}}</p>
                                        <p><i class="fa-solid {{$image->medical}} "></i> {{__('ui.Medical')}}</p>
                                        <p><i class="fa-solid {{$image->violence}} "></i> {{__('ui.Violence')}}</p>
                                        <p><i class="fa-solid {{$image->racy}} "></i> {{__('ui.Racy')}}</p>
                                    </div>
                                    <div class="col-12">
                                        @php
                                            $labels_to_string = trim($image->labels, '[]');
                                            $labels_array = explode(',', $labels_to_string);
                                        @endphp
                                        @foreach ($labels_array as $label)
                                            <span class="me-1 badge bg-primary">{{ trim($label, '""') }}</span>
                                        @endforeach
                                    </div>
                                </div>
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
            <div class="col-md-4 mt-4 mt-md-0 px-4 d-flex flex-column gap-3 justify-content-start align-items-start">
                <p><i class="fa-regular fa-lightbulb me-2"></i><strong>Id: </strong>{{$article->id}}</p>
                <p><i class="fa-solid fa-pen-fancy me-2"></i><strong>{{ __('ui.Titolo') }} </strong>{{ ucfirst($article->title) }}</p>
                <p><i class="fa-solid fa-hand-holding-dollar me-2"></i><strong>€ </strong>{{number_format($article->price, 2,',','.' )}}</p>
                <p><i class="fa-solid fa-user-tag me-2"></i><strong>{{ __('ui.Venditore') }} </strong>{{ucfirst($article->user->name)}}</p>
                <p><i class="fa-regular fa-calendar-check me-2"></i><strong>{{ __('ui.Pubblicato il:') }} </strong>{{$article->created_at->format('d/m/Y')}}</p>
            </div>
            <div class="col-md-4 mt-4 mt-md-0 d-flex flex-column align-items-start px-4 px-md-0">
                <p class="text-start"><i class="fa-solid fa-align-left me-2"></i><strong>{{ __('ui.Testo dell\'annuncio') }}</strong></p>
                <p>{{ ucfirst($article->content) }}</p>
            </div>
        </div>
    </section>

    @endif

    

    

</x-layout>