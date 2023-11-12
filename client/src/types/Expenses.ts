export namespace Expenses {
  export interface ListItem {
    id: number,
    user: number,
    description: string,
    value: number,
    date: string,
  }

  export interface CreationDTO {
    description: string,
    value: number,
    date: string,
  }
}
