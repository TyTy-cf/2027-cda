
export function sumArray(numbers:number[]):number{
    let sum:number=0;
    for(let number of numbers){
       sum = sum + number;
    }
    return sum;
}