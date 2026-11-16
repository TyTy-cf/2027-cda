import {KaamelottApi} from "./kaamelottApi.ts";

const kAPI = new KaamelottApi();

kAPI.getAllQuotes()
    .then(quotes => {
        console.log(quotes);
    });
kAPI.getRandomQuote()
    .then(quote => {
        let content = document.getElementById('quote-content');
        let character = document.getElementById('quote-character');
        let season = document.getElementById('quote-season');
        let episode = document.getElementById('quote-episode');

        if (content) {
            content.textContent = quote.content;
        }
        if (character) {
            character.textContent = quote.characts;
        }
        if (season) {
            season.textContent = quote.season;
        }
        if (episode) {
            episode.textContent = quote.episode;
        }
    });

kAPI.getRandomSound()
    .then(sound => {
        let soundDiv = document.getElementById('quote-audio');
        let soundTag = document.createElement('audio');
        soundTag.controls = true;
        soundTag.src = sound.path;

        if (soundDiv) {
            soundDiv.appendChild(soundTag);
        }
    })

