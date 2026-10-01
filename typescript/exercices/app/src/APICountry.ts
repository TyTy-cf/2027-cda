import { CountrySelector } from "./country-selector.ts";
import { ICountrySelector } from "./i-country-selector.ts";

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
				await new CountrySelector().getAllCountries();

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
					numberOfCountry++;
				}
			}
		});
	}
});
