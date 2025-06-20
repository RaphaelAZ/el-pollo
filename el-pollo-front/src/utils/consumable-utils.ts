import { type Burger, type Consumable, ConsumableType, type Drink } from '@/models/consumable.ts'

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

/**
 * Returns the total for the given item
 * @param item
 */
export const getTotalForItem = (item: Consumable) => {
  const itemTotalRaw = (item.quantity as number) * item.price

  //arrondir à deux chiffres
  const itemTotal = Math.floor( itemTotalRaw * 100 ) / 100

  if( itemTotal ) {
    return `${itemTotal} €`
  } else {
    return '(Erreur)'
  }
}
