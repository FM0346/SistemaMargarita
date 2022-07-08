import { CharValidator } from './charValidator'

/**
 * Clase de validadores de strings
 */
class Validator extends CharValidator {
  /**
   * Retorna las validaciones del nombre completo
   *
   * @returns Arreglo de funciones (string) => boolean | string
   * cada una retornando el string en caso que el string no sea válido
   *
   * ? añadir más validaciones?
   */

  static validarNombreCompleto(): Array<(text: string) => boolean | string> {
    return [
      (val: string) => val.length > 0 || 'Nombre completo no debe estar vacío',
      (val: string) => val.length <= 100 || 'Nombre completo debe tener menos de 100 caracteres',
      (val: string) =>
        (val.length > 0 ? val[0] == ' ' : false) == false || 'Nombre completo no debe comenzar con espacio',
      (val: string) =>
        (val.length > 0 ? val[val.length - 1] == ' ' : false) == false ||
        'Nombre completo no debe terminar con espacio',
      (val: string) => val.includes('  ') == false || 'Nombre completo no debe tener dos o más espacios consecutivos',
      (val: string) =>
        val.split('').reduce((acc: number, val: string) => (this.isAlphaEsp(val) || val == ' ' ? acc : acc + 1), 0) ==
          0 || 'Nombre de usuario contiene caracteres inválidos',
    ]
  }

  /**
   * Retorna las validaciones del teléfono
   *
   * @returns Arreglo de funciones (string) => boolean | string
   * cada una retornando el string en caso que el string no sea válido
   */

  static validarTelefono(): Array<(text: string) => boolean | string> {
    return [
      (val: string) =>
        val.split('').reduce((acc: number, val: string) => (CharValidator.isNumber(val) ? acc + 1 : acc), 0) == 8 ||
        'Teléfono debe estar completo',
      (val: string) => val[0] == '2' || val[0] == '6' || val[0] == '7' || 'Teléfono debe comenzar con 2, 6 o 7',
    ]
  }

  /**
   * Retorna las validaciones del DUI
   *
   * @returns Arreglo de funciones (string) => boolean | string
   * cada una retornando el string en caso que el string no sea válido
   *
   * ? Hay más validaciónes de dui?
   */

  static validarDUI(): Array<(text: string) => boolean | string> {
    return [
      (val: string) =>
        val.split('').reduce((acc: number, val: string) => (CharValidator.isNumber(val) ? acc + 1 : acc), 0) == 9 ||
        'DUI debe estar completo',
    ]
  }

  /**
   * Retorna las validaciones del correo
   *
   * @returns Arreglo de funciones (string) => boolean | string
   * cada una retornando el string en caso que el string no sea válido
   */

  static validarCorreo(): Array<(text: string) => boolean | string> {
    return [
      (val: string) => val.length > 0 || 'Correo no debe estar vacío',
      (val: string) => val.length <= 256 || 'Correo debe contener menos de 256 caracteres',
      (val: string) =>
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
          val
        ) || 'Correo debe ser válido',
    ]
  }

  /**
   * Retorna las validaciones del nombre de usuario
   *
   * @returns Arreglo de funciones (string) => boolean | string
   * cada una retornando el string en caso que el string no sea válido
   *
   * ? añadir más validaciones?
   */

  static validarNombreUsuario(): Array<(text: string) => boolean | string> {
    return [
      (val: string) => val.length > 0 || 'Nombre de usuario no debe estar vacío',
      (val: string) => val.length <= 50 || 'Nombre de usuario debe contener menos de 50 caracteres',
      (val: string) => val.includes(' ') == false || 'Nombre de usuario no puede contener espacios',
      (val: string) =>
        (val.length > 0 ? this.isAlpha(val[0]) : false) == true ||
        'Nombre de usuario debe comenzar con una letra sin tilde',
      (val: string) =>
        val

          .split('')
          .reduce(
            (acc: number, val: string) => (this.isAlpha(val) || this.isNumber(val) || val == '_' ? acc : acc + 1),
            0
          ) == 0 || 'Nombre de usuario contiene caracteres inválidos',
    ]
  }

  /**
   * Retorna las validaciones de la contraseña
   *
   * @returns Arreglo de funciones (string) => boolean | string
   * cada una retornando el string en caso que el string no sea válido
   *
   * ? añadir más validaciones?
   */

  static validarContraseña(): Array<(text: string) => boolean | string> {
    return [
      (val: string) => val.length > 0 || 'Contraseña no debe estar vacía',
      (val: string) => val.length <= 50 || 'Contraseña debe contener menos de 50 caracteres',
    ]
  }

  static validarConfirmarContraseña(password: string): Array<(text: string) => boolean | string> {
    return [
      (val: string) => val.length > 0 || 'Contraseña no debe estar vacía',
      (val: string) => val.length <= 50 || 'Contraseña debe contener menos de 50 caracteres',
      (val: string) => val == password || 'Contraseña de verificación no coincide',
    ]
  }
}

export { Validator }
