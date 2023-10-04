const categoryCards = document.querySelector('#categoryCards');
categoryCards.classList.add('opacity-0');

const ultimiAnnunci = document.querySelector('#ultimiAnnunci');
ultimiAnnunci.classList.add('opacity-0');

const bottoneUltimiAnnunci = document.querySelector('#bottoneUltimiAnnunci');
bottoneUltimiAnnunci.classList.add('opacity-0');

const announcementsCard = document.querySelectorAll('.announcementsCard');
announcementsCard.forEach(card => {
    card.classList.add('opacity-0');
});

const comeFunzionaCont = document.querySelector('#comeFunzionaCont');
comeFunzionaCont.classList.add('opacity-0');

const comeFunzionaSinistra = document.querySelector('#comeFunzionaSinistra');
comeFunzionaSinistra.classList.add('opacity-0');

const comeFunzionaDestra = document.querySelector('#comeFunzionaDestra');
comeFunzionaDestra.classList.add('opacity-0');

const corrieri = document.querySelector('#corrieri');
corrieri.classList.add('opacity-0');

const candidatiBTN = document.querySelector('#candidatiBTN');

//! funzione standard per determinare l'altezza dell'elemento in quella parte dello schermo.
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

$( document ).ready(function() {
    categoryCards.classList.remove('opacity-0');
    categoryCards.classList.add('animate__animated', 'animate__fadeInLeft');
});
window.addEventListener('scroll',()=>{
    
    if(isInViewport(ultimiAnnunci)){
        ultimiAnnunci.classList.remove('opacity-0');
        ultimiAnnunci.classList.add('animate__animated', 'animate__fadeInLeft');
        bottoneUltimiAnnunci.classList.remove('opacity-0');
        bottoneUltimiAnnunci.classList.add('animate__animated', 'animate__fadeInRight');
    }

    announcementsCard.forEach(card => {
        if(isInViewport(card)){
            card.classList.remove('opacity-0');
            card.classList.add('animate__animated', 'animate__flipInX');
            comeFunzionaCont.classList.remove('opacity-0');
            comeFunzionaCont.classList.add('animate__animated', 'animate__fadeIn');
        }
    });

    if(isInViewport(comeFunzionaSinistra)){
        comeFunzionaSinistra.classList.remove('opacity-0');
        comeFunzionaDestra.classList.remove('opacity-0');
        comeFunzionaSinistra.classList.add('animate__animated', 'animate__fadeInLeft');
        comeFunzionaDestra.classList.add('animate__animated', 'animate__fadeInRight');
    }

    if(isInViewport(corrieri)){
        corrieri.classList.remove('opacity-0');
        corrieri.classList.add('animate__animated', 'animate__rubberBand');
    }

    if(isInViewport(candidatiBTN)){
        candidatiBTN.classList.add('animate__animated', 'animate__heartBeat', 'animate__repeat-3');
    }
})







