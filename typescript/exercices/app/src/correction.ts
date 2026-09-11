import {salute} from "./correction-1.ts";
import {isEven} from "./correction-2.ts";
import {sumArray} from "./correction-3.ts";
import {findMaximum} from "./correction-4.ts";

console.log(salute("Pierre", "ru"));
console.log(salute("Aureo", "pt"));
console.log(salute("Yvo", "en"));
console.log(salute("Yassine", "fr"));
console.log(salute("Antoine", "de"));

console.log(isEven(2));
console.log(isEven(17));
console.log(isEven(0));
console.log(isEven(-4));

console.log(sumArray([1, 2, 3, 4]));
console.log(sumArray([]));
console.log(sumArray([-2, 4, -1]));

console.log(findMaximum([7, 2, 19, 4]));
console.log(findMaximum([-10, -2, -8]));
console.log(findMaximum([]));
