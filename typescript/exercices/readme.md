# Typescript

### 1. Exercices algo

- Tous les exercices doivent être créer dans un fichier à part de nom : `exo-{nombre}.ts`
- Ils doivent ensuite être importés et utilisé dans un fichier `app.ts`

#### 1.1. salute

Créer une fonction `salute`, ayant deux paramètres :

- `firstname` de type `string`
- `language` de type `string`, pouvant prendre les valeurs "fr", "en" ou "pt"
- Si une autre valeur que "fr", "en" et "pt" est passé, alors la fonction renvoie "Unsupported language"

La fonction doit renvoyer :

```ts
salute("Alice", "fr"); // "Bonjour Alice"
salute("Alice", "en"); // "Hello Alice"
salute("Alice", "pt"); // "Oï Alice"
salute("Alice", "es"); // "Unsupported language"
```

#### 1.2. isEven

Créer une fonction isEven, ayant un paramètre :

- `number` de type `number`

La fonction doit renvoyer true si le nombre est pair, sinon false.

```ts
isEven(2); // true
isEven(17); // false
isEven(0); // true
isEven(-4); // true
```

Contraintes :

- Ne pas convertir le nombre en chaîne de caractères.
- Ne pas utiliser de boucle.
- La fonction doit renvoyer un booléen avec return, sans utiliser console.log.

#### 1.3. `sumArray`

Créer une fonction `sumArray`, ayant un paramètre :

- `numbers` de type `number[]`

La fonction doit renvoyer la somme des nombres du tableau.

```ts
sumArray([1, 2, 3, 4]); // 10
sumArray([]); // 0
sumArray([-2, 4, -1]); // 1
```

Contraintes :

- Gérer correctement un tableau vide

#### 1.4. `findMaximum`

Créer une fonction `findMaximum`, ayant un paramètre :

- `numbers` de type `number[]`

La fonction doit renvoyer le plus grand nombre du tableau. Si le tableau est vide, elle renvoie `null`.

```ts
findMaximum([7, 2, 19, 4]); // 19
findMaximum([-10, -2, -8]); // -2
findMaximum([]); // null
```

Contraintes :

- Ne pas utiliser `Math.max(...numbers)`
- Ne pas trier le tableau
- Ne pas modifier le tableau reçu

#### 1.5. `isPalindrome`

Créer une fonction `isPalindrome`, ayant un paramètre :

- `text` de type `string`

La fonction doit renvoyer `true` si le texte est un palindrome, sinon `false`. Ignorer la casse, les espaces et la ponctuation.

```ts
isPalindrome("kayak"); // true
isPalindrome("Esope reste ici et se repose"); // true
isPalindrome("TypeScript"); // false
```

Contraintes :

- Ignorer la casse (majuscules/minuscules)
- Ignorer les espaces et la ponctuation
- Ne pas utiliser `split("")`, `reverse()` ni `join("")`

#### 1.6. `countWords`

Créer une fonction `countWords`, ayant un paramètre :

- `sentence` de type `string`

La fonction doit renvoyer le nombre d'occurrences de chaque mot. Ignorer la casse et la ponctuation simple.

```ts
countWords("Bonjour bonjour, TypeScript ! Bonjour.");
// { bonjour: 3, typescript: 1 }
```

Contraintes :

- Ignorer la casse
- Ignorer la ponctuation simple
- Ne pas modifier la chaîne d'entrée

#### 1.7. `products`

Créer une interface `Product`, elle aura les attributs suivant :

- id, un entier
- name, une chaîne de caractère
- priceExcludingTax, un entier
- stock, un entier
- category, "computing" | "office" | "accessory"

Créer les fonctions suivantes :

```ts
function findProductById(
  products: Product[],
  id: number,
): Product | undefined {}

function filterProductsInStock(products: Product[]): Product[] {}

function calculateStockValue(products: Product[]): number {}

function filterByCategory(
  products: Product[],
  category: Product["category"],
): Product[] {}
```

Jeu de données de départ :

```ts
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
```

Contraintes :

- `findProductById` renvoie `undefined` si aucun produit ne correspond
- `calculateStockValue` renvoie la valeur totale du stock, tous produits confondus
- Ne pas modifier le tableau `products` reçu en paramètre
