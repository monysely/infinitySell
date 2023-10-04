<x-layout>

<x-slot name="title">InfinitySell - {{__('ui.Login')}}</x-slot>


<x-error/>

@if (session('status'))
    <div class="alert alert-success">
      {{session('status')  }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3500)">
      {{session('success')  }}
    </div>
@endif

@if (session('fail'))
    <div class="alert alert-danger" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3500)">
      {{session('fail')  }}
    </div>
@endif

    <!-- Login Page -->

    <section class="container rounded mt-5">
        <div class="row aling-items-center justify-content-center mt-md-5">

            <div class="col-md-6 my-md-5 py-md-5 rounded d-flex align-items-center justify-content-center animate__animated animate__fadeInLeft d-none d-xl-block">
              <img src="{{asset('storage/site/undraw_secure_login_pdn4.png')}}" alt="" class="img-fluid">
            </div>
        
            <div class="col-12 col-md-10 col-xl-5 my-md-5 rounded shadow p-5 border border-1 border-primary border-opacity-25 d-flex flex-column justify-content-center animate__animated animate__fadeInRight">
                <div class="row justify-content-center mb-4">
                  <div class="col-6">
                    <img src="{{ asset('storage/site/logoOrizzontaleNero.png') }}" alt="" class="img-fluid">
                  </div>
                </div>

                <small class=" d-flex justify-content-end text-danger">{{__('ui.I campi con * sono obbligatori!')}}</small>
                <form method="post" action="/login">
                    @csrf
                    <div class="mb-3">
                      <label for="email" class="form-label">{{__('ui.Indirizzo e-mail *')}}</label>
                      <input type="email" name="email" class="form-control shadow  border border-1 border-opacity-25 border-primary" placeholder="mail@example.it" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('email')}}">
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label">{{__('ui.Password *')}}</label>
                      <input type="password" name="password" class="form-control rounded shadow border border-1 border-opacity-25 border-primary" placeholder="{{__('ui.password')}} " id="exampleInputPassword1">
                    </div>
                    <div class="mb-3 form-check">
                      <input type="checkbox" name="remember" class="form-check-input shadow border border-1 border-opacity-25 border-primary" id="exampleCheck1">
                      <label class="form-check-label" for="remember">{{__('ui.Rimani connesso')}}</label>
                    </div>
                    <div class="mb-3 small">
                      <a href="/forgot-password">{{__('ui.Password dimenticata?')}}</a>
                    </div>
                    <div class="mb-3 text-black-50 d-flex justify-content-start align-items-end small">
                      <p>{{__('ui.Non hai un account?')}}
                      <a href="{{route('register')}}">{{__('ui.Registrati')}} </a>
                      </p>
                    </div>

                    <div class="d-flex justify-content-evenly align-items-center col-12 mb-2">
                        <button type="submit" class="btn bg-2 my-btn shadow w-100">{{__('ui.Accedi')}} <i class="fa-solid fa-bag-shopping ms-1"></i></button>
                    </div>
                    <div class="d-flex justify-content-evenly align-items-center col-12">
                      <a href="/auth/redirect" class="btn btn-secondary shadow w-100">{{__('ui.Accedi con')}}<i class="fa-brands fa-github ms-1"></i></a>
                    </div>
                    <div class="d-flex justify-content-evenly align-items-center col-12 mt-2">
                      <a href="{{ url('auth/google') }}" class="btn btn-outline-dark w-100">{{__('ui.Accedi con')}}<i class="fa-brands fa-google ms-1"></i></a>
                    </div>
                  </form>
            </div>
        </div>
    </section>



</x-layout>