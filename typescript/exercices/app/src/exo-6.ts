export function countWords(sentence :string) :string{
    let words :string[] = sentence.split(" ");
    if (words.length == 0){
        return "Il n'y a aucun mot";
    }
    let result :string = "";
    for (let i = 0; i < words.length; i++) {
        let word :string = words[0].toLowerCase();
        let count :number = 0;
        let result :string = "";
        for (let j = 0; j < words.length; j++) {
            if (word == words[j].toLowerCase()){
                count++;
                words.splice(j);
                j--;
            }
        }
        result += word + " est présent " + count.toString() + " fois ";
        i=0;
    }
    return result;
}