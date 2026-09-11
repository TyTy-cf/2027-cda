export function findMaximum(numbers: number[]): number|null {

    if (numbers.length === 0) {
        return null;
    }

    let max: number = numbers[0];
    for (let number of numbers) {
        if (number > max) {
            max = number;
        }
    }

    return max;
}