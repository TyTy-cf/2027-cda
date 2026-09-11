const LANGUAGES: Map<string, string>=new Map();
LANGUAGES.set("fr", "Bonjour");
LANGUAGES.set("en", "Hello");
LANGUAGES.set("pt", "Oi");
export function salute(firstname: string, language: string): string {
    if(!LANGUAGES.has(language)){
        return "Unsupported language"
    }
    return LANGUAGES.get(language)+ " " + firstname
}

