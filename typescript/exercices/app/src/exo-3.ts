export function sumArray (numbers: number[]) :number{
    let sum: number = 0;
    for (let i = 0; i < numbers.length; i++) {
        sum += numbers[i];
    }
    return sum;
}
