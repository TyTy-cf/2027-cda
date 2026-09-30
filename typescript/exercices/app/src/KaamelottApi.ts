import {FetchRequest} from "./FetchRequest.ts";
import {Iquote} from "./interfaces/Iquote.ts";

export class KaamelottApi {
    private quoteUrl: string = "https://kaamelott.xyz/api/v1/quote/random";
    public getRandomQuote(): Promise<Iquote>
    {
        return new FetchRequest()
            .get<Iquote>(this.quoteUrl)
            .then((response: Iquote) => {
                return response;
            });
    }
}