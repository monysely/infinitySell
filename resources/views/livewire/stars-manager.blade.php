<div>
    <div class="row">
        <p class="small" id="myMessage">{{ __('ui.Valuta l\'annuncio!') }}</p>
        <div class="col-1 m-0 p-0 ms-2"><p class="m-0" wire:click="uno"><i class="fa-regular fa-star stella"></i></p></div>
        <div class="col-1 m-0 p-0"><p class="m-0" wire:click="due"><i class="fa-regular fa-star stella"></i></p></div>
        <div class="col-1 m-0 p-0"><p class="m-0" wire:click="tre"><i class="fa-regular fa-star stella"></i></p></div>
        <div class="col-1 m-0 p-0"><p class="m-0" wire:click="quattro"><i class="fa-regular fa-star stella"></i></p></div>
        <div class="col-1 m-0 p-0"><p class="m-0" wire:click="cinque"><i class="fa-regular fa-star stella"></i></p></div>
    </div>
    <div class="row">
        <p>{{ $message }}</p>
    </div>
</div>

<script>
    const stars = document.querySelectorAll('.stella');

    stars.forEach((star, index)=>{
        star.addEventListener('click',()=>{
            setTimeout(() => {
                star.classList.remove('fa-regular');
                star.classList.add('text-warning', 'fa-solid');
                for (let i = 0; i < index; i++) {
                    stars[i].classList.remove('fa-regular');
                    stars[i].classList.add('text-warning', 'fa-solid');
                    $mex = document.querySelector('#myMessage');
                    $mex.classList.add('d-none');
                }
            }, 250);
        })
    })

    stars.forEach(star=>{
        star.addEventListener('mouseover',()=>{
            star.style.cursor = 'pointer';
        })
    })
</script>
