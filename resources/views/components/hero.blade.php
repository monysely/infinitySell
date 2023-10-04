<section class="container-fluid shadow">
    <div class="row overflow-hidden">
        <div class="col-12 p-0 hero-main position-relative" style="background-image: url('{{asset('storage/site/bghero.jpg')}}');">
            <div class="position-absolute main-velina row">
                <div class="col-md-6 d-flex flex-column align-items-end justify-content-center px-5 text-white offset-md-5">
                    <h1 class="text-end display-1 hero-title">{{ __('ui.Compra e vendi') }} <br> {{ __('ui.ciò che vuoi.') }}</h1>
                    <p class="text-end sub-title-hero mt-4 mt-md-0 text-white-50">{{ __('ui.Il marketplace più cliccato d\'Italia') }}</p>
                    <p><i class="fa-solid fa-arrow-pointer ms-1 me-1 fa-3x"></i></p>
                    <div class="col-12 p-2 rounded-3 bg-transparent shadow border border-1 border-white border-opacity-50 d-none d-xxl-block">
                        <form class="row" method="post" action="{{ route('article.search') }}">
                            @csrf
                            <div class="col-10">
                                <select class="form-select" name="category" aria-label="Default select example">
                                    <option selected value="">{{ __('ui.Seleziona una categoria') }}</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}"> @if (App::getLocale() == 'it') {{ucfirst( $category->ita)}}  @elseif(App::getLocale() == 'en') {{ucfirst($category->en)}} @else {{ucfirst($category->ro)}} @endif  </option> 
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2 d-flex justify-content-start">
                                <button type="submit" class="btn bg-2 my-btn w-100">{{ __('ui.Cerca') }}</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 mt-3 hero-category d-none d-md-flex">
                        <p class="m-0 d-none d-xl-block">{{ __('ui.Le più popolari:') }}</p> 
                        <a href="/annunci/categoria/10" class="ms-3 sub-categories">{{ __('ui.Abbigliamento') }}</a>
                        <a href="/annunci/categoria/3" class="ms-3 sub-categories">{{ __('ui.Elettrodomestici') }}</a>
                        <a href="/annunci/categoria/2" class="ms-3 sub-categories">{{ __('ui.Informatica') }}</a>
                        <a href="/annunci/categoria/1" class="ms-3 sub-categories">{{ __('ui.Motori') }}</a>
                        <a href="/annunci/categoria/8" class="ms-3 sub-categories">{{ __('ui.Telefonia') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>