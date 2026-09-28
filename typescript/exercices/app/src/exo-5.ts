function noSpace(text:string):string{
    let result:string = "";
    for (let i = 0; i < text.length; i++) {
        if (text[i] != " "){
            result += text[i];
        }
    }
    return result;
}

export function isPalindrome(text:string):boolean{
    let reverse:string = "";
    for (let i:number = text.length-1; i >= 0; i--)
    {
        reverse += text[i];
    }
    reverse = noSpace(reverse);
    text = noSpace(text);
    return (text.toLowerCase() == reverse.toLowerCase());
}