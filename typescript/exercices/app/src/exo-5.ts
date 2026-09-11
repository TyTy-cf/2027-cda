export function isPalindrome(text: string): boolean {
  const cleaned = text.replace(/[^a-zA-Z0-9]/g, "").toLowerCase();
  let reversed = "";
  for (let i = cleaned.length - 1; i >= 0; i--) {
    reversed += cleaned[i];
  }
  return cleaned === reversed;
}
