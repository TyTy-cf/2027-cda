export interface IProduct {
    id: number;
    name: string;
    priceExcludingTax: number;
    stock: number;
    category: "computing" | "office" | "accessory"
}

export function findProductById( IProducts: IProduct[], id: number): IProduct | undefined {
    for (let product of IProducts) {
        if (product.id === id) {
            return product;
        }
    }

    return undefined;
}

export function filterProductsInStock(IProducts: IProduct[]): IProduct[] {
    let filteredProducts: IProduct[] = [];

    for (let product of IProducts) {
        if (product.stock !== 0) {
            filteredProducts.push(product);
        }
    }

    return filteredProducts;
}

export function calculateStockValue(IProducts: IProduct[]): number {
    let value: number = 0;

    for (let product of IProducts) {
        value += product.priceExcludingTax * product.stock;
    }

    return value;
}

export function filterByCategory(
    IProducts: IProduct[],
    category: IProduct["category"]
): IProduct[] {
    let filteredProducts: IProduct[] = [];

    for (let product of IProducts) {
        if (product.category === category) {
            filteredProducts.push(product);
        }
    }

    return filteredProducts;
}