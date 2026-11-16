import {ApiCountry} from "./api-country.ts";
import {ICountry} from "./i-country.ts";

export class CountrySelector {

    private readonly _element: HTMLElement | null;
    private _apiCountry: ApiCountry | undefined;

    constructor(selector: string|HTMLElement) {
        if (selector instanceof HTMLElement) {
            this._element = selector;
        } else {
            this._element = document.querySelector(selector);
        }

        if (!this._element) return;

        this._apiCountry = new ApiCountry();
        this.createInput();
    }

    private createInput(): void {
        const searchContainer: HTMLDivElement = document.createElement('div');
        searchContainer.classList.add('position-relative', 'mt-5');

        const inputElement: HTMLInputElement = document.createElement('input');
        inputElement.classList.add('form-control');
        inputElement.type = 'search';

        const ulElement = document.createElement('ul');
        ulElement.classList.add('position-absolute', 'w-100', 'list-unstyled', 'd-none', 'overflow-y-auto');
        ulElement.style.height = '20rem';
        ulElement.style.zIndex = '1';
        ulElement.style.backgroundColor = 'white';

        this._apiCountry?.countries.then((countries) => {
            for (const indexCountry in countries) {
                // @ts-ignore
                const country: ICountry = countries[indexCountry];

                const liElement = document.createElement('li');
                liElement.classList.add('w-100', 'd-flex', 'border', 'custom-hover');
                liElement.style.height = '4rem';
                liElement.style.cursor = 'pointer';

                const imgElement = document.createElement('img');
                imgElement.classList.add('img-fluid', 'border-end', 'w-25', 'object-fit-cover');
                imgElement.src = country.flag;

                const pElement = document.createElement('p');
                pElement.classList.add('ms-5', 'w-75', 'my-auto');
                pElement.textContent = country.name;

                liElement.appendChild(imgElement);
                liElement.appendChild(pElement);

                liElement.addEventListener('click', () => {
                    const containerCountryShow: HTMLDivElement|null = document.querySelector('div.country-show');
                    if (!containerCountryShow) return;

                    containerCountryShow.innerHTML = '';

                    let languages: string = '';
                    for (const language of country.languages) {
                        languages += language.name + ', ';
                    }
                    languages = languages.slice(0, languages.length - 2);

                    let timeZones: string = '';
                    for (const timeZone of country.timezones) {
                        timeZones += timeZone + ', ';
                    }
                    timeZones = timeZones.slice(0, timeZones.length - 2);

                    const imgElement2 = document.createElement('img');
                    imgElement2.classList.add('img-fluid', 'border-end', 'w-25', 'object-fit-cover');
                    imgElement2.src = country.flag;

                    containerCountryShow.appendChild(imgElement2);
                    containerCountryShow.appendChild(this.createParagraphByLabel('Nom', country.name));
                    containerCountryShow.appendChild(this.createParagraphByLabel('Code', country.alpha2Code));
                    containerCountryShow.appendChild(this.createParagraphByLabel('Capitale', country.capital));
                    containerCountryShow.appendChild(this.createParagraphByLabel('Langues parlées', languages));
                    containerCountryShow.appendChild(this.createParagraphByLabel('Population', country.population));
                    containerCountryShow.appendChild(this.createParagraphByLabel('Surface', country.area + 'm²'));
                    containerCountryShow.appendChild(this.createParagraphByLabel('Continent', country.region));
                    containerCountryShow.appendChild(this.createParagraphByLabel('Fuseaux horaires', timeZones));

                    ulElement.classList.add('d-none');
                    inputElement.value = country.name;
                });

                ulElement.appendChild(liElement);
            }
        });

        inputElement.addEventListener('click', () => {
            ulElement.classList.toggle('d-none')
        });

        inputElement.addEventListener('input', () => {
            const value: string = inputElement
                                    .value
                                    .trim()
                                    .toLowerCase();

            ulElement.classList.remove('d-none');

            if (value.length >= 2) {
                for (const child of ulElement.children) {
                    if (!child.innerHTML.toLowerCase().includes(value)) {
                        child.classList.add('d-none');
                    } else {
                        child.classList.remove('d-none');
                    }
                }
            } else {
                for (const child of ulElement.children) {
                    child.classList.remove('d-none');
                }
            }
        });

        searchContainer.appendChild(inputElement);
        searchContainer.appendChild(ulElement);
        this._element?.appendChild(searchContainer);
    }

    private createParagraphByLabel(label: string, content: string|number): HTMLParagraphElement {
        const paragraph = document.createElement('p');
        paragraph.innerHTML = '<strong>' + label + '</strong> : ' + content;
        return paragraph;
    }

}