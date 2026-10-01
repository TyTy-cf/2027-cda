import {ICountryLanguage} from "./i-countryLanguage.ts";

export interface ICountry{
    area: string;
    cioc: string;
    name: string;
    flag: string;
    region: string;
    capital: string;
    denonym: string;
    languages: Array<ICountryLanguage>;
    subregion: string;
    timezones: Array<string>;
    alpha2Code: string;
    alpha3code: string;
    nativeName: string;
    population: number;
    independant: boolean;
    populationDensity: number;
}