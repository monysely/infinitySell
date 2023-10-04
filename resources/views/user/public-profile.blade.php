
<x-layout>

    <second-hero />
    
    <x-slot name="title">InfinitySell - {{ __('ui.Profilo') }}</x-slot>

    
    
    
    <section class="container py-5">
        <h3 class="text-center py-5 fst-italic"> {{__('ui.Profilo di')}} {{ucfirst($user->name)}}</h3>
        <div class="row shadow rounded-5 py-5 border border-1 border-warning border-opacity-25 justify-content-center" >
            <div class="col-md-3 p-3 d-flex flex-column justify-content-center align-items-center">
                <img src="https://images.pexels.com/photos/13326901/pexels-photo-13326901.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" class="img-fluid rounded-circle" alt="">
                <p class="h5 text-center pt-3">{{ucfirst($user->name)}}</p>
                <p>{{__('ui.Membro dal')}}: {{$user->created_at->format('d/m/Y')}}</p>
                @if($user->id !== auth()->user()->id)
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">{{__('ui.Pubblica recensione')}}</button>
                @endif
            </div>
            <div class="col-md-7 ps-md-5 offset-md-1 border-start border-warning border-opacity-25 d-flex flex-column justify-content-around">
                @if($user->email_verified_at)  <p> {{__('ui.Utente verificato')}} <i class="fa-solid fa-shield-halved" style="color: #359740;"></i></p> @else <p class="text-danger">{{__('ui.Email da verificare')}} <i class="fa-solid fa-exclamation text-danger"></i></p> @endif
                <p><i class="fa-regular fa-envelope me-2 text-violet"></i>E-mail : {{$user->email}}</p>
                <a href="{{route('user.user-articles', ['name'=>Str::slug($user->name), 'id'=>$user->id])}}" class="text-decoration-none text-dark"><p><i class="fa-regular fa-pen-to-square me-2 text-violet"></i>{{__('ui.Annunci pubblicati')}}: {{ $articles_counter }}</p></a>
                <div class="row flex-column flex-md-row">
                    <div class="col-6 d-flex align-items-center">
                        <p><i class="fa-solid fa-user-gear me-2 text-violet"></i>{{__('ui.Ruolo')}} : @if($user->is_revisor) {{__('ui.revisore')}} @else User </a> @endif </p>
                    </div>
                    <div class="col-6 d-flex align-items-center justify-content-start">
                        <p>@if($user->is_revisor)  @endif</p>
                    </div>
                </div>
                <hr>
                <div class="row m-0">
                    <div class="col-md-6 d-flex flex-column">
                       @if(count($reviews) > 0)
                            <div class="row p-md-2 p-1 border border-1 border-warning shadow mb-3 rounded-4 d-flex flex-lg-column justify-content-around">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6 d-flex justify-content-start align-items-center">
                                            <p class="small">{{__('ui.Ultima recensione:')}}</p>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-end align-items-center">
                                            <p class="small">{{$reviews->first()->created_at->format('d/m/Y')}}</p>
                                        </div>
                                    </div>
                                    @foreach ($utenti as $utente)
                                        @if ($utente->id == $reviews->first()->writer_id)
                                            <p class="h6 mb-4"><i class="fa-regular fa-circle-user me-2"></i>{{ $utente->name }}</p>
                                        @endif
                                    @endforeach
                                    <p class="small">{{ $reviews->first()->content }}</p>
                                    
                                </div>
                            </div>
                        @else
                            <p>{{__('ui.L\'utente non ha ancora ricevuto recensioni.')}}</p>
                       @endif
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-center justify-content-md-end mt-4 mt-md-0">
                        <button class="btn btn-info text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">{{__('ui.Le recensioni di')}} {{ $user->name }}</button>
                    </div>

                    <div class="row">
                        <div class="col-12 position-relative">
                            @if (session('success'))
                                <p class="alert alert-success index-error position-absolute bottom-0 d-flex align-items-center" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">
                                    {{ session('success') }}
                                </p>
                            @endif

                            @if (session('fail'))
                                <p class="small alert alert-danger index-error position-absolute bottom-0 d-flex align-items-center" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">
                                    {{ session('fail') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('ui.Nuova Recensione')}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="recensione" method="POST" action="{{ route('user.leaveReview', ['user_id'=>$user->id]) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="review_message" class="col-form-label">{{__('ui.Testo:')}}</label>
                                <textarea class="form-control" id="review_message" name="review_message" placeholder="{{__('ui.Scrivi la tua recensione')}}"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__('ui.Annulla')}}</button>
                        <button type="submit" class="btn btn-success" form="recensione">{{__('ui.Pubblica recensione')}}</button>
                       
                    </div>
                    </div>
                </div>
            </div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasRightLabel">{{__('ui.Le recensioni di')}} {{ $user->name }}</h5>
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
    