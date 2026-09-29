import { salute } from "./exo-1.ts";
import { isEven } from "./exo-2.ts";
import { sumArray } from "./exo-3.ts";
import { findMaximum } from "./exo-4.ts";
import { isPalindrome } from "./exo-5.ts";
import { countWords } from "./exo-6.ts";
import {
  findProductById,
  Product,
  filterProductsInStock,
  calculateStockValue,
  filterByCategory,
} from "./exo-7.ts";

// console.log(salute("Alice", "fr"));
// console.log(salute("Bob", "pt"));
// console.log(salute("Charlie", "es"));
// console.log(salute("David", "en"));

// console.log(isEven(2));
// console.log(isEven(17));
// console.log(isEven(0));
// console.log(isEven(-4));

// console.log(sumArray([1, 2, 3, 4]));
// console.log(sumArray([]));
// console.log(sumArray([-2, 4, -1]));

// console.log(findMaximum([7, 2, 19, 4])); // 19
// console.log(findMaximum([-10, -2, -8])); // -2
// console.log(findMaximum([])); // null

// console.log("<<kayak>> is a palindrome ? ", isPalindrome("kayak")); // true
// console.log(
//   "<<Esope reste ici et se repose>> is a palindrome ? ",
//   isPalindrome("Esope reste ici et se repose"),
// ); // true
// console.log("<<TypeScript>> is a palindrome ? ", isPalindrome("TypeScript")); // false

// console.log(countWords("Bonjour bonjour, TypeScript ! Bonjour.")); // { bonjour: 3, typescript: 1 }

const products: Product[] = [
  {
    id: 1,
    name: "Clavier",
    priceExcludingTax: 49.99,
    stock: 12,
    category: "computing",
  },
  {
    id: 2,
    name: "Stylo",
    priceExcludingTax: 1.5,
    stock: 0,
    category: "office",
  },
  {
    id: 3,
    name: "Souris",
    priceExcludingTax: 24.99,
    stock: 8,
    category: "computing",
  },
];

console.log(findProductById(products, 2));
console.log("Products in stock:", filterProductsInStock(products));
console.log("Total stock value:", calculateStockValue(products));
console.log("Computing products:", filterByCategory(products, "computing"));
