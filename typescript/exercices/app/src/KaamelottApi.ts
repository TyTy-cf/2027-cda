import {FetchRequest} from "./FetchRequest.ts";
import {IKaamelott} from "./interfaces/i-kaamelott.ts";
import {ISoundkaamelott} from "./interfaces/i-soundkaamelott.ts";

export class KaamelottApi {

    private url: string = "https://kaamelott.xyz";

    public getRandomQuote() {
        return (new FetchRequest())
            .get<IKaamelott>(this.url + "/api/v1/quote/random");
    }

    public getRandomSound(){
        return (new FetchRequest())
            .get<ISoundkaamelott>(this.url + "/api/v1/sound/random");

    }
}