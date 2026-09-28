
export function sumArray(numbers: number[]): number {
    let total: number = 0;

    for (const number of numbers) {
        total += number;
    }

    return total;
}