import { FetchRequest } from "./FetchRequest.ts";
import { ICountry } from "./interfaces/a-i-country.ts";

export class APICountry {

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