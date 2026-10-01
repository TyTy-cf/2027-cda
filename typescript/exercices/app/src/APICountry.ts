import {ICountry} from "./interfaces/i-country.ts";
import {FetchRequest} from "./FetchRequest.ts";

export class APICountry {

    private _api: string = "src/json/countries.json";
    private _countries: Promise<ICountry[]>;

    constructor() {
        this._countries = new FetchRequest().get<ICountry[]>(this._api);
    }

    get getCountry(): Promise<ICountry[]>  {
        return this._countries
    }


}