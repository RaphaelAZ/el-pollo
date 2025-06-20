export interface User {
    username: string | null;
    email: string | null;
    jwt?: string | null;
}

export interface LoginData {
    password: string;
    email: string;
}

export interface RegisterData {
    username: string;
    email: string;
    password: string;
}