import {FetchRequest} from "./FetchRequest.ts";
import {IKQuote} from "./interfaces/iKQuote.ts";
import {IKSound} from "./interfaces/iKSound.ts";

export class KaamelottApi {
    public async getRandomQuote(): Promise<IKQuote> {
        return await (new FetchRequest())
            .get<IKQuote>('https://kaamelott.xyz/api/v1/quote/random');
    }

    public async getRandomSound(): Promise<IKSound> {
        return await (new FetchRequest())
            .get<IKSound>('https://kaamelott.xyz/api/v1/sound/random');
    }

    public async getAllQuotes(): Promise<IKQuote[]> {

        let quoteMap: Array<IKQuote> = [];
        let quotes: string|null = localStorage.getItem('quotes');

        if (quotes !== null) {
            quoteMap = JSON.parse(quotes);
            return quoteMap;
        }

        await (new FetchRequest())
            .get<Array<IKQuote>>('https://kaamelott.xyz/api/v1/quote/all')
            .then(response => {
                response.forEach(element => {
                    quoteMap.push(element);
                });

                //console.log(JSON.stringify(quoteMap));
                localStorage.setItem('quotes', JSON.stringify(quoteMap));
            });

        return quoteMap;
    }
}