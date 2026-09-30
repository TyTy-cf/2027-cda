import {IKaamelott} from "./interfaces/i-kaamelott.ts";
import {KaamelottApi} from "./KaamelottApi.ts";

window.addEventListener("load",()=>{
    new KaamelottApi()
        .getRandomQuote()
        .then(response =>{

            console.log(response);
        });

    new KaamelottApi()
        .getRandomQuote()
        .then(response =>{
            console.log(response);
        });
})