import { salute } from "./exo-1.ts";
import { isEven } from "./exo-2.ts";
import { sumArray } from "./exo-3.ts";
import { findMaximum } from "./exo-4.ts";
import { isPalindrome } from "./exo-5.ts";
import { countWords } from "./exo-6.ts";
import { IProduct, calculateStockValue, filterByCategory, filterProductsInStock, findProductById } from "./exo-7.ts";

console.log(salute('Alice', 'en'));
console.log(salute('Alice', 'fr'));
console.log(salute('Alice', 'pt'));
console.log(salute('Alice', 'es'));

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

console.log(isPalindrome("kayak"));
console.log(isPalindrome("Esope reste ici et se repose"));
console.log(isPalindrome("TypeScript"));

console.log(countWords("Bonjour bonjour, TypeScript ! Bonjour."));

const products: IProduct[] = [
    { id: 1, name: "Clavier", priceExcludingTax: 49.99, stock: 12, category: "computing" },
    { id: 2, name: "Stylo", priceExcludingTax: 1.5, stock: 0, category: "office" },
    { id: 3, name: "Souris", priceExcludingTax: 24.99, stock: 8, category: "computing" }
];

console.log(findProductById(products, 1));
console.log(filterProductsInStock(products));
console.log(calculateStockValue(products));
console.log(filterByCategory(products, "computing"));