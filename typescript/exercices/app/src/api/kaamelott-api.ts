import {FetchRequest} from "../FetchRequest.ts";
import {IQuote} from "../interfaces/i-quote.ts";
import {ISound} from "../interfaces/i-sound.ts";

export class KaamelottApi {

    private readonly rootUrl: string = 'https://kaamelott.xyz';

    private readonly fetchRequest: FetchRequest = new FetchRequest();

    public getRandomQuote(): Promise<IQuote> {
        return this.fetchRequest
            .get<IQuote>(this.rootUrl + '/api/v1/quote/random');
    }

    public getQuoteById(id: number): Promise<IQuote> {
        return this.fetchRequest
            .get<IQuote>(this.rootUrl + '/api/v1/quote/' + id);
    }

    public getAllQuote(): Promise<IQuote[]> {
        return this.fetchRequest
            .get<IQuote[]>(this.rootUrl + '/api/v1/quote/all');
    }

    public getRandomSound(): Promise<ISound> {
        return this.fetchRequest
            .get<ISound>(this.rootUrl + '/api/v1/sound/random');
    }

}