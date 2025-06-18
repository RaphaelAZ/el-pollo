export interface Burger extends Consumable {
    ingredients?: string[],
}

export interface Drink extends Consumable {
    category?: string;
    isAlcoholic?: boolean;
}

export interface Consumable {
    id: number,
    name: string,
    description?: string;
    price: number;
    size?: string;
    imageUrl?: string;
    available?: boolean;
    createdAt?: Date;
    updatedAt?: Date;   
}