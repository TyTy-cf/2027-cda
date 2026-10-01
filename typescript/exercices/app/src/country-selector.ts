import { Fetch } from "./Fetch.ts";
import { ICountrySelector } from "./i-country-selector.ts";

export class CountrySelector {
	public getCountry(): Promise<ICountrySelector> {
		return new Fetch()
			.get<ICountrySelector[]>("src/json/countries.json")
			.then((countries: ICountrySelector[]) => {
				if (countries.length === 0) {
					throw new Error("well that's bad");
				}

				return countries[Math.floor(Math.random() * countries.length)]!;
			});
	}

	public getAllCountries(): Promise<ICountrySelector[]> {
		return new Fetch()
			.get<ICountrySelector[]>("src/json/countries.json")
			.then((countries: ICountrySelector[]) => {
				if (countries.length === 0) {
					throw new Error("well that's bad");
				}
				return countries;
			});
	}
}
