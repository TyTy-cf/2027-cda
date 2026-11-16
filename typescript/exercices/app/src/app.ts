import {FetchRequest} from "./FetchRequest.ts";
import {IPokemon} from "./interfaces/i-pokemon.ts";

(new FetchRequest())
    .get('https://www.apicountries.com/countries')
    .then((response) => {
        console.log(response)
    });
