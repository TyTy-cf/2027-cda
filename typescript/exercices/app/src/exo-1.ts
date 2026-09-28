const firstname :string = "Alice";
const language :string = "fr";
let greetings :string = "";

export function salute(firstname:string, language:string) :string {
switch (language) {
    case "fr":
        greetings = "Bonjour " + firstname;
        break;
    case "en":
        greetings = "Hello " + firstname;
        break;
    case "pt":
        greetings = "Oi " + firstname;
        break;
    default:
        greetings = "Ça marche pô"

}
return greetings;
}