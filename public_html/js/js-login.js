/**
 * ---------------------------------------------------------------------------------------------------------------------
 * Project name:        Store
 * Project description: Selection process skills assessment.
 * Version:             1.0.0
 * File type:           Script
 * File description:    This file has the JavaScript functions of the login screen.
 * Module:              JavaScript
 * ---------------------------------------------------------------------------------------------------------------------
 */

/** Validations ------------------------------------------------------------------------------------------------------*/

// jQuery Validation
$(function () {
  $('#loginForm').validate({
    rules: {
      inputUsername: {
        required: true,
      },
      inputPassword: {
        required: true,
      },
    },
    messages: {
      inputUsername: {
        required: "Ingrese un nombre de usuario."
      },
      inputPassword: {
        required: "Introduzca una contraseña"
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});