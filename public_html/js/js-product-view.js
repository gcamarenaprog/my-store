/**
 * ---------------------------------------------------------------------------------------------------------------------
 * Project name:        Store
 * Project description: Selection process skills assessment.
 * Version:             1.0.0
 * File type:           Script
 * File type:           JavaScript file
 * File description:    This file has the JavaScript functions of Product Details view
 * Module:              JavaScript scripts
 * ---------------------------------------------------------------------------------------------------------------------
 *
 * - Control initializations
 * - Document ready functions
 * - Event functions
 * - DOM functions
 */


/** Control initializations ------------------------------------------------------------------------------------------*/

// Lightbox initialization
$(document).on('click', '[data-toggle="lightbox"]', function (event) {
  event.preventDefault();
  $(this).ekkoLightbox();
});

// Variable initialization
let valuePriceP;

let valueMonthlyRateR;
let valueMonthlyInterestNumber;
let valueAnnualInterest;
let valueMonthlyN;

let valueMonthlyPaymentSecondPartM;
let valueMonthlyPaymentM;

let valueMonthlyPaymentMCalculated

/** Document ready functions -----------------------------------------------------------------------------------------*/
$(document).ready(function () {

  // Calculate monthly payment
  valueMonthlyPaymentMCalculated = calculateMonthlyPayment();

  // Set monthly payment
  $("#labelTotal").text('$' + roundDecimals(valueMonthlyPaymentMCalculated, 2) + ' MXN');

});

/** Events functions -------------------------------------------------------------------------------------------------*/

/**
 * Calculate the monthly payment in case of change in the interest rate control
 */
$('#selectCalculatorInterest').change(function () {
  let valueMonthlyPaymentMCalculated = calculateMonthlyPayment();
  $("#labelTotal").text('$' + roundDecimals(valueMonthlyPaymentMCalculated, 2) + ' MXN');
});

/**
 * Calculate the monthly payment in case of change in the monthly payment control
 */
$('#selectCalculatorMonthlyPayment').change(function () {
  let valueMonthlyPaymentMCalculated = calculateMonthlyPayment();
  $("#labelTotal").text('$' + roundDecimals(valueMonthlyPaymentMCalculated, 2) + ' MXN');
});

/** Functions --------------------------------------------------------------------------------------------------------*/

/**
 * Calculate monthly payment
 *
 * M = Monthly payment (payment you are looking for)
 * P = Loan amount (principal)
 * r = Monthly interest rate (annual rate / 12)
 * n = Total number of payments (in months)
 *
 * M = P * ( ( r * (1 + r)^n) / ( ( 1 + 2 ) ^ n - 1)
 *
 * @return {number}
 */
function calculateMonthlyPayment() {

  // Get values
  valuePriceP = valuePrice;
  valueAnnualInterest = $("#selectCalculatorInterest").val();
  valueMonthlyN = $("#selectCalculatorMonthlyPayment").val();

  // Monthly interest rate (annual rate / 12)
  valueMonthlyInterestNumber = valueAnnualInterest / 100;
  valueMonthlyRateR = valueMonthlyInterestNumber / 12;

  // Numerator calculations
  let valueNumerator1 = 1 + valueMonthlyRateR;
  let valueNumerator2 = valueNumerator1 ** valueMonthlyN;
  let valueNumerator3 = valueMonthlyRateR * valueNumerator2;
  let valueNumerator = valueNumerator3;

  //Denominator calculations
  let valueDenominator = valueNumerator2 - 1;

  // Second part of monthly payment
  valueMonthlyPaymentSecondPartM = valueNumerator / valueDenominator;

  // Monthly payment
  valueMonthlyPaymentM = valuePriceP * valueMonthlyPaymentSecondPartM;
  return valueMonthlyPaymentM;
}

/**
 * Round decimals number
 * @param numberToRound Number to round
 * @param decimalsValue Decimals number to round number
 * @return {number}
 */
function roundDecimals(numberToRound, decimalsValue) {
  return Math.round(numberToRound * Math.pow(10, decimalsValue)) / Math.pow(10, decimalsValue);
}