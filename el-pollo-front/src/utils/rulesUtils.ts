export const usernameRules = [
    (value: string) => !!value || "Veuillez entrer un nom d'utilisateur",
    (value: string) => (value.length >= 3) || "Le nom d'utilisateur doit contenir au moins 3 caractères",
];

export const mainAddressRules = [
  (value: string) => !!value || "Veuillez entrer une adresse ici",
  (value: string) => (value.length > 10) || "Veuillez entrer une adresse valide.",
  (value: string) => (value.length < 1000) || "L'adresse entrée est trop longue."
];

export const postalCodeRegex: RegExp = /^[0-9]{5}$/

export const postalCodeRules = [
  (value: string) => !!value || "Veuillez entrer un code postal ici",
  (value: string) => (value.length === 5) || "Le code postal entré n'est pas valide.",
  (value: string) => (postalCodeRegex.test(value)) || "Le code postal entré n'est pas valide.",
]

export const cityRegex: RegExp = /^[\w\séèÉÈéè-]+$/

export const cityRules = [
  (value: string) => !!value || "Veuillez entrer une ville",
  (value: string) => (value.length >= 2) || "Veuillez entrer un ville valide",
  (value: string) => (cityRegex.test(value)) || "La ville entrée n'est pas valide. Veuillez réessayer."
]
