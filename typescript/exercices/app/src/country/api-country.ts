import {FetchRequest} from "../FetchRequest.ts";
import {ICountry} from "./i-country.ts";

export class ApiCountry {

    private readonly _fetchRequest: FetchRequest | undefined;
    private readonly _countries: Promise<ICountry[]>;

    constructor() {
        this._fetchRequest = new FetchRequest();
        this._countries = this._fetchRequest
                            .get<ICountry[]>('src/json/countries.json');
    }

    get countries(): Promise<ICountry[]> {
        return this._countries;
    }

}