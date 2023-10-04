
<x-layout>

    <second-hero />
    
    <x-slot name="title">InfinitySell - {{ __('ui.Profilo') }}</x-slot>
    
    
    <section class="container py-5">
        <h3 class="text-center py-5 fst-italic">{{__('ui.Benvenuto sul tuo profilo')}}</h3>
        <div class="row shadow rounded-5 py-5 border border-1 border-warning border-opacity-25 justify-content-center" >
            <div class="col-md-3 p-3 d-flex flex-column justify-content-center align-items-center">
                <img src="https://images.pexels.com/photos/13326901/pexels-photo-13326901.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" class="img-fluid rounded-circle" alt="">
                <p class="h5 text-center pt-3">{{ucfirst(auth()->user()->name)}}</p>
                <p>{{__('ui.Membro dal')}}: {{auth()->user()->created_at->format('d/m/Y')}}</p>
            </div>
            <div class="col-md-7 ps-5 offset-md-1 border-start border-warning border-opacity-25 d-flex flex-column justify-content-around">
                @if(auth()->user()->email_verified_at)  <p> {{__('ui.Utente verificato')}} <i class="fa-solid fa-shield-halved" style="color: #359740;"></i></p> @else <p class="text-danger">{{__('ui.Email da verificare')}} <i class="fa-solid fa-exclamation text-danger"></i></p> @endif
                <p><i class="fa-regular fa-envelope me-2 text-violet"></i>E-mail : {{auth()->user()->email}}</p>
                <a href="{{route('user.articles')}}" class="text-decoration-none text-dark"><p><i class="fa-regular fa-pen-to-square me-2 text-violet"></i>{{__('ui.Annunci pubblicati')}}: {{ $articles_counter }}</p></a>
                <div class="row flex-column flex-md-row">
                    <div class="col-6 d-flex align-items-center">
                        <p><i class="fa-solid fa-user-gear me-2 text-violet"></i>{{__('ui.Ruolo')}} : @if(auth()->user()->is_revisor) {{__('ui.revisore')}} @else User </a> @endif </p>
                    </div>
                    <div class="col-6 d-flex align-items-center justify-content-start">
                        <p>@if(auth()->user()->is_revisor)  @else  <a href="{{route('candidatura')}}" class="btn my-btn-3 bg-3-transparent text-white">{{__('ui.Diventa revisore')}}</a> @endif </p>
                    </div>
                </div>
                <hr>
                <div class="row mt-3">
                    <div class="col-6 d-flex justify-content-start align-items-center">
                        @if(count($reviews) > 0)
                            <button class="btn btn-warning text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">{{__('ui.Recensioni')}}</button>
                        @else
                            <p>{{__('ui.Ci dispiace, non hai ancora ricevuto nessuna recensione...')}}</p>
                        @endif
                    </div>
                    <div class="col-6 d-flex justify-content-start justify-content-md-end">
                        <form action="{{ route('user.delete') }}" method="post" class="d-flex" id="eliminaProfilo">
                            @csrf
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">{{__('ui.Elimina profilo')}}</button>
                        </form>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('ui.Elimina profilo')}}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ __('ui.questa operazione') }} <span class="text-danger">{{ __('ui.irreversibile') }}</span>, {{ __('ui.sei sicuro') }}
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('ui.Annulla') }}</button>
                                <button class="btn btn-danger" type="submit" form="eliminaProfilo">{{ __('ui.conferma') }}</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasRightLabel">{{__('ui.Le mie recensioni')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    @forelse ($reviews as $review)
                        <div class="row p-2 border border-1 border-warning shadow mb-3 rounded-4 d-flex flex-lg-column justify-content-around">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end align-items-center">
                                        <p class="small">{{$review->created_at->format('d/m/Y')}}</p>
                                    </div>
                                </div>
                                @foreach ($utenti as $utente)
                                    @if ($utente->id == $review->writer_id)
                                        <p class="h6 mb-4"><i class="fa-regular fa-circle-user me-2"></i>{{ $utente->name }}</p>
                                    @endif
                                    
                                @endforeach
                                <p class="small">{{ $review->content }}</p>
                                
                            </div>
                        </div>
                    @empty
                        <p>{{ $user->name }} {{__('ui.non ha ancora nessuna recensione!')}}</p>
                    @endforelse
                </div>
            </div>
        </div>

    </section>
    
    
    
    
    
    </x-layout>
    