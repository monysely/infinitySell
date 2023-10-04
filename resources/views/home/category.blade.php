<x-layout>

<x-slot name="title">InfinitySell - @if (App::getLocale() == 'it') {{ucfirst( $category->ita)}}  @elseif(App::getLocale() == 'en') {{ucfirst($category->en)}} @else {{ucfirst($category->ro)}} @endif</x-slot>

<!-- Categorie -->

<!-- Sezione Hero -->
<x-second-hero/>


<section class="container py-5">
    <div class="row">
        <div class="container">
            <div class="row">
                <p class="text-center py-3 fs-5">
                    {{ __('ui.Esplora la categoria') }} @if (App::getLocale() == 'it') {{ucfirst( $category->ita)}}  @elseif(App::getLocale() == 'en') {{ucfirst($category->en)}} @else {{ucfirst($category->ro)}} @endif
                </p>
                @forelse($articles as $article)
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 animate__animated animate__flipInX">
                    <a href="{{ route('article.detail', ['title'=> Str::slug($article->title), 'id'=>$article->id]) }}" class="text-decoration-none text-dark">
                        <div class="card mb-5 border-0 position-relative bianco-sporco">
                            <img src="{{ asset('storage/' . $article->id . '/crop_1000x1000' . $article->articleImages()->first()->file_name) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h4 class="card-title text-truncate">{{ ucfirst($article->title) }}</h4>
                                <p class="card-text text-truncate text-black-50">{{ ucfirst($article->content) }}</p>
                                <p class="card-text text-black-50 small">{{ __('ui.Pubblicato il:') }} {{$article->created_at->format('d/m/Y')}}</p> 
                                <p class="card-text"></p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mx-3">
                                <p>
                                    @if ($article->stars)
                                        @for ($i=0;$i<$article->stars /  $article->votants;$i++)
                                            <i class="fa-solid fa-star text-warning"></i>
                                        @endfor
                                    @endif
                                </p>
                                <p class="text-black-50">{{ (!$article->clicks) ? '0' : $article->clicks }} {{__('ui.visite')}}</p>
                            </div>
                            
                            <div class="card-footer d-flex align-items-center justify-content-around">
                                <p class="card-text m-0 w-50">€ {{number_format($article->price, 2,',','.' )}}</p>
                                <p class="border-start border-1 ps-4 m-0 text-truncate"><i class="fa-regular fa-circle-user me-2"></i>{{ucfirst($article->user->name)}}</p>
                            </div>
                            
                            <div class="position-absolute bagde bg-2 text-white ms-2 mt-2 px-1 rounded-3 top-0 start-0 small">
                                <a href="{{route('article.category',['category' => $article->category_id])}}" class="text-decoration-none text-white">
                                @if (App::getLocale() == 'it') {{ucfirst($article->category->ita)}}  @elseif(App::getLocale() == 'en') {{ucfirst($article->category->en)}} @else {{ucfirst($article->category->ro)}} @endif 
                                </a>
                            </div>
                            
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12 col-md-8 d-flex justify-content-end align-items-center ">
                    <p class="text-center m-0">{{ __('ui.Non ci sono annunci da visualizzare per questa categoria, inseriscine uno nuovo:') }} </p>
                </div>
                <div class="col-12 mt-4 mt-md-0 col-md-4 d-flex justify-content-center justify-content-md-start">
                    <a href="{{route('article.create')}}" class="btn btn-success">{{ __('ui.Inserisci annuncio') }}</a>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
</x-layout>