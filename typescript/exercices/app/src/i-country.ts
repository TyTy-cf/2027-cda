import { ICountrySelector } from "./i-country-selector.ts";
import { ILanguage } from "./i-languages.ts";

export interface ICountry extends ICountrySelector {
	region: string;
	capital: string;
	languages: ILanguage[];
	subregion: string;
	populationDensity: number;
}
