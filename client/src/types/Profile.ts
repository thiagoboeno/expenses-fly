export namespace Profile {
  export interface ListItem {
    id: number,
    email: string,
    first_name: string,
    last_name: string,
    birth_date: string,
    phone_number: string,
  }

  export interface CreationDTO {
    first_name: string,
    last_name: string,
    birth_date: string,
    phone_number: string,
  }
}
