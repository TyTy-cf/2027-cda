import { Fetch } from "./exo-8.ts";
import { Iquote } from "./Iquote.ts";
import { ISound } from "./ISound.ts";

export class KaamelottApi {
	private baseUrl: string = "https://kaamelott.xyz/api/v1";

	public getRandomQuote(): Promise<Iquote> {
		return new Fetch()
			.get<Iquote>(this.baseUrl + "/quote/random")
			.then((quote: Iquote) => {
				return quote;
			});
	}

	public getRandomSound(): Promise<ISound> {
		return new Fetch()
			.get<ISound>(this.baseUrl + "/sound/random")
			.then((sound: ISound) => {
				return sound;
			});
	}

	public getAllQuotes(): Promise<Array<Iquote>> {
		return new Fetch()
			.get<Array<Iquote>>(this.baseUrl + "/quote/all")
			.then((quotes: Array<Iquote>) => {
				return quotes;
			});
	}

	public getAllSounds(): Promise<Array<ISound>> {
		return new Fetch()
			.get<Array<ISound>>(this.baseUrl + "/sound/all")
			.then((sounds: Array<ISound>) => {
				return sounds;
			});
	}
}
