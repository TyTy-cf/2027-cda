import {ILanguage} from "./ILanguage.ts";

export interface ICountry {
    area: number;
    cioc: string;
    name: string;
    flag: string;
    region: string;
    capital: string;
    demonym: string;
    languages: ILanguage[];
    subregion: string;
    timezones: string[];
    alpha2Code: string;
    alpha3Code: string;
    nativeName: string;
    population: number;
    independent: boolean;
    populationDensity: number;
}