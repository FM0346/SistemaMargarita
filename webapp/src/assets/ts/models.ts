//@ts-check

export interface tabAction {
  route: string
  title: string | undefined
  icon: string | undefined
  disabled: () => boolean
}

export interface sidenavLink {
  title: string
  icon: string | undefined
  route: string | undefined
  sublinks: Array<sidenavLink> | undefined | null
}

export interface loginData {
  id: number
  nombre_usuario: string
  correo: string
  imagen: string
}
