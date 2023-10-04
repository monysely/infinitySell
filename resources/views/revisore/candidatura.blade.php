<x-layout>
    <x-slot name="title">InfinitySell - {{ __('ui.Lavora con noi') }}</x-slot>

    
    
    <x-second-hero />
    <x-error />
    @if (session('success'))
    <div class="alert alert-success" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">
        {{ session('success') }}
    </div>
    @endif
    @if (session('fail'))
    <div class="alert alert-danger" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">
        {{ session('fail') }}
    </div>
    @endif
    <section class="container-fluid py-5">
        <div class="container">
            <div class="row" id="lavoraConNoi">
                <p class="display-6 text-center">{{ __('ui.Lavora con noi') }}</p>
                <p class="text-center mb-5">{{ __('ui.Vuoi essere dei nostri? Unisciti a noi e revisiona i nostri annunci') }}</p>
                <div class="col-12 col-xl-6 d-none d-xl-block">
                    <img src="{{ asset('storage/site/lavoraconnoi.png') }}" alt="" class="img-fluid">
                </div>
                <div class="col-12 col-md-12 col-xl-6 bg-transparent p-4 d-flex flex-column align-items-center justify-content-center">
                    <p class="text-center fs-2">{{ __('ui.Vuoi revisionare i nostri annunci?') }}</p>
                    <form action="{{route('become.revisor')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">{{ __('ui.Carica il tuo CV') }} ({{ __('ui.formati amessi:') }} doc, odt, pdf)</label>
                            <input type="file" name="file" class="form-control shadow">
                        </div>
                        <div class="mt-5 d-flex justify-content-center">
                            <button type="submit" class="btn bg-2 my-btn btn-lg shadow">{{ __('ui.Candidati') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
</x-layout>