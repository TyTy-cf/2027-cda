export interface Product {
  id: number;
  name: string;
  priceExcludingTax: number;
  stock: number;
  category: "computing" | "office" | "accessory";
}

export function findProductById(
  products: Product[],
  id: number,
): Product | undefined {
  return products.find((product) => product.id === id);
}

export function filterProductsInStock(products: Product[]): Product[] {
  let inStockProducts: Product[] = [];
  for (const product of products) {
    if (product.stock > 0) {
      inStockProducts.push(product);
    }
  }
  return inStockProducts;
}

export function calculateStockValue(products: Product[]): number {
  let totalValue = 0;
  for (const product of products) {
    totalValue += product.priceExcludingTax * product.stock;
  }
  return totalValue;
}

export function filterByCategory(
  products: Product[],
  category: Product["category"],
): Product[] {
  return products.filter((product) => product.category === category);
}
