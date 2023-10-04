<!-- Navbar -->


<nav class="navbar navbar-expand-xxl bg-3 shadow" data-bs-theme="dark">
  <div class="container">
    <a class="navbar-brand text-light" href="{{ route('home') }}">
      <img src="{{asset('storage/site/soloLogo.png')}}" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
      INFINITYsell
    </a>
    <div class="gap-1 me-auto d-flex">
      <p class="m-0 nav-link active">
        <x-_locale class="flag" lang="it" nation="it" value="it"/>
      </p>
      <p class="m-0 nav-link active">
       <x-_locale class="flag" lang="en" nation="gb" value="gb"/>
      </p>
      <p class="m-0 nav-link active">
       <x-_locale class="flag" lang="ro" nation="ro" value="ro"/>
      </p>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto d-flex gap-4">
        <a class="nav-link active text-light" aria-current="page" href="{{route('home')}}">{{ __('ui.Home') }}</a>
        <a class="nav-link text-light" href="{{route('article.index')}}">{{ __('ui.Tutti gli annunci') }}</a>
        <li class="nav-item dropdown">
          <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          {{ __('ui.Categorie') }}
          </a>
          <ul class="dropdown-menu bg-3">
            @foreach ($categories as $category)
            <li><a class="dropdown-item" href="{{ route('article.category', ['category' => $category->id]) }}">  @if (App::getLocale() == 'it') {{ucfirst( $category->ita)}}  @elseif(App::getLocale() == 'en') {{ucfirst($category->en)}} @else {{ucfirst($category->ro)}} @endif  </a> </li> 
            @endforeach
          </ul>
        </li>
        
        @if(auth()->check())
          @if(auth()->user()->is_revisor)
          <li>
            <a href="{{route('revisor.index')}}" class="nav-link active position-relative">
            {{ __('ui.Revisiona annunci') }}
                @livewire('to-be-revisioned-counter')
            </a>
          </li>
          @endif
        @else
        <a class="nav-link text-light mt-1" href="{{route('login')}}" style="font-size: 0.8rem;"><i class="fa-solid fa-user me-2" style="font-size: 0.8rem;"></i>{{ __('ui.Login') }}</a>
        <!-- <a class="nav-link text-light mt-1" href="{{route('register')}}" style="font-size: 0.8rem;"><i class="fa-solid fa-user-plus me-2" style="font-size: 0.8rem;"></i>{{ __('ui.Registrati') }}</a> -->
        @endif
          
       
        @if (auth()->check())
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             <i class="fa-regular fa-user me-2 small"></i><span class="small">{{ucfirst(auth()->user()->name)}}</span>
            </a>
            <ul class="dropdown-menu bg-3">
              <li>
                <a class="dropdown-item" href="{{route('user.profile', ['name'=>Str::slug(auth()->user()->name)])}}">{{__('ui.Il tuo profilo')}}</a>
              </li>
              <li>
                <a class="dropdown-item" href="{{route('user.articles')}}">{{__('ui.I tuoi annunci')}}</a>
              </li>
              <li>
                <a class="dropdown-item" href="{{route('user.preferiti')}}">{{__('ui.Preferiti')}}</a>
              </li>
              <li>
                <a class="dropdown-item" href="{{route('article.create')}}"><i class="fa-solid fa-plus me-2"></i>{{ __('ui.Pubblica') }}</a>
              </li>
              <!-- <li><a class="dropdown-item" href="#"></a></li> -->
              <li><hr class="dropdown-divider"></li>
              <li> 
                <form action="/logout" method="post">
                  @csrf
                  <button type="submit" class="btn my-btn text-light"><i class="fa-solid fa-right-from-bracket"></i> {{ __('ui.Logout') }}</button>
                </form>
              </li>
            </ul>
          </li>
         
        @endif
        <form class="d-flex align-items-center" role="search" method="GET" action="{{route('article.ricerca')}}">
            <input class="h-75 form-control me-2 bg-transparent form-control-sm" type="search" placeholder="{{__('ui.Cerca annunci...')}}" aria-label="Search" name="cerca">
            <button class="btn btn-outline-light btn-sm" type="submit">{{ __('ui.Cerca') }}</button>
          </form>
      </div>
    </div>
  </div>
</nav>

@if (session('empty'))
    <div class="alert alert-warning nav-error my-0" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">
        <p class="text-start m-0">{{ session('empty') }}</p>
    </div>
@endif