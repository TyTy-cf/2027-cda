import {KaamelottApi} from "./KaamelottApi.ts"
import {Iquote} from "./interfaces/Iquote.ts";
import {IsoundQuote} from "./interfaces/IsoundQuote.ts";


function initQuote(x: number = 1): void {
    const body = document.querySelector("body");
    
    for (let i = 0; i < x; i++) {
        new KaamelottApi().getRandomQuote()
            .then((iQuote: Iquote)=>{

                const card = document.createElement('div');
                card.classList.add('card');
                card.classList.add('mt-5');

                const cardBody = document.createElement('div');
                cardBody.innerText = iQuote.content;
                cardBody.classList.add('card-body');

                const cardFooter = document.createElement('div');
                cardFooter.innerText = 'Par ' + iQuote.characts + ' : ' + iQuote.episode + ' (' + iQuote.season + ')';
                cardFooter.classList.add('card-footer');

                card.appendChild(cardBody);
                card.appendChild(cardFooter);

                if (body){
                    body.appendChild(card);
                    card.appendChild(cardBody);
                    card.appendChild(cardFooter);
                }

                // promesse connue dans le then
            });
    }


    // promesse pas connue en dehors du then
}

function soundQuote(): void {
    new KaamelottApi().getRandomSoundQuote()
        .then((iSoundQuote: IsoundQuote)=>{
            const body = document.querySelector("body");
            const sound = document.createElement("audio");
            const name = document.createElement("p")
            sound.src = iSoundQuote.path;
            sound.controls = true;
            name.innerHTML = iSoundQuote.name;

            if (body){
                body.appendChild(sound);
                sound.before(name);
            }

            // promesse connue dans le then
        });

    // promesse pas connue en dehors du then
}


window.addEventListener("load", () => {
    soundQuote();
    initQuote(10);
});