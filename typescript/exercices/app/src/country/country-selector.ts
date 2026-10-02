import { ApiCountry } from "./api-country.ts";
import { ICountry } from "./i-country.ts";

export class CountrySelector {
  private readonly _element: HTMLElement | null;
  private _apiCountry: ApiCountry | undefined;

  constructor(selector: string | HTMLElement) {
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
    const searchContainer: HTMLDivElement = document.createElement("div");
    searchContainer.classList.add("position-relative", "mt-5");

    const inputElement: HTMLInputElement = document.createElement("input");
    inputElement.classList.add("form-control");
    inputElement.type = "search";

    const ulElement = document.createElement("ul");
    ulElement.classList.add(
      "position-absolute",
      "w-100",
      "list-unstyled",
      "d-none",
      "overflow-y-auto",
    );
    ulElement.style.height = "20rem";

    const countryInfo: HTMLDivElement = document.createElement("div");
    countryInfo.classList.add(
      "w-100",
      "list-unstyled",
      "d-none",
      "overflow-y-auto",
    );
    countryInfo.style.height = "20rem";

    this._apiCountry?.countries.then((countries) => {
      for (const indexCountry in countries) {
        // @ts-ignore
        const country: ICountry = countries[indexCountry];

        const liElement = document.createElement("li");
        liElement.classList.add("w-100", "d-flex", "border", "clickable");
        liElement.style.height = "4rem";

        const imgElement = document.createElement("img");
        imgElement.classList.add("img-fluid", "border-end", "w-25");
        imgElement.src = country.flag;

        const pElement = document.createElement("p");
        pElement.classList.add("ms-5", "w-75", "my-auto");
        pElement.textContent = country.name;

        liElement.appendChild(imgElement);
        liElement.appendChild(pElement);

        liElement.addEventListener("click", () => {
          countryInfo.classList.remove("d-none");
          countryInfo.innerHTML = `
            <h3>${country.name}</h3>
            <img src="${country.flag}" alt="${country.name} flag" class="img-fluid border-end w-25" />
            <p>Capital: ${country.capital}</p>
            <p>Region: ${country.region}</p>
            <p>Population: ${country.population}</p>
          `;

          ulElement.classList.add("d-none");
        });

        ulElement.appendChild(liElement);
        searchContainer.appendChild(countryInfo);
      }
    });

    inputElement.addEventListener("click", () => {
      ulElement.classList.toggle("d-none");
      countryInfo.classList.add("d-none");
    });

    inputElement.addEventListener("input", () => {
      const value: string = inputElement.value.trim().toLowerCase();

      ulElement.classList.remove("d-none");

      if (value.length >= 2) {
        for (const child of ulElement.children) {
          if (!child.innerHTML.toLowerCase().includes(value)) {
            child.classList.add("d-none");
          } else {
            child.classList.remove("d-none");
          }
        }
      } else {
        for (const child of ulElement.children) {
          child.classList.remove("d-none");
        }
      }
    });

    searchContainer.appendChild(inputElement);
    searchContainer.appendChild(ulElement);
    this._element?.appendChild(searchContainer);
  }
}
