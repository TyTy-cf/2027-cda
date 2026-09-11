export function salute(firstname: string, language: string) : string {
    switch (language) {
        case 'en':
            return `Hello ${firstname}`;
            break;
        case 'fr':
            return `Bonjour ${firstname}`;
            break;
        case 'pt':
            return `Oï ${firstname}`;
            break;
        default:
            return 'Usupported language';
            break;
    }
}