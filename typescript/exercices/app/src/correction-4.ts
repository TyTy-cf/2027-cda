
export function findMaximum(numbers: number[]): number|null {
    if (numbers.length === 0) return null;

    let max: number|undefined = numbers[0];

    if (!max) return null;

    for (const number of numbers) {
        if (number > max) {
            max = number;
        }
    }

    return max;
}