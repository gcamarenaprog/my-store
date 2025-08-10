/**
 * ---------------------------------------------------------------------------------------------------------------------
 * Project name:        Store
 * Project description: Selection process skills assessment.
 * Version:             1.0.0
 * File type:           Script
 * File type:           JavaScript file
 * File description:    This file has the JavaScript functions of featured-products module store
 * Module:              JavaScript scripts
 * ---------------------------------------------------------------------------------------------------------------------
 *
 */

/** Document ready functions -----------------------------------------------------------------------------------------*/
$(document).ready(function () {});

/**
 * View product details via Ajax.
 * @param product_id_view
 */
function viewProductDetailsAjax(product_id_view) {
  // Function that sends and receives response with AJAX
  $.ajax({
    type: 'POST',
    url: 'php/controllers/ProductController.php',
    data: {
      product_id_view: product_id_view,
      product_details_go_to_view: 'product_details_go_to_view'
    },
  }).done(function (msg) {
    // Response data
    console.log(msg);
    window.location.href = 'product';
  }).fail(function (jqXHR, textStatus, errorThrown) { // Function that is executed if something has gone wrong
    // Error message in console
    console.log("The following error occurred: " + textStatus + " " + errorThrown);
    // Error removal toast message
    launchGenericModal(modal_edit_product_error_title, modal_edit_product_error_text + textStatus + " " + errorThrown, modal_edit_product_button_accept, 'error');
    document.getElementById("loading").style.visibility = "hidden";
  });
}