import {FetchRequest} from "./FetchRequest.ts";
import {Iquote} from "./interfaces/Iquote.ts";
import {IsoundQuote} from "./interfaces/IsoundQuote.ts";

export class KaamelottApi {
    private quoteUrl: string = "https://kaamelott.xyz/api/v1/quote/random";
    private quoteSoundUrl: string = "https://kaamelott.xyz/api/v1/sound/random";

    public getRandomQuote(): Promise<Iquote>
    {
        return new FetchRequest()
            .get<Iquote>(this.quoteUrl)
            .then((response: Iquote) => {
                return response;
            });
    }

    public getRandomSoundQuote(): Promise<IsoundQuote>
    {
        return new FetchRequest()
            .get<IsoundQuote>(this.quoteSoundUrl)
            .then((response: IsoundQuote) => {
                return response;
            });
    }
}