import { FetchRequest } from "./FetchRequest.ts";
import { IKaamelottQuote } from "./interfaces/i-kaamelott-quote.ts";
import { ISound } from "./interfaces/i-sound.ts";

export class KaamelottApi {
    private readonly fetchRequest = new FetchRequest();
    private readonly rootUrl = "https://kaamelott.xyz";

    public getRandomQuote(): Promise<IKaamelottQuote> {
        return this.fetchRequest.get<IKaamelottQuote>(
            `${this.rootUrl}/api/v1/quote/random`
        );
    }

    public getAllQuotes(): Promise<IKaamelottQuote[]> {
        return this.fetchRequest.get<IKaamelottQuote[]>(
            `${this.rootUrl}/api/v1/quote/all`
        );
    }

    public getRandomSound(): Promise<ISound> {
        return this.fetchRequest.get<ISound>(
            `${this.rootUrl}/api/v1/sound/random`
        );
    }
}