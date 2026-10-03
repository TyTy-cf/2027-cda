import {ICountrySelector} from "./a-i-country-selector.ts";

export interface ICountryLanguage {
    name: string;
    nativeName?: string;
}

export interface ICountry extends ICountrySelector{
    area: number | null;
    cioc: string | null;
    region: string;
    capital: string | null;
    demonym: string;
    languages: ICountryLanguage[];
    subregion: string;
    timezones: string[];
    alpha3Code: string;
    nativeName: string;
    population: number;
    independent: boolean;
    populationDensity: number | null;
}