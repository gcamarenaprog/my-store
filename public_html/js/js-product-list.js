/**
 * ---------------------------------------------------------------------------------------------------------------------
 * Project name:        Store
 * Project description: Selection process skills assessment.
 * Version:             1.0.0
 * File type:           Script
 * File type:           JavaScript file
 * File description:    This file has the JavaScript functions of product list View
 * Module:              JavaScript scripts
 * ---------------------------------------------------------------------------------------------------------------------
 *
 * - Ekko Lightbox initialize
 * - DataTable initialize
 * - viewProductAjax
 * - editProductAjax
 * - deleteProductAjax
 * - deleteProductConfirmationModal
 */

/** Control initializations ------------------------------------------------------------------------------------------*/

// Ekko Lightbox initialize
$(function () {
  $(document).on('click', '[data-toggle="lightbox"]', function (event) {
    event.preventDefault();
    $(this).ekkoLightbox({
      alwaysShowClose: true
    });
  });
})

/** DataTables -------------------------------------------------------------------------------------------------------*/

/***
 * DataTable initialize
 *
 * @returns void
 * @type {*|jQuery|HTMLElement}
 */
let table = $(function () {
  $("#tableProducts").DataTable({
    "destroy": true,
    "processing": true,
    "serveSide": true,
    'serverMethod': 'get',
    "columnDefs": [
      {"targets": [9, 10, 11, 12, 13], visible: false},
    ],
    "ajax": {
      'url': 'php/controllers/ProductController.php',
      'type': 'GET',
      'data': {
        // language: object_language,
        product_get_all: 'product_get_all',
      },
    },
    "dom": 'Bfrtip',
    buttons: [
      'pageLength',
      {
        extend: 'copy',
        orientation: 'landscape',
        exportOptions: {
          columns: [4, 5, 6, 7, ':visible'],
          columns: ':not(.notexport)',
          stripHtml: true,
        }
      },
      {
        extend: 'excel',
        orientation: 'landscape',
        exportOptions: {
          columns: [4, 5, 6, 7, ':visible'],
          columns: ':not(.notexport)',
          stripHtml: true,
        }
      },
      {
        extend: 'pdf',
        orientation: 'landscape',
        exportOptions: {
          columns: [4, 5, 6, 7, ':visible'],
          columns: ':not(.notexport)',
          stripHtml: false,
        },
      },
      {
        extend: 'print',
        orientation: 'landscape',
        exportOptions: {
          columns: [4, 5, 6, 7, ':visible'],
          columns: ':not(.notexport)',
          stripHtml: false,
        }
      },
      'colvis',
    ],
    language: {
      buttons: {
        copy: 'Copiar',
        csv: 'CSV',
        excel: 'Excel',
        pdf: 'PDF',
        print: 'Imprimir',
        colvis: 'Mostrar columnas',
        pageLength: {
          '_': "Mostrar %d registros",
          '-1': "Mostrar todos los registros" // « This will not work in JS, right?
        }
      },
      lengthMenu: 'Mostrar _MENU_ registros por página',
      infoEmpty: 'No se encontró ningún registro',
      info: 'Mostrando _START_ de _END_ de un total de _TOTAL_ entradas',
      search: 'Buscar',
      zeroRecords: 'No se encontraron registros coincidentes',
      loadingRecords: 'Cargando...',
      paginate: {
        first: 'Primero',
        last: 'Último',
        next: 'Siguiente',
        previous: 'Anterior'
      }
    },
    "responsive": true,
    "lengthChange": true,
    lengthMenu: [
      [10, 25, 50, -1],
      ['10 registros', '25 registros', '50 registros', 'Mostrar todo']
    ],
    "autoWidth": false
  }).buttons().container().appendTo('#tableProducts_wrapper .col-md-6:eq(0)');
});

/** AJAX functions ---------------------------------------------------------------------------------------------------*/

/**
 * View product via Ajax
 * @param product_id_view
 */
function viewProductAjax(product_id_view) {
  // Function that sends and receives response with AJAX
  $.ajax({
    type: 'POST',
    url: 'php/controllers/ProductController.php',
    data: {
      product_id_view: product_id_view
    },
  }).done(function (msg) {
    // Response data
    console.log(msg);
    window.location.href = 'product-view';
  }).fail(function (jqXHR, textStatus, errorThrown) { // Function that is executed if something has gone wrong
    // Error message in console
    console.log("The following error occurred: " + textStatus + " " + errorThrown);
    // Error removal toast message
    launchGenericModal(modal_edit_product_error_title, modal_edit_product_error_text + textStatus + " " + errorThrown, modal_edit_product_button_accept, 'error');
    document.getElementById("loading").style.visibility = "hidden";
  });
}

/**
 * Update product via Ajax
 * @param product_id_edit
 */
function editProductAjax(product_id_edit) {
  // Function that sends and receives response with AJAX
  $.ajax({
    type: 'POST',
    url: 'php/controllers/ProductController.php',
    data: {
      product_id_edit: product_id_edit
    },
  }).done(function (msg) {
    // Response data
    console.log(msg);
    window.location.href = 'product-edit';
  }).fail(function (jqXHR, textStatus, errorThrown) { // Function that is executed if something has gone wrong
    launchGenericModal('¡Error en el proceso!', 'El proceso no se completó correctamente.' + '<br>' + textStatus + " " + errorThrown, modal_button_accept, 'error', '#3085d6', 'null');
    console.log("The following error occurred: " + textStatus + " " + errorThrown);
    document.getElementById("loading").style.visibility = "hidden";
  });
}

/***
 * Function that executes the post method to delete a user via Ajax
 *
 * @returns void
 * @param {string} product_id Product id
 * @param {string} product_name Product name
 */
function deleteProductAjax(product_id, product_name) {
  // Function that sends and receives response with AJAX
  $.ajax({
    type: 'POST',
    url: 'controllers/ProductController.php',
    data: {
      productId: product_id,
      productName: product_name,
      deleteProduct: 'deleteProduct',
      language: object_language
    },
    // Before send Ajax request
    beforeSend: function () {
      document.getElementById("loading").style.visibility = "visible";
    },
  }).done(function (response) {

    if (response['icon'] == 'success') {

      // Successful to delete record
      launchGenericModal(response['title'], response['message'], response['confirmButtonText'], response['icon'], response['confirmButtonColor'], 'productViewAll');
      document.getElementById("loading").style.visibility = "hidden";

      // Reload DataTable
      let table = $('#tableProducts').DataTable();
      table.ajax.reload();

    } else {

      // Error to delete record
      launchGenericModal(response['title'], response['message'], response['confirmButtonText'], response['icon'], response['confirmButtonColor'], 'null');
      document.getElementById("loading").style.visibility = "hidden";

    }
  }).fail(function (jqXHR, textStatus, errorThrown) {
    launchGenericModal('¡Error en el proceso!', 'El proceso no se completó correctamente.' + '<br>' + textStatus + " " + errorThrown, 'Aceptar', 'error', '#3085d6', 'null');
    console.log("The following error occurred: " + textStatus + " " + errorThrown);
    document.getElementById("loading").style.visibility = "hidden";
  }).always(function (response) {
    // No code
  });
}

/** Modals functions -------------------------------------------------------------------------------------------------*/

/**
 * Launch a modal to establish the change in the value of the dollar in Mexican pesos
 * @returns void
 * @param {string} product_id Product id
 * @param {string} product_name Product name
 */
function deleteProductConfirmationModal(product_id, product_name) {
  Swal.fire({
    title: '¿Está seguro de que desea eliminar el producto: ' + product_name,
    text: 'Esta operación no se puede revertir',
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#007bff",
    cancelButtonColor: "#d33",
    confirmButtonText: 'Aceptar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      deleteProductAjax(product_id, product_name);
    }
  });
}