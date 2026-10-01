import {APICountry} from "./APICountry.ts";


export class CountrySelector {

    private readonly _ApiCountry: APICountry|undefined;
    private _input: HTMLInputElement;

    constructor(parentSelector: string) {
        this._ApiCountry = new APICountry();

        const parent = document.querySelector<HTMLElement>(parentSelector);
        if (parent === null) {
            throw new Error(`Élément introuvable : ${parentSelector}`);
        }

        const searchBar = document.createElement("input");
        searchBar.type = "text";
        searchBar.placeholder = "Rechercher un pays";

        searchBar.addEventListener("input", (event) => {
            
        });

        parent.appendChild(searchBar);
        
    }

}