//countWords("Bonjour bonjour, TypeScript ! Bonjour.");
//{ bonjour: 3, typescript: 1 }
export function countWords(sentence: string): { [key: string]: number } {
  const cleaned = sentence.replace(/[^a-zA-Z0-9\s]/g, "").toLowerCase();
  const words = cleaned.split(/\s+/);
  let result: { [key: string]: number } = {};
  for (const word of words) {
    result[word] = (result[word] || 0) + 1;
    }
  
  return result;
}
