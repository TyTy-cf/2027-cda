import {APICountry} from "./api/APICountry.ts";
import {ICountry} from "./interfaces/ICountry.ts";


export class CountrySelector {
    private readonly _apiCountry: APICountry|undefined;
    private readonly _element: HTMLElement|null;
    private _input: HTMLInputElement|undefined;
    private _dp: HTMLUListElement|undefined;
    constructor(selector: string|HTMLElement) {
        if (selector instanceof HTMLElement) {
            this._element = selector;
        } else {
            this._element = document.querySelector(selector);
        }

        if (!this._element) return;
        this._apiCountry = new APICountry();
        this.addInput();
        this.addDropdown();
        document.body.appendChild(this._element);
        this.initEvents();
    }
    get input(): HTMLInputElement | undefined {
        return this._input;
    }

    set input(value: HTMLInputElement | undefined) {
        this._input = value;
    }

    get dp(): HTMLUListElement | undefined {
        return this._dp;
    }

    set dp(value: HTMLUListElement | undefined) {
        this._dp = value;
    }
    private addInput(): void{
        if (!this._element) return;
        this._input = document.createElement('input');
        this._input.type = 'search';
        this._element.appendChild(this._input);
    }

    private addDropdown():void{
        if (!this._element || !this._apiCountry) return;
        this._dp = document.createElement('ul');
        this._dp.style.display = 'none';
        this._element.appendChild(this._dp);
    }

    private initEvents(): void{
        if (!this._input) return;
        this._input.addEventListener('input', () => {
            if (!this._input) return;
            this.feedSuggestions(this._input.value);
        });
    }

    private feedSuggestions (inputed: string){
        if (!this._apiCountry) return;
        inputed = inputed.trim().toLowerCase();

        this._apiCountry.countries.then((countries) => {
            for (const country of countries){
                if (country.name.toLowerCase().includes(inputed)){
                    this.addLi(country);
                }
            }
        });
    }

    private addLi (country: ICountry){

    }
}
