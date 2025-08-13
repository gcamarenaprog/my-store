/**
 * ---------------------------------------------------------------------------------------------------------------------
 * Project name:        Store
 * Project description: Selection process skills assessment.
 * Version:             1.0.0
 * File type:           Script
 * File description:    This file has the global JavaScript functions of the project.
 * Module:              JavaScript
 * Revised:             13-08-2025
 * ---------------------------------------------------------------------------------------------------------------------
 */

/**
 * = Sets a new cookie with its value and name =
 *
 * @param {String} cookie_name Name to be assigned to the new cookie.
 * @param {String} cookie_value Value to be assigned to the new cookie.
 */
function setNewCookie(cookie_name, cookie_value) {
  document.cookie = cookie_name + "=" + cookie_value;
}

/**
 * = Get the value of the cookie by the name cookie =
 *
 * @param {String} name_cookie Name of the cookie.
 * @return {String} Value of the cookie.
 */
function getCookie(name_cookie) {
  const regex = new RegExp(`(^| )${name_cookie}=([^;]+)`)
  const match = document.cookie.match(regex)
  if (match) {
    return match[2]
  } else {
    return null;
  }
}

/**
 * = Launches a generic modal =
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

/**
 * = Validation of image preloading in a form, returns a successful or failed process modal =
 *
 * @param file {files} this.files[0]
 * @param img {HTMLImageElement} new Image()
 * @param image_element_id {string} Image element id.
 * @param custom_file_control_id {string} Custom file control id.
 * @param minimum_width {int} Minimum width dimensions in pixels.
 * @param minimum_height {int} Minimum height dimensions in pixels.
 * @param maximum_size {int} Maximum file size in bytes.
 * @param default_image_path {string} Default image path, if no valid file.
 * @param valid_extensions {string} Extensions valid array. For example: let ext = ('jpg, png, doc');
 * @return {boolean}
 */
function validationOfImagePreloadingInForm(file, img, image_element_id, custom_file_control_id, minimum_width, minimum_height, maximum_size, default_image_path, valid_extensions) {
  if (file) {
    // Get the file extension
    let extension = file.name.replace(/^.*\./, '');
    // Validate file type, only jpg, jpeg, png and gif
    if (!valid_extensions.includes(extension)) {
      let content_text = '<b>' + extension + '</b>' + ': Tipo de archivo no permitido.';
      // Throw an error modal when the file extension is bad
      launchGenericModal('¡Error, tipo de archivo!', content_text, 'Aceptar', 'error', undefined, undefined)
      // Reset bsCustomFileInput
      bsCustomFileInput.destroy();
      $(image_element_id).attr('src', default_image_path);
      $(custom_file_control_id).val('');
      bsCustomFileInput.init();
      file = null;
    } else {
      img.onload = function () {
        // Validate the dimensions of the image, they must be 300px x 300px
        if (this.width < minimum_width && this.height < minimum_height) {
          let contentText = '<b>' + this.height + 'px x ' + this.width + 'px' + '</b>' + ': Estas dimensiones de imágen no son válidas.';
          // Throws an error modal because the image dimensions exceed 160px x 160px
          launchGenericModal('¡Error, dimensiones de imagen!', contentText, 'Aceptar', 'error', undefined, undefined)
          // Reset bsCustomFileInput
          bsCustomFileInput.destroy();
          $(image_element_id).attr('src', default_image_path);
          $(custom_file_control_id).val('');
          bsCustomFileInput.init();
          file = null;
        } else {
          // Validation of image size no greater than maximum_size
          if (file.size > maximum_size) {
            let size = file.size;
            let file_real_size = size / 1024;
            let file_real_maximum_size = maximum_size / 1024;
            let text_content = '<b>' + file_real_size.toFixed(2) + ' KB' + '</b>' + ': Tamaño de archivo no permitido.';
            // Image size error modal
            launchGenericModal('¡Error, tamaño de archivo!', text_content, 'Aceptar', 'error', undefined, undefined)
            // Reset bsCustomFileInput
            bsCustomFileInput.destroy();
            $(image_element_id).attr('src', default_image_path);
            $(custom_file_control_id).val('');
            bsCustomFileInput.init();
            file = null;
          } else {
            // Add the src attribute to the image object with the selected image
            $(image_element_id).attr('src', URL.createObjectURL(file));
          }
        }
      }
    }
  } else {
    // Reset bsCustomFileInput
    bsCustomFileInput.destroy();
    $(image_element_id).attr('src', default_image_path);
    $(custom_file_control_id).val('');
    bsCustomFileInput.init();
  }
  if (file) {
    // Throws a success modal when the image file validation is successful
    launchGenericModal(' ¡Proceso correcto! ', '<b>' + file.name + '</b>' + ': Este archivo válido.', 'Aceptar', 'success', undefined, undefined);
    // Create object ULR
    img.src = URL.createObjectURL(file);
  }
}

