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

/** Document ready functions -----------------------------------------------------------------------------------------*/
$(document).ready(function () {});

/**
 * Show number of products selected
 * @param number
 */
function showSelectedOption(number) {

  switch (number) {
    case 9:
      setCookie('showValue', '9');
      location.reload();
      break;
    case 18:
      setCookie('showValue', '28');
      location.reload();
      break;
    case 27:
      setCookie('showValue', '27');
      location.reload();
      break;
  }

}

/**
 * Sorting selected option
 * @param number
 */
function sortingSelectedOption(number) {
  switch (number) {
    case 1:
      setCookie('sortingValue', '1');
      location.reload();
      break;
    case 2:
      setCookie('sortingValue', '2');
      location.reload();
      break;
    case 3:
      setCookie('sortingValue', '3');
      location.reload();
      break;
  }
}

function viewProduct(){
  console.log('here')
  window.location.href = 'product';
}
