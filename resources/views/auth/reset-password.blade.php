<x-layout>

<x-slot name="title">InfinitySell - {{__('ui.Reimposta password')}}</x-slot>



<x-second-hero/>

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status')  }}
    </div>
@endif

<section class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-xl-5 my-md-5 rounded shadow p-5 border border-1 border-primary border-opacity-25 d-flex flex-column justify-content-center animate__animated animate__fadeInRight">
            <div class="row justify-content-center mb-4">
                <div class="col-6">
                <img src="{{ asset('storage/site/logoOrizzontaleNero.png') }}" alt="" class="img-fluid">
                </div>
            </div>

            <form method="post" action="/reset-password">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">{{__('ui.Indirizzo e-mail *')}}</label>
                    <input type="email" name="email" class="form-control shadow  border border-1 border-opacity-25 border-primary" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('email')}}" placeholder="mail@example.it">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">{{__('ui.Password *')}}</label>
                    <input type="password" name="password"  class="form-control shadow border border-1 border-opacity-25 border-primary" id="exampleInputPassword1" placeholder="{{__('ui.password')}}">
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">{{__('ui.Ripeti password')}}</label>
                    <input type="password" name="password_confirmation"  class="form-control shadow border border-1 border-opacity-25 border-primary" id="exampleInputPassword1" placeholder="{{__('ui.conferma password')}}">
                </div>
                <input type="text" name="token" hidden value="{{request()->route('token')}}" >
                <div class="d-flex justify-content-evenly align-items-center col-12 mb-2">
                    <button type="submit" class="btn bg-2 my-btn shadow w-100">{{__('ui.Reimposta password')}}</button>
                </div>
            </form>
        </div>
    </div>
</section>


</x-layout>