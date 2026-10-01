import {ILanguage} from "./i-language.ts";
import {ICountrySelector} from "./i-country-selector.ts";

export interface ICountry extends ICountrySelector{
    area: number,
    cioc: string,
    region: string,
    capital: string,
    demonym: string,
    languages: Array<ILanguage>,
    subregion: string,
    timezones: string[],
    alpha3Code: string,
    nativeName: string,
    population: number,
    independent: boolean,
    populationDensity: number,
}