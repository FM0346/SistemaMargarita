import { CharValidator } from './charValidator'

/**
 * @class
 * @description Validates strings
 */
class StringValidator extends CharValidator {
  //Validates if a character chr has an username character format
  static isUsernameChar(chr: string): boolean {
    //Validates character alphanumeric
    return this.isAlpha(chr) || this.isNumber(chr)
  }

  //validates if a string has an username format
  static isUsername(str: string): boolean {
    //Validates string not empty
    if (str.length == 0) return false
    let validUsername = true
    //Validates every character from the string
    const strChars = str.split('')
    strChars.map((chr) => (validUsername = validUsername && this.isUsernameChar(chr)))
    //First character must be a letter
    validUsername = validUsername && this.isAlpha(strChars[0])
    return validUsername
  }

  //validates if a character has an email character format
  static isEmailChar(chr: string): boolean {
    //Validates character and return by cases
    switch (chr) {
      case '.':
        return true
      case '_':
        return true
      case '-':
        return true
      case '@':
        return true
      default:
        return this.isAlpha(chr) || this.isNumber(chr)
    }
  }

  //validates if a string has an email format
  static isEmail(str: string): boolean {
    //Validates string not empty
    if (str.length == 0) return false
    //Validates string max length
    if (str.length > 274) return false

    let validEmail = true
    //Validates every character of the email
    const strChars = str.split('')
    strChars.map((chr) => (validEmail = validEmail && this.isEmailChar(chr)))

    //Validates whole email with regex validator
    const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    validEmail = validEmail && emailRegex.test(str)
    return validEmail
  }
}

export { StringValidator }
