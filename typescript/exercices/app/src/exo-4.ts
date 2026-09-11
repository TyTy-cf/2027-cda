export function findMaximum(numbers: number[]): number | null {
  if (numbers.length === 0 || numbers === undefined) {
    return null;
  }
  let max: number = numbers[0];
  for (const number of numbers) {
    if (number > max) {
      max = number;
    }
  }
  return max;
}
