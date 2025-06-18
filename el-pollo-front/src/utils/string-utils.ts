/**
 * Adds a "s" at the end of the string if the count is superior to 1
 * @param string
 * @param count
 */
export const sIfCount = (string: string, count: number): string =>
{
  return `${string}${count > 1 ? 's' : ''}`
}
