import {ICountrySelector} from "./i-country-selector.ts";
import {ILanguage} from "./i-language.ts";

export interface ICountry extends ICountrySelector {
    area: number;
    cioc: string|null;
    region: string;
    capital: string;
    denonym: string;
    languages: ILanguage[];
    subregion: string;
    timezones: string[];
    alpha3Code: string;
    nativeName: string;
    population: number;
    independent: boolean;
    populationDensity: number;
}