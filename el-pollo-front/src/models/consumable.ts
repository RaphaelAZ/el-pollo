export interface Burger extends Consumable {
    ingredients?: string[],
    size?: string;
}

export interface Drink extends Consumable {
    isAlcoholic?: boolean;
}

export interface Consumable {
    id: number,
    name: string,
    description?: string;
    price: number;
    image?: string;
    available?: boolean;
    quantity?: number;
    category?: string;
}

export interface BasketConsumable extends Consumable {
  total: number;
}

export enum ConsumableType {
    Burger = 'burger',
    Drink = 'drink'
}

export interface Ingredients {
    bread: string[],
    meat: string[],
    vegetables: string[],
    cheese: string[],
    sauce: string[]
}