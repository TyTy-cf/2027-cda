function noSpace(text) {
    let result = "";
    for (let i = 0; i < text.length; i++) {
        if (text[i] != " ") {
            result += text[i];
        }
    }
    return result;
}
export function isPalindrome(text) {
    let reverse = "";
    for (let i = text.length - 1; i >= 0; i--) {
        reverse += text[i];
    }
    reverse = noSpace(reverse);
    text = noSpace(text);
    return (text.toLowerCase() == reverse.toLowerCase());
}
//# sourceMappingURL=exo-5.js.map