<x-layout>

<x-slot name="title">InfinitySell - {{__('ui.Registrati')}}</x-slot>


    <x-error/>

    <!-- Register Page -->

    <section class="container py-5 mt-5 rounded">
      <div class="row justify-content-center align-items-center flex-row-reverse">
          <div class="col-md-6 my-md-5 py-md-5 rounded d-flex align-items-center justify-content-center animate__animated animate__fadeInRight d-none d-xl-block">
            <img src="{{asset('storage/site/signin.png')}}" alt="" class="img-fluid">
          </div>
          <div class="col-12 col-md-10 col-xl-5 my-md-5 rounded shadow p-5 border border-1 border-primary border-opacity-25 d-flex flex-column justify-content-center animate__animated animate__fadeInLeft">
            <div class="row justify-content-center mb-4">
                
              <div class="col-6">
                <img src="{{ asset('storage/site/logoOrizzontaleNero.png') }}" alt="" class="img-fluid">
              </div>
              <small class="d-flex justify-content-end text-danger">{{__('ui.I campi con * sono obbligatori!')}} </small>
              <form method="post" action="/register">
                @csrf
                  <div class="mb-3">
                    <label for="name" class="form-label">{{__('ui.Nome e Cognome *')}}</label>
                    <input type="text" name="name" class="form-control shadow border border-1 border-opacity-25 border-primary" id="name" value="{{old('name')}}" placeholder="Mario Rossi">
                  </div>

                  <div class="mb-3">
                    <label for="email" class="form-label">{{__('ui.Indirizzo e-mail *')}}</label>
                    <input type="email" name="email" class="form-control shadow border border-1 border-opacity-25 border-primary" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('email')}}" placeholder="mail@example.it">
                  </div>

                  <div class="mb-3">
                    <label for="password" class="form-label">{{__('ui.Password *')}}</label>
                    <input type="password" name="password"  class="form-control shadow border border-1 border-opacity-25 border-primary" id="exampleInputPassword1" placeholder="{{__('ui.password')}}">
                  </div>

                  <div class="mb-3">
                    <label for="password_confirmation" class="form-label">{{__('ui.Ripeti password')}}</label>
                    <input type="password" name="password_confirmation"  class="form-control shadow border border-1 border-opacity-25 border-primary" id="exampleInputPassword1" placeholder="{{__('ui.conferma password')}}">
                  </div>

                  <div class="mb-3 text-black-50 d-flex justify-content-start align-items-end small">
                    <p>{{__('ui.Hai già un account?')}}
                    <a href="{{route('login')}}">{{__('ui.Accedi')}}</a>
                    </p>
                  </div>

                  <div class="d-flex justify-content-center align-items-center col-12">
                      <button type="submit" class="btn w-100 bg-2 my-btn shadow">{{__('ui.Registrati')}}</button>
                  </div>
              </form>
            </div>
          </div>
      </div>
    </section>



</x-layout>