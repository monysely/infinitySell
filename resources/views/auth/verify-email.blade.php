<x-layout>

<x-slot name="title">InfinitySell - {{__('ui.Verifica Email')}}</x-slot>


    <x-second-hero/>
@if (session('status') == 'verification-link-sent')
    <div class="alert alert-success">
    {{__('ui.Una nuova mail è stata inviata al tuo idirizzo!')}}
    </div>
@endif

<div class="container py-5 mt-5">
    <div class="row flex-column align-items-center">
        <div class="col-12 col-md-8">
            <p class="text-center">
            {{__('ui.Abbiamo inviato una mail di verifica al tuo indirizzo di posta, procedi con la validazione per poter utilizzare la nostra piattaforma!')}}
            </p>
        </div>
            <form class="col-12 col-md-4 mt-4 d-flex justify-content-center align-items-center"  action="/email/verification-notification" method="post" >
                @csrf
                <p class="m-0">{{__('ui.Non hai ricevuto la mail?')}}</p>
                <button type="submit" class="btn text-decoration-underline text-primary">{{__('ui.inviala di nuovo')}}</button>
            </form>
    </div>
</div>

</x-layout>