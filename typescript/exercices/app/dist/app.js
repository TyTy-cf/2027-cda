import { FetchRequest } from "./FetchRequest.js";
(new FetchRequest())
    .get('https://www.apicountries.com/countries')
    .then((response) => {
    console.log(response);
});
