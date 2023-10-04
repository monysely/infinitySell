const buttonUp = document.querySelector('.button-up');
const flags = document.querySelectorAll('.flag');

buttonUp.addEventListener('click',()=>{
    window.scrollTo(0,0);
})

// EVENTO DI ASCOLTO SU FINESTRA PER CAPIRE L'ALTEZZA

window.addEventListener('scroll',()=>{
    if(window.scrollY >= 700){
        buttonUp.classList.remove('d-none')
    }else {
        buttonUp.classList.add('d-none');
    }
})


// EVENTO ASCOLTO SUI TASTI BANDIERA E LOADING SCREEN
flags.forEach(flag=>{
    flag.addEventListener('click',()=>{
        $('body').css({'overflow':'hidden'});
        $(document).bind('scroll',function () { 
            window.scrollTo(0,0); 
        });

        let whiteSpace = document.createElement('div');
        whiteSpace.classList.add('vh-100', 'd-block', 'position-absolute', 'top-0', 'bg-white', 'w-100', 'bg-opacity-50', 'd-flex', 'justify-content-center', 'align-items-center');
        whiteSpace.style.backdropFilter  = 'blur(3px)';


    let ciao = '';
    if(flag.childNodes[1].className == 'fi fi-it'){
        ciao = 'Caricamento';
    }else if(flag.childNodes[1].className == 'fi fi-gb'){
        ciao = 'Loading';
    }else {
        ciao = 'Se încarcă';
    }
    
    let spinners = `
        <div class="loader">${ciao}
            <span></span>
        </div>`;


        whiteSpace.innerHTML = spinners;
        document.body.appendChild(whiteSpace);
    })
    $(document).unbind('scroll'); 
      $('body').css({'overflow':'visible'});
})











