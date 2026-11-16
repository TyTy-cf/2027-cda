import {CountrySelector} from "./country/country-selector.ts";

window.addEventListener('load', () => {
   new CountrySelector('div.selector-input');
});