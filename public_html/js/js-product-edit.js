/**
 * ---------------------------------------------------------------------------------------------------------------------
 * Project name:        Store
 * Project description: Selection process skills assessment.
 * Version:             1.0.0
 * File type:           Script
 * File type:           JavaScript file
 * File description:    This file has the JavaScript functions of Product Edit view
 * Module:              JavaScript scripts
 * ---------------------------------------------------------------------------------------------------------------------
 *
 * - Control initializations
 * - Ajax functions
 * - Validations
 * - Document on ready functions
 * - General functions
 * - DOM functions
 */


/** Control initializations ------------------------------------------------------------------------------------------*/

// Select input
let selectedValues = new Array();
$('.select2').val(selectedValues);

// Select2 initialization
$(document).ready(function () {
  $('.select2').select2();
});

// beCustomFileInput initialization
$(function () {
  bsCustomFileInput.init();
});

/** Ajax functions ---------------------------------------------------------------------------------------------------*/

/**
 * Update record via Ajax
 *
 * @returns void
 */
$("#editProductForm").on('submit', function (e) {
  let form_data = new FormData(this);
  let image_src = $('#imageProduct').attr('src');
  $("#imageProduct").attr('src', image_src);
    form_data.append('imageOld', image_src),
    form_data.append('product_edit', 'product_edit'),
    form_data.append('productId', product_id),
    e.preventDefault();
  $.ajax({
    type: 'POST',
    url: 'php/controllers/ProductController.php',
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend: function () {
      document.getElementById("loading").style.visibility = "visible";
    },
  }).done(function (response) {
    if (response['icon'] == 'success') {
      // Successful to delete record
      launchGenericModal(response['title'], response['message'], response['confirmButtonText'], response['icon'], response['confirmButtonColor'], 'null');
      document.getElementById("loading").style.visibility = "hidden";
    } else {
      // Error to delete record
      launchGenericModal(response['title'], response['message'], response['confirmButtonText'], response['icon'], response['confirmButtonColor'], 'null');
      document.getElementById("loading").style.visibility = "hidden";
    }
  }).fail(function (jqXHR, textStatus, errorThrown) {
    launchGenericModal('¡Error en el proceso!', 'El proceso no se completó correctamente.' + '<br>' + textStatus + " " + errorThrown, 'Aceptar', 'error', '#3085d6', 'null');
    console.log("The following error occurred: " + textStatus + " " + errorThrown);
    document.getElementById("loading").style.visibility = "hidden";
  }).always(function (msg) {
    // No code
  });
});

/** Validations ------------------------------------------------------------------------------------------------------*/

// jQuery Validation
$(function () {
  $.validator.addMethod("decimalValidator", function (value, element) {
    const pattern = /^(\d+)$|^(\d+\.{1}\d{2})|^(\d+\.{1}\d)$/;
    return this.optional(element) || pattern.test(value);
  });
  $.validator.addMethod("noZeroValidator", function (value, element) {
    if (value != 0) {
      return true;
    }
  });
  let editProductForm = $('#editProductForm').validate({
    rules: {
      inputName: {
        required: true,
      },
      textAreaSpecifications: {
        required: true,
      },
      inputBrand: {
        required: true,
      },
      inputModel: {
        required: true,
      },
      inputPrice: {
        required: true,
        decimalValidator: true,
        noZeroValidator: true,
      },
      inputQuantity: {
        required: true,
      },
      selectCategories: {
        required: true,
      }
    },
    messages: {
      inputName: {
        required: 'Campo obligatorio',
      },
      textAreaSpecifications: {
        required: 'Campo obligatorio',
      },
      inputBrand: {
        required: 'Campo obligatorio',
      },
      inputModel: {
        required: 'Campo obligatorio',
      },
      inputPrice: {
        required: 'Campo obligatorio.',
        decimalValidator: 'Número decimal no válido.',
        noZeroValidator: 'El campo no puede estar en cero.',
      },
      inputQuantity: {
        required: 'Campo obligatorio',
      },
      selectCategories: {
        required: 'Campo obligatorio',
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

/**
 * Update product form jQuery Validation
 */
$(document).ready(function () {
  // Form jQuery Validation
  $('#editProductForm').on('select2:select blur keyup change input', function (event) {
    let add_new_product_form = $('#editProductForm');
    let submit_button = $("#buttonUpdate");
    let is_valid = $(add_new_product_form).validate().checkForm();
    if (is_valid) {
      submit_button.removeAttr("disabled");
    } else {
      submit_button.attr("disabled", "disabled");
    }
  });
});

/**
 * Image validation (On change event)
 */
$("#customFile").on('change', function () {
  let file = this.files[0];
  let img = new Image();
  let image_id = $("#imageProduct");
  let custom_file_id = $('#customFile');
  let minimum_height = 300;
  let minimum_width = 300;
  let no_image_path = 'public_html/resources/admin/dist/img/products/no_image.jpg';
  let maximum_size = 1500000; // 1,500,000 = 1.5 MB
  let valid_extensions = ('jpg, jpeg, png');
  imagePreloadValidationForm(file, img, image_id, custom_file_id, minimum_width, minimum_height, maximum_size, no_image_path, valid_extensions);
});

/** Document ready functions -----------------------------------------------------------------------------------------*/

/** DOM functions ----------------------------------------------------------------------------------------------------*/

/**
 * Tool button help: Shows control help and hides the "Hide Help" tool button
 */
function showHelpForm() {
  document.getElementById('inputNameHelp').style.display = 'inline';
  document.getElementById('imageProductHelp').style.display = 'inline';
  document.getElementById('textAreaSpecificationsHelp').style.display = 'inline';
  document.getElementById('inputBrandHelp').style.display = 'inline';
  document.getElementById('inputModelHelp').style.display = 'inline';
  document.getElementById('inputPriceHelp').style.display = 'inline';
  document.getElementById('inputQuantityHelp').style.display = 'inline';
  document.getElementById('selectCategoriesHelp').style.display = 'inline';
  document.getElementById("helpToolButtonActiveHelp").style.display = 'inline';
  document.getElementById("helpToolButtonInactiveHelp").style.display = 'none';
}

/**
 * Tool button help: Hides control help and hides the "Show Help" tool button.
 */
function hiddenHelpForm() {
  document.getElementById('inputName').style.display = 'none';
  document.getElementById('imageProduct').style.display = 'none';
  document.getElementById('textAreaSpecifications').style.display = 'none';
  document.getElementById('inputBrand').style.display = 'none';
  document.getElementById('inputModel').style.display = 'none';
  document.getElementById('inputPrice').style.display = 'none';
  document.getElementById('inputQuantity').style.display = 'none';
  document.getElementById('selectCategories').style.display = 'none';
  document.getElementById("helpToolButtonActiveHelp").style.display = 'none';
  document.getElementById("helpToolButtonInactiveHelp").style.display = 'inline';
}

/**
 * Tool button clean: Reset all values inputs of the form
 */
function cleanEditProductForm() {
  bsCustomFileInput.destroy();
  $('#inputName').val('');
  $('#imageProduct').attr('src', 'public_html/resources/admin/dist/img/products/no_image.jpg');
  $('#textAreaSpecifications').val('');
  $('#inputBrand').val('');
  $('#inputModel').val('');
  $('#inputPrice').val('');
  $('#inputQuantity').val('');
  $('#selectCategories').val([]).change();
  bsCustomFileInput.init();
}