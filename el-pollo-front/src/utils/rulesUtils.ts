export const usernameRules = [
    (value: string) => !!value || "Veuillez entrer un nom d'utilisateur",
    (value: string) => (value.length >= 3) || "Le nom d'utilisateur doit contenir au moins 3 caractères",
];