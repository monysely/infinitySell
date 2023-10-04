const contatori = document.querySelector('#contatori');
contatori.classList.add('opacity-0');


const contPubblicati = document.querySelector('#contPubblicati');
contPubblicati.classList.add('opacity-0');
const contRecensioni = document.querySelector('#contRecensioni');
contRecensioni.classList.add('opacity-0');
const contSpediti = document.querySelector('#contSpediti');
contSpediti.classList.add('opacity-0');
const contRegistrati = document.querySelector('#contRegistrati');
contRegistrati.classList.add('opacity-0');

const annunciPubblicati = document.querySelector('#annunciPubblicati');
const recensioni = document.querySelector('#recensioni');
const articoliSpediti = document.querySelector('#articoliSpediti');
const utentiRegistrati = document.querySelector('#utentiRegistrati');


const totalAnnunci = parseInt(annunciPubblicati.innerHTML);
const totalRecensioni = parseInt(recensioni.innerHTML);
const totalSpediti = parseInt(articoliSpediti.innerHTML);
const totalRegistrati = parseInt(utentiRegistrati.innerHTML);




function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }
    
let counted = false;
window.addEventListener('scroll',()=>{
        if(isInViewport(contatori) && !counted){
                let counterAnnunci = 0;
                let counterRecensioni = 0;
                let counterSpediti = 0;
                let counterUtenti = 0;
                let i = 0;
                let speed = 50;

                contatori.classList.remove('opacity-0');
                contatori.classList.add('opacity-75', 'animate__slower', 'animate__animated', 'animate__fadeIn');
                contPubblicati.classList.remove('opacity-0');
                contPubblicati.classList.add('animate__slow', 'animate__animated', 'animate__fadeIn');
                contRecensioni.classList.remove('opacity-0');
                contRecensioni.classList.add('animate__slow', 'animate__animated', 'animate__fadeIn');
                contSpediti.classList.remove('opacity-0');
                contSpediti.classList.add('animate__slow', 'animate__animated', 'animate__fadeIn');
                contRegistrati.classList.remove('opacity-0');
                contRegistrati.classList.add('animate__slow', 'animate__animated', 'animate__fadeIn');
                setInterval(() => {
                        if(counterAnnunci < totalAnnunci){
                                counterAnnunci++;
                                annunciPubblicati.innerHTML = counterAnnunci;
                                if(counterAnnunci == totalAnnunci){
                                        counted = true;
                                }
                        }
                        if(counterRecensioni < totalRecensioni){
                                counterRecensioni++;
                                recensioni.innerHTML = counterRecensioni;
                                if(counterRecensioni == totalRecensioni){
                                        counted = true;
                                }
                        }
                
                        if(counterSpediti < totalSpediti){
                                counterSpediti++;
                                articoliSpediti.innerHTML = counterSpediti;
                                if(counterSpediti == totalSpediti){
                                        counted = true;
                                }
                        }
                        if(counterUtenti < totalRegistrati){
                                counterUtenti++;
                                utentiRegistrati.innerHTML = counterUtenti;
                                if(counterUtenti == totalRegistrati){
                                        counted = true;
                                }
                        }
                }, speed);
        }
})