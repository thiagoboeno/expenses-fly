export namespace Auth {
  export interface Token {
    token: string,
  }

  export interface Login {
    email: string,
    password: string,
  }

  export interface SignUp {
    email: string,
    password: string,
    first_name: string,
    last_name: string,
  }

  export interface ForgotPassword {
    email: string,
  }

  export interface ResetPassword {
    token: string,
    email: string,
    password: string,
    confirmation_password: string,
  }
}
