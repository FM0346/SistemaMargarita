//@ts-check

/**
 * @class
 * @description Validates characters
 */
class CharValidator {
  //validates if a string str is a character
  static isCharacter(str: string): boolean {
    return str.length == 1
  }

  //Validates if the character chr is a special character
  static isSpecial(chr: string): boolean {
    if (!this.isCharacter(chr)) return false
    const validChars = [
      '@',
      '!',
      '#',
      '$',
      '%',
      '&',
      "'",
      '*',
      '+',
      '-',
      '/',
      '=',
      '?',
      '^',
      '_',
      '`',
      '{',
      '|',
      '}',
      '~',
      '.',
    ]
    return validChars.includes(chr)
  }

  //Validates if the character chr is alphabetic and uppercase in english
  static isUpperAlpha(chr: string): boolean {
    if (!this.isCharacter(chr)) return false
    return chr >= 'A' && chr <= 'Z'
  }

  //Validates if the character chr is alphabetic and uppercase in spanish
  static isUpperAlphaEsp(chr: string): boolean {
    if (!this.isCharacter(chr)) return false
    const validChars = ['Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ']
    return (chr >= 'A' && chr <= 'Z') || validChars.includes(chr)
  }

  //Validates if the character chr is alphabetic and lowercase in english
  static isLowerAlpha(chr: string): boolean {
    if (!this.isCharacter(chr)) return false
    return chr >= 'a' && chr <= 'z'
  }

  //Validates if the character chr is alphabetic and lowercase in spanish
  static isLowerAlphaEsp(chr: string): boolean {
    if (!this.isCharacter(chr)) return false
    const validChars = ['á', 'é', 'í', 'ó', 'ú', 'ñ']
    return (chr >= 'a' && chr <= 'z') || validChars.includes(chr)
  }

  //Validates if the character chr is alphabetic in english
  static isAlpha(chr: string): boolean {
    if (!this.isCharacter(chr)) return false
    return this.isUpperAlpha(chr) || this.isLowerAlpha(chr)
  }

  //Validates if the character chr is alphabetic in spanish
  static isAlphaEsp(chr: string): boolean {
    if (!this.isCharacter(chr)) return false
    return this.isUpperAlphaEsp(chr) || this.isLowerAlphaEsp(chr)
  }

  //Validates if the character chr is numeric
  static isNumber(chr: string): boolean {
    if (!this.isCharacter(chr)) return false
    return chr >= '0' && chr <= '9'
  }
}

export { CharValidator }
