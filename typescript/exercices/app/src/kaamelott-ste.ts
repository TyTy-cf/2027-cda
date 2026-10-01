import {KaamelottApi} from "./KaamelottApi.ts";
import {IRandomKaamelott} from "./interfaces/i-random-kaamelott.ts";
import {IRandomSoundKaamelott} from "./interfaces/i-random-sound-kaamelott.ts";

const kaamelottApi: KaamelottApi = new KaamelottApi();

function initQuote() {
    kaamelottApi.getRandomQuote()
        .then((IRandomKaamelott: IRandomKaamelott) => {
        console.log(IRandomKaamelott.id);
        console.log(IRandomKaamelott.content);
        console.log(IRandomKaamelott.characts)
        console.log(IRandomKaamelott.episode);
        console.log(IRandomKaamelott.season);
        })
}

function initSound() {
    kaamelottApi.getRandomSound()
        .then((IRandomSoundKaamelott: IRandomSoundKaamelott) => {
            const container: HTMLDivElement|null = document.querySelector('div.container');
            if (!container) {
                return;
            }

            const audio = document.createElement('audio');
            audio.controls = true;
            audio.src = IRandomSoundKaamelott.path;

            container.appendChild(audio);
        })


    window.addEventListener("load", () => {
        initQuote();
        initSound();
    })
}