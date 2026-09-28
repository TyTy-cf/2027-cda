export function findMaximum(numbers: number[]) :number|null{
    if(numbers.length == 0){
        return null;
    }

    let max:number = numbers[0];

    for (const nb of numbers){
        if(nb > max){
            max = nb;
        }
    }

    return max;
}