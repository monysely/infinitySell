<section class="py-5 bg-3 text-white container-fluid">
    <section class="container">
        <div class="row">
            <div class="col-12 col-md-5">
                <div class="row">
                    <div class="col-6 d-flex align-content-center">
                        <img src="{{ asset('storage/site/logoOrizzontale.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
                <p class="small">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Autem atque quas ipsa iusto voluptate sunt, illum amet! Nisi quidem voluptates architecto iure dolorum, placeat in!
                </p>

                
            </div>
    
            <div class="col-6 col-md-3 d-flex flex-column justify-content-start mt-5 gap-3 align-items-start align-items-md-center">
                <p class="h3">{{ __('ui.Esplora') }}</p>
                <a href="{{ route('home') }}" class="text-decoration-none text-warning small">{{ __('ui.Home') }}</a>
                <a href="{{ route('login') }}" class="text-decoration-none text-warning small">{{ __('ui.Login') }}</a>
                <a href="{{ route('register') }}" class="text-decoration-none text-warning small">{{ __('ui.Registrati') }}</a>
                <a href="{{ route('article.index') }}" class="text-decoration-none text-warning small">{{ __('ui.Tutti gli annunci') }}</a>
            </div>
    
            <div class="col-6 col-md-3 d-flex flex-column justify-content-start mt-5 gap-3 align-items-end align-items-md-end">
                <p class="h3">{{ __('ui.Link Utili') }}</p>
                <a href="" class="text-decoration-none text-warning font-medium small">{{ __('ui.Privacy policy') }}</a>
                <a href="" class="text-decoration-none text-warning font-medium small">{{ __('ui.Termini di servizio') }}</a>
                <a href="{{route('candidatura')}}" class="text-decoration-none text-warning font-medium small">{{ __('ui.Lavora con noi') }}</a>
            </div>
        </div>
    </section>

    <hr>

    <!-- parte bassa del footer -->
    <section class="container">
        <div class="row pt-5 justify-content-between">
            <div class="col-12 col-md-4 d-flex justify-content-center gap-4">
                <a href="https://www.facebook.com/?locale=it_IT" target="_blank" class="text-decoration-none text-white"><p class="m-0"><i class="fa-brands fa-facebook-f fa-2x"></i></p></a>
                <a href="https://twitter.com/?lang=it" target="_blank" class="text-decoration-none text-white"><p class="m-0"><i class="fa-brands fa-x-twitter fa-2x"></i></p></a>
                <a href="https://www.instagram.com/" target="_blank" class="text-decoration-none text-white"><p class="m-0"><i class="fa-brands fa-instagram fa-2x"></i></p></a>
                <a href="https://it.linkedin.com/" target="_blank" class="text-decoration-none text-white"><p class="m-0"><i class="fa-brands fa-linkedin-in fa-2x"></i></p></a>
            </div>

            <div class="col-12 col-md-4 py-3 py-md-0 d-flex justify-content-center align-items-center">
                <p class="m-0 text-center small font-medium text-white-50">
                {{ __('ui.All rights reserved ®INFINITYsell.it 2023') }}
                </p>
            </div>

            <div class="col-12 col-md-3 d-flex justify-content-center justify-content-md-end">
                <p><i class="fa-regular fa-envelope-open me-2 text-warning"></i><a href="mailto:infinitysell@info.it" class="text-decoration-none text-white">infinitysell@info.it</a></p>
            </div>
        </div>
    </section>
</section>

