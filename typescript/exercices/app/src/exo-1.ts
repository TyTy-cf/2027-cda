export function salute(firstName: string, language: string): string {
  if (language === "fr") {
    return `Bonjour ${firstName}`;
  }
  if (language === "pt") {
    return `Oï ${firstName}`;
  }
  if (language === "en") {
    return `Hello ${firstName}`;
  }
  return "Unsupported language";
}
