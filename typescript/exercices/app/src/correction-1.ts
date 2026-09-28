
const languages: Map<string, string> = new Map();
languages.set('fr', 'Bonjour');
languages.set('pt', 'Oi');
languages.set('en', 'Hello');
languages.set('ru', 'Привет');

export function salute(firstname: string, language: string): string {
    if (!languages.has(language)) {
        return "Unsupported language";
    }

    return languages.get(language) + " " + firstname;
}
