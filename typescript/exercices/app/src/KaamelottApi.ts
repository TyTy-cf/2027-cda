import { Fetch } from "./exo-8.ts";
import { Iquote } from "./Iquote.ts";

export class KaamelottApi {
	private baseUrl: string = "https://kaamelott.xyz/api/v1/quote/random";

	public getRandomQuote(): Promise<Iquote> {
		return new Fetch()
    .get<Iquote>(this.baseUrl)
    .then((quote: Iquote) => {
			return quote;
		});
	}
}
