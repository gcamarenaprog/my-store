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


/**
 * Launches a generic modal with the information passed to it, with accept button.
 *
 * @param {String} title Title of the modal.
 * @param {String} content HTML content of the modal.
 * @param {String} confirm_button_text Text confirm button.
 * @param {String} icon Icon of the modal | error | successful | warning | info | question
 * @param {String} confirm_button_color HEX code color for the confirmation button.
 * @param {String} redirect Slug view to redirect after launch modal.
 */
function launchGenericModal(title, content, confirm_button_text, icon, confirm_button_color = '#3085d6', redirect = 'null') {
  Swal.fire({
    title: title,
    html: content,
    confirmButtonText: confirm_button_text,
    icon: icon,
    confirmButtonColor: confirm_button_color
  }).then(function () {
    if (redirect != 'null') {
      window.location = redirect;
    }
  })
}