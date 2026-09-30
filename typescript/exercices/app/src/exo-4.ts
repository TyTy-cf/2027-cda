export function findMaximum(numbers: number[]): number|null {

    if (numbers.length === 0) {
        return null;
    }

    let max: number = numbers[0] as number;
    for (let number of numbers) {
        if (number > max) {
            max = number;
        }
    }

    return max;
}