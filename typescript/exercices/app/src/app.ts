import {FetchRequest} from "./FetchRequest.ts";
import {IPokemon} from "./interfaces/i-pokemon.ts";

(new FetchRequest())
    .get<IPokemon>('https://pokeapi.co/api/v2/pokemon/garchomp')
    .then((response) => {
        for (const iStat of response.stats) {
            console.log(iStat.base_stat + " " + iStat.stat.name);
        }
    });