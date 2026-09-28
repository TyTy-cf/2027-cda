export function salute(firstname: string, language: string): string {
    if (language == "fr"){
        return "Bonjour " + firstname;
    } else if (language == "en"){
        return "Hello " + firstname;
    } else if (language == "pt"){
        return "Oi " + firstname;
    } else {
        return "Unsupported language" ;
    }
}