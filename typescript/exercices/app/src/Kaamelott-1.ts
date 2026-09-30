import {KaamelottApi} from "./KaamelottApi.ts"
import {Iquote} from "./interfaces/Iquote.ts";

function initQuote(): void {
    new KaamelottApi().getRandomQuote()
        .then((iQuote: Iquote)=>{
            const body = document.querySelector("body");
            const content = document.createElement("p");
            const character = document.createElement("p");
            const season = document.createElement("p");
            const episode = document.createElement("p");

            character.innerHTML = iQuote.characts;
            content.innerHTML = iQuote.content;
            season.innerHTML = iQuote.season;
            episode.innerHTML = iQuote.episode;

            if (body){
                body.appendChild(character);
                character.after(content);
                content.after(season);
                season.after(episode);
            }

            // promesse connue dans le then
        });

    // promesse pas connue en dehors du then
}


window.addEventListener("load", () => {
    initQuote();
});