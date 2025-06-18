export const usernameRules = [
    (value: string) => !!value || "Veuillez entrer un nom d'utilisateur",
    (value: string) => (value.length >= 3) || "Le nom d'utilisateur doit contenir au moins 3 caractères",
];

export const addConsumableRules = [
  (value: string) => !!value || "Veuillez entrer un nombre",
  (value: string) => Number.parseInt(value) ?? "Veuillez entrer un nombre valide",
  (value: string) => {
    const parsedNumber = Number.parseInt(value)

    if( parsedNumber > 0 && parsedNumber < 99 ) {
      return 'Veuillez entrer un nombre valide.'
    }

    return true
  }
]
