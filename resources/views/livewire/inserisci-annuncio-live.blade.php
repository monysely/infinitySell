<div>
    <!-- Form per inserire l'annuncio -->
    <section class="container py-5 rounded">
        
    <div class="row justify-content-center rounded-3 align-items-center">
        <div class="col-12 col-md-5 py-5 animate__animated animate__fadeInLeft d-none d-xl-block">
            <div class="row">
                <div class="col-12 position-relative">
                    <img src="{{ asset('storage/site/newArticle.png') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>

        <div class="col-12 col-md-10 col-xl-7 animate__animated animate__fadeInRight border border-1 border-primary border-opacity-25 shadow p-5 rounded-3 mt-5 position-relative">
            <p class="fs-4 text-center display-5 mb-5">
            {{ __('ui.Crea il tuo annuncio') }}
            </p>
            <p class="small text-danger text-end">{{ __('ui.I campi con * sono obbligatori') }}</p>
            <div class="mb-3">
                <label for="title" class="form-label">{{ __('ui.Titolo') }} <span class="text-danger">*</span></label>
                <input wire:model="title" wire:model.lazy="title" type="text" name="title" class="form-control shadow border border-1 border-opacity-25 border-primary  @error('title') is-invalid border-danger @enderror " id="title" value="{{old('title')}}" required placeholder="{{ __('ui.Vendo, cerco, usato, nuovo') }}">
                @error('title') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">{{ __('ui.Testo dell\'annuncio') }} <span class="text-danger">*</span></label>
                <textarea wire:model="content" wire:model.lazy="content" type="text" name="content" class="form-control shadow border border-1 border-opacity-25 border-primary @error('content') is-invalid border-danger @enderror" id="content" rows="3" style="resize:none" placeholder="{{ __('ui.Descrivi al meglio il tuo articolo') }}">{{old('content')}} </textarea>
                @error('content') <small class="text-danger">{{ $message }}</small> @enderror
               
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">{{ __('ui.Prezzo') }} <span class="text-danger">*</span></label>
                <input wire:model="price" wire:model.lazy="price" type="number" name="price" class="form-control shadow border border-1 border-opacity-25 border-primary @error('price') is-invalid border-danger @enderror" id="price" value="{{old('price')}}" placeholder="1000" required>
                @error('price') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            
            <div class="mb-3">
                <label for="categories" class="form-label">{{ __('ui.Seleziona una categoria') }} <span class="text-danger">*</span></label>
                <select wire:model.defer="category" wire:model.lazy="category" name="categories" class="form-select shadow border border-1 border-opacity-25 border-primary @error('category') is-invalid border-danger @enderror @if(empty($category)) is-invalid border-danger @endif" aria-label="Default select example" required>
                    <option value="" selected>{{ __('ui.Scegli categoria') }}</option>
                    @foreach($ourCategories as $category)
                    <option value="{{$category->id}}">@if (App::getLocale() == 'it') {{ucfirst( $category->ita)}}  @elseif(App::getLocale() == 'en') {{ucfirst($category->en)}} @else {{ucfirst($category->ro)}} @endif</option>
                    @endforeach
                </select>
                @error('category') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">{{ __('ui.Foto articolo') }} <span class="text-danger">*</span></label>
                <input type="file" name="images" multiple wire:model="temporary_images" class="form-control shadow border border-1 border-opacity-25 border-primary" id="id-{{ $iteration }}" required>
                @error('images') <small class="text-danger">{{ $message }}</small> @enderror
                @error('temporary_images.*') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <div class="row py-4 justify-content-center">
                    @forelse($images as $key => $image)
                        <div class="col-md-3 mb-2 mx-3 position-relative rounded-3" style="height: 15vh; background-size: contain; background-position: center; background-repeat: no-repeat; background-image: url({{$image->temporaryUrl()}});">
                            <button class="btn btn-danger position-absolute top-0 end-0 rounded-circle" wire:click="removeImage({{$key}})" >X</button>
                        </div>
                    @empty
                        <p class="text-center">Non hai caricato ancora nessuna immagine</p> 
                    @endforelse
                </div>
            </div>
            <div class="d-flex flex-column align-items-center mt-5">
                <input wire:click="store" type="submit" class="btn bg-3 my-btn-3 text-white shadow" value="{{ __('ui.Inserisci annuncio') }}">
            </div>

            @if($success)            
                <div class="alert alert-success row position-absolute top-0 mt-5 translate-middle-x start-50 w-75 animate__animated animate__fadeInDown" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">
                    <div class="col-12">
                        <p class="text-center m-0">{{ $success }}</p>
                    </div>
                </div>
            @endif
            
            @if($fail)
                <div class="alert alert-danger row position-absolute top-0 mt-5 translate-middle-x start-50 w-75 animate__animated animate__fadeInDown" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">
                    <div class="col-12">
                        <p class="text-center m-0">{{ $fail }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
</div>
