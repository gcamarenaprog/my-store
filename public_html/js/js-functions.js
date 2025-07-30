/**
 * ---------------------------------------------------------------------------------------------------------------------
 * Project name:        Store
 * Project description: Selection process skills assessment.
 * Version:             1.0.0
 * File type:           Script
 * File description:    This file has the global JavaScript functions of the project.
 * Module:              JavaScript
 * ---------------------------------------------------------------------------------------------------------------------
 */

/**
 * Set a new cookie and its value.
 *
 * @param {String} cookie_name Name to be assigned to the new cookie.
 * @param {String} cookie_value Value to be assigned to the new cookie.
 */
function setCookie(cookie_name, cookie_value) {
  // Set a new cookie value
  document.cookie = cookie_name + "=" + cookie_value;
}

/**
 * Get value of the cookie by the name cookie.
 *
 * @param {String} name_cookie Name of the cookie.
 * @return {String} Value of the cookie.
 */
function getCookieValue(name_cookie) {
  const regex = new RegExp(`(^| )${name_cookie}=([^;]+)`)
  const match = document.cookie.match(regex)
  if (match) {
    return match[2]
  } else {
    return null;
  }
}