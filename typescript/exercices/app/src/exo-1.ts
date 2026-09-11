
const firstname: string = "Alice";
const language: Array<string> = ["fr", "en", "pt"]
export function salute(firstname:string, language:string): string {
    if (language === "fr") {
        return "Bonjour" + ' ' + firstname
    } else if (language === "en") {
        return "Hello" + firstname
    } else if (language === "pt") {
        return "Oi" + firstname
    } else {
        return "Undifided language"
    }
}

export function isEven(value: number): boolean {
    return value % 2 === 0
}


export function sumArray(numbers: number[]): number {
    let sum: number = 0
    for (let i = 0; i < numbers.length; i++) {
        sum += numbers[i]
    }
    return sum
}

export function findMaximum(numbers: number[]): number {
    let max: number = 0;
    for (let i = 0; i < numbers.length; i++) {
        if (max <= numbers[i]) {
            max = numbers[i]
        }
    }
    return max
}


export function isPalindrome(text: string): boolean {
    let reverse: string = ""
    for (let letter of text) {
        reverse = letter + reverse
    }
    if (reverse === text) {
        return true
    } else {
        return false
    }
}