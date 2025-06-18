export interface snackBarParams {
  message: string;
  status: SnackBarStatus;
  timer?: number;
  data?: object | null;
}

export enum SnackBarStatus {
  SUCCESS = 'success',
  WARNING = 'warning',
  ERROR = 'error',
  INFO = 'info',
}
