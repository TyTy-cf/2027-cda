import { CountrySelector } from "./country-selector.ts";
import { ICountrySelector } from "./i-country-selector.ts";

window.addEventListener("load", async () => {
	localStorage.clear();
	let country: ICountrySelector = await new Country().getCountry();
	const countryContainer: HTMLDivElement | null =
		document.querySelector(".card-body");
	const countryBtn: HTMLButtonElement | null =
		document.querySelector("#getCountry");

	if (countryBtn && countryContainer) {
		const countryElement: HTMLParagraphElement =
			document.createElement("p");
		const flagElement: HTMLImageElement = document.createElement("img");

		countryBtn.addEventListener("click", () => {
			countryContainer.innerHTML = "";
			countryElement.textContent = "";
			console.log(country.name);
			countryElement.textContent = "Country: " + country.name;
			flagElement.src = country.flags.svg;
			countryContainer!.appendChild(countryElement);
			countryContainer!.appendChild(flagElement);
		});
	}
});
