/**
 * ---------------------------------------------------------------------------------------------------------------------
 * Project name:        Store
 * Project description: Selection process skills assessment.
 * Version:             1.0.0
 * File type:           Script
 * File type:           JavaScript file
 * File description:    This file has the JavaScript functions of shop view
 * Module:              JavaScript scripts
 * ---------------------------------------------------------------------------------------------------------------------
 *
 */

/**
 * Select the show products option from the store view select control.
 * @param number
 */
function showSelectedOption(number) {

  switch (number) {
    case 9:
      setNewCookie('showValue', '9');
      location.reload();
      break;
    case 12:
      setNewCookie('showValue', '12');
      location.reload();
      break;
    case 15:
      setNewCookie('showValue', '15');
      location.reload();
      break;
    case 18:
      setNewCookie('showValue', '18');
      location.reload();
      break;
  }
}

/**
 * Select the sort products option from the store view select control.
 * @param number
 */
function sortingSelectedOption(number) {
  switch (number) {
    case 1:
      setNewCookie('sortingValue', '1');
      location.reload();
      break;
    case 2:
      setNewCookie('sortingValue', '2');
      location.reload();
      break;
    case 3:
      setNewCookie('sortingValue', '3');
      location.reload();
      break;
  }
}

/**
 * View product details via Ajax.
 * @param product_id_view
 */
function viewProductDetailsInShop(product_id_view) {
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
  }).fail(function (jqXHR, textStatus, errorThrown) { // Function that is executed if something has gone a wrong
    // Error message in console
    console.log("The following error occurred: " + textStatus + " " + errorThrown);
    // Error removal toast message
    launchGenericModal(modal_edit_product_error_title, modal_edit_product_error_text + textStatus + " " + errorThrown, modal_edit_product_button_accept, 'error');
    document.getElementById("loading").style.visibility = "hidden";
  });
}
