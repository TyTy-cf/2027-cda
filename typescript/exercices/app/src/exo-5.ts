export function isPalindrome(text:string):boolean{
    let comparatif:string = "";
    for(let letter of text){
        comparatif = letter + comparatif;
    }
    if (text === comparatif){
        return true
    }else{
        return false
    }
}