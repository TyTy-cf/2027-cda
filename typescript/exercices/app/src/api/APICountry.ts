import {FetchRequest} from "../FetchRequest.ts";
import {ICountry} from "../interfaces/ICountry.ts";

export class APICountry {

    private readonly rootUrl: string = 'src/json/countries.json';
    private readonly _countries: Promise <ICountry[]>;
    private readonly fetchRequest: FetchRequest = new FetchRequest();

   constructor() {
        this._countries = this.fetchRequest.get<ICountry[]>(this.rootUrl);
   }


    get countries(): Promise<ICountry[]> {
        return this._countries;
    }
}
