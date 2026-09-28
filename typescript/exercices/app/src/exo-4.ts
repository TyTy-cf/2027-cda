export function findMaximum(numbers:number[]) :number|null{
    let max:number|null= numbers[0];
    for(let number of numbers){
        if (number > max){
            max = number;
        }
    }
    if (max===undefined){
        max = null;
    }
    return max;
}