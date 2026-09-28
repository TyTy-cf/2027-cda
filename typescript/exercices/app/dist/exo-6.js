export function countWords(sentence) {
    let words = sentence.split(" ");
    if (words.length == 0) {
        return "Il n'y a aucun mot";
    }
    let result = "";
    for (let i = 0; i < words.length; i++) {
        let word = words[0].toLowerCase();
        let count = 0;
        let result = "";
        for (let j = 0; j < words.length; j++) {
            if (word == words[j].toLowerCase()) {
                count++;
                words.splice(j);
                j--;
            }
        }
        result += word + " est présent " + count.toString() + " fois ";
        i = 0;
    }
    return result;
}
//# sourceMappingURL=exo-6.js.map