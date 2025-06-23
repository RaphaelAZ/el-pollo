import type { Burger, Drink } from '@/models/consumable.ts'

/**
 * Data returned form the form for when the order has been paid.
 */
export interface OrderPayValues {
  address: string,
  postalCode: number,
  city: string,
}

export interface PaidOrder {
  items: (Burger|Drink)[],
  place: OrderPayValues,
}

export interface PreviousPaidOrder extends PaidOrder {
  uid: string,
  orderedAt: string
}
