import type { Ref } from "vue";

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

export const passwordRules = [
    (value: string) => !!value || "Veuillez entrer un mot de passe",
    (value: string) => value.length >= 8 || "Le mot de passe doit contenir au moins 8 caractères",
    (value: string) => /[A-Z]/.test(value) || "Le mot de passe doit contenir au moins une majuscule",
    (value: string) => /[a-z]/.test(value) || "Le mot de passe doit contenir au moins une minuscule",
    (value: string) => /\d/.test(value) || "Le mot de passe doit contenir au moins un chiffre",
    (value: string) => /[@$!%*?&]/.test(value) || "Le mot de passe doit contenir un caractère spécial (@, $, !, %, *, ?, &)",
];

export const emailRules = [
    (value: string) => !!value || "Veuillez entrer un e-mail",
    (value: string) => /.+@.+\..+/.test(value) || "L'e-mail doit être valide",
];

export const confirmPasswordRules = (password: Ref<string>) => [
  (v: string) => !!v || 'La confirmation du mot de passe est requise',
  (v: string) => v === password.value || 'Les mots de passe ne correspondent pas',
]