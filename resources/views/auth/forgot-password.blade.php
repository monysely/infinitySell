<x-layout>

<x-slot name="title">InfinitySell - {{__('ui.Recupera password')}} </x-slot>



<x-second-hero/>

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<section class="container py-5">
    <div class="row justify-content-center px-1 px-md-0">
        <div class="col-12 col-md-10 col-xl-5 my-md-5 rounded shadow p-5 border border-1 border-primary border-opacity-25 d-flex flex-column justify-content-center animate__animated animate__fadeInRight">
            <div class="row justify-content-center mb-4">
                <div class="col-6">
                <img src="{{ asset('storage/site/logoOrizzontaleNero.png') }}" alt="" class="img-fluid">
                </div>
            </div>

            <form method="post" action="/forgot-password">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">{{__('ui.Indirizzo e-mail *')}}</label>
                    <input type="email" name="email" class="form-control shadow  border border-1 border-opacity-25 border-primary" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('email')}}" placeholder="mail@example.it">
                </div>
                <div class="d-flex justify-content-evenly align-items-center col-12 mb-2">
                    <button type="submit" class="btn bg-2 my-btn shadow w-100">{{__('ui.Reimposta password')}} </button>
                </div>
            </form>
        </div>
    </div>
</section>


</x-layout>