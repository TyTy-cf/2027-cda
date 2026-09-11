export function sumArray(array: Array<number>): number {
  let sum = 0;
  for (const number of array) {
    sum = sum + number;
  }
  return sum;
}
