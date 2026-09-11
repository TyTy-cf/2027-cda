export function isPalindrome(text: string): boolean {
    text = text.toLowerCase()
    text = text.replace(/[!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~]/g, '');
    text = text.replace(/\s+/g, '');

    //let palindrome = text.split("").reverse().join("");
    let palindrome: string = '';

    let textArray: string[] = text.split('');

    for (let letter of textArray) {
        palindrome = letter + palindrome;
    }

    return text == palindrome;
}