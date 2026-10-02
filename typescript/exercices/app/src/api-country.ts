import { SomethingSelector } from "./something-selector.ts";
import { ICountrySelector } from "./i-country-selector.ts";
import { ICountry } from "./i-country.ts";

const url = "src/json/countries.json";

const style = document.createElement("style");
//text color white
style.textContent = `
  .country-card:hover {
    background-color: var(--bs-secondary) !important;
    color: var(--bs-light) !important;
    cursor: pointer;
  }
`;

document.head.appendChild(style);

window.addEventListener("load", async () => {
	const countryContainer: HTMLDivElement | null =
		document.querySelector("#countrycontainer");
	const countrySearchInput: HTMLInputElement | null =
		document.querySelector("#searchinput");

	if (countrySearchInput && countryContainer) {
		countrySearchInput.addEventListener("input", async (e) => {
			let value = (countrySearchInput as HTMLInputElement).value;
			countryContainer.innerHTML = "";
			let countries: ICountrySelector[] =
				await new SomethingSelector<ICountrySelector>(url).getAll();

			let qty: number = 10;
			let numberOfCountry: number = 0;

			for (let country of countries) {
				if (numberOfCountry >= qty) {
					break;
				}

				if (country.name.toLowerCase().includes(value.toLowerCase())) {
					const cardElement: HTMLDivElement =
						document.createElement("div");
					cardElement.classList.add(
						"card",
						"p-2",
						"m-2",
						"bg-light",
						"flex",
						"flex-row",
						"justify-content-between",
						"align-items-center",
					);
					cardElement.classList.add("country-card");
					const countryElement: HTMLParagraphElement =
						document.createElement("p");
					const flagElement: HTMLImageElement =
						document.createElement("img");
					countryElement.textContent = country.name;
					flagElement.src = country.flag;
					flagElement.classList.add(
						"w-25",
						"h-25",
						"rounded-full",
						"object-cover",
					);
					cardElement.appendChild(flagElement);
					cardElement.appendChild(countryElement);
					countryContainer.appendChild(cardElement);

					cardElement.addEventListener("click", async () => {
						countryContainer.innerHTML = "";
						countrySearchInput.value = country.name;

						let selectedCountry: ICountry =
							await new SomethingSelector<ICountry>(url).getOne(
								country.alpha2Code,
							);

						const selectedCountryElement: HTMLDivElement =
							document.createElement("div");
						selectedCountryElement.classList.add(
							"selected-country",
							"d-flex",
							"align-items-center",
							"gap-2",
							"card",
							"p-2",
							"m-2",
							"bg-light",
							"flex",
							"flex-column",
							"justify-content-between",
							"align-items-center",
						);

						const selectedFlagElement: HTMLImageElement =
							document.createElement("img");
						selectedFlagElement.src = country.flag;
						selectedFlagElement.classList.add(
							"w-25",
							"h-25",
							"rounded-full",
							"object-cover",
						);

						const selectedCountryNameElement: HTMLParagraphElement =
							document.createElement("p");
						selectedCountryNameElement.textContent =
							"name: " + country.name;

						const selectedCountryAlpha2CodeElement: HTMLParagraphElement =
							document.createElement("p");
						selectedCountryAlpha2CodeElement.textContent =
							"alpha2Code: " + country.alpha2Code;

						const selectedCountryRegionElement: HTMLParagraphElement =
							document.createElement("p");
						selectedCountryRegionElement.textContent =
							"region: " + selectedCountry.region;

						const selectedCountryCapitalElement: HTMLParagraphElement =
							document.createElement("p");
						selectedCountryCapitalElement.textContent =
							"capital: " + selectedCountry.capital;

						const selectedCountrySubregionElement: HTMLParagraphElement =
							document.createElement("p");
						selectedCountrySubregionElement.textContent =
							"subregion: " + selectedCountry.subregion;

						const selectedCountryPopulationDensityElement: HTMLParagraphElement =
							document.createElement("p");
						selectedCountryPopulationDensityElement.textContent =
							"populationDensity: " +
							selectedCountry.populationDensity;

						selectedCountryElement.appendChild(selectedFlagElement);
						selectedCountryElement.appendChild(
							selectedCountryNameElement,
						);
						selectedCountryElement.appendChild(
							selectedCountryAlpha2CodeElement,
						);
						selectedCountryElement.appendChild(
							selectedCountryRegionElement,
						);
						selectedCountryElement.appendChild(
							selectedCountryCapitalElement,
						);
						selectedCountryElement.appendChild(
							selectedCountrySubregionElement,
						);
						selectedCountryElement.appendChild(
							selectedCountryPopulationDensityElement,
						);
						selectedCountryElement.appendChild(
							selectedCountryNameElement,
						);

						countryContainer.appendChild(selectedCountryElement);
					});
					numberOfCountry++;
				}
			}
		});
	}
});
