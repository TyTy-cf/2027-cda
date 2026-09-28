export function findMaximum(numbers) {
    if (numbers.length == 0) {
        return null;
    }
    let max = numbers[0];
    for (const nb of numbers) {
        if (nb > max) {
            max = nb;
        }
    }
    return max;
}
//# sourceMappingURL=exo-4.js.map