import {ApiCountry} from "./api-country.ts";

export class CountrySelector {
    private readonly _element: HTMLElement | null;
    private readonly _apicountry: ApiCountry | undefined;

    constructor(selector: string|HTMLElement) {
        if (selector instanceof HTMLElement){

        }
    }

    private async createInput(): Promise<void> {
        const inputElement: HTMLInputElement = document.createElement('input');
        inputElement.classList.add('form-control','mt-5');
        inputElement.type = 'search';

        inputElement.addEventListener('input', ()=>{
            const value: string = inputElement.value.trim().toLocaleLowerCase();

            if (value.length >= 2){
                this._apicountry?.countries.then(()=>{

                });
                console.log(value);
            }
        });

        this._element?.appendChild(inputElement);
    }
}