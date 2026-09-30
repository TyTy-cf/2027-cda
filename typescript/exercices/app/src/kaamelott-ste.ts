import {FetchRequest} from "./FetchRequest.ts";
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
            console.log(IRandomSoundKaamelott.name);
            console.log(IRandomSoundKaamelott.path);
        })
}


window.addEventListener("load", () => {
    initQuote();
    initSound();
})