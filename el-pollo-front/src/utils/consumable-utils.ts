import { type Burger, ConsumableType, type Drink } from '@/models/consumable.ts'

/**
 * Returns a ConsumableType from the given consumable
 * @param item
 */
export const getConsumableTypeForItem = (item: Burger | Drink): ConsumableType => {
  if( 'ingredients' in item || 'size' in item || !('isAlcoholic' in item) ) {
    return ConsumableType.Burger
  }

  return ConsumableType.Drink
}
