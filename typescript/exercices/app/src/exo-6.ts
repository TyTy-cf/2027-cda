export function countWords(sentence: string): Map<string, number> {
    sentence = sentence.toLowerCase()
    sentence = sentence.replace(/[!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~]/g, '');
    sentence = sentence.replace('  ', ' ');

    let wordArray: string[] = sentence.split(" ");

    let count: Map<string, number> = new Map();

    for (let word of wordArray) {
        let oldValue: number|undefined = count.get(word);

        if (oldValue == undefined) {
            oldValue = 0;
        }

        count.set(word, oldValue + 1);
    }

    return count;
}