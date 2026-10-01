import {FetchRequest} from "./FetchRequest.ts";
import {ICountry} from "./interfaces/i-country.ts";
import {ICountrySelector} from "./interfaces/i-countrySelector.ts";

export class APICountry{

    private readonly _fetchRequest: FetchRequest | undefined;
    private readonly_countries: Promise<ICountry>;

    constructor(){
        this._fetchRequest = new FetchRequest();
        this._countries = this._fetchRequest
            .get<ICountry[]>("src/json/countries.json")
    }

get countries(): Promise<ICountry>{
        return this._countries;
}
}