import {FetchRequest} from "./FetchRequest.ts";
import {IRandomKaamelott} from "./interfaces/i-random-kaamelott.ts";
import {IRandomSoundKaamelott} from "./interfaces/i-random-sound-kaamelott.ts";

export class KaamelottApi {

    private _api: string = "https://kaamelott.xyz";

    public getRandomQuote() {
       return (new FetchRequest())
            .get<IRandomKaamelott>(this._api + '/api/v1/quote/random')
}


    public getRandomSound() {
        return (new FetchRequest())
            .get<IRandomSoundKaamelott>(this._api + '/api/v1/sound/random')
    }
}