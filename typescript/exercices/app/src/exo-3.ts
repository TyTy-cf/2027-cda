export function sumArray(numbers: number[]): number {
    let sum: number = 0;

    for (const n of numbers) {
        sum += n;
    }

    return sum;
}