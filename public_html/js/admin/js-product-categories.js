/**
 * ---------------------------------------------------------------------------------------------------------------------
 * Project name:        Store
 * Project description: Selection process skills assessment.
 * Version:             1.0.0
 * File type:           Script
 * File type:           JavaScript file
 * File description:    This file has the JavaScript functions of Product Categories view
 * Module:              JavaScript scripts
 * ---------------------------------------------------------------------------------------------------------------------
 */

/** On ready functions -----------------------------------------------------------------------------------------------*/

$(document).ready(function () {
  screenResolutionAdaptative();
});

/** Configurations and initializations -----..------------------------------------------------------------------------*/

// Load the "Add category form as Default" form when load the page
viewAddNewCategoryForm();

/** AJAX Functions ---------------------------------------------------------------------------------------------------*/

/**
 * Delete category via Ajax
 *
 * @param categoryId
 * @param from
 */
function deleteCategoryAjax(category_id, category_name, number_products, number_child) {
  // Function that sends and receives response with AJAX
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'php/controllers/ProductCategoriesController.php',
    data: {
      category_delete : 'category_delete',
      categoryIdDelete: category_id,
      number_products: number_products,
      number_child: number_child
    }, beforeSend: function () {
      document.getElementById("loadingView").style.visibility = "visible";
      document.getElementById("loadingEdit").style.visibility = "visible";
      document.getElementById("loadingAdd").style.visibility = "visible";
      document.getElementById("loadingTable").style.visibility = "visible";
    },
  }).done(function (msg) {
    let table = $('#tableProductCategories').DataTable();
    if (msg['response'] == 'successful') {
      // Response data deleted yes
      launchGenericModal('¡Eliminación correcta!', "<b>" + category_name + "</b><br>" + 'Esta categoría se eliminó correctamente.', 'Aceptar', 'success');
      table.ajax.reload();
    } else if (msg['response'] == 'error-exists-products') {
      // Response data no deleted with products
      launchGenericModal('Error al eliminar', "<b>" + category_name + "</b><br>" + 'Esta categoría tiene productos asociados.', 'Aceptar', 'error');
    } else if (msg['response'] == 'error-exists-child') {
      launchGenericModal('Error al eliminar', "<b>" + category_name + "</b><br>" + 'Esta categoría tiene categorías hijas asociadas.', 'Aceptar', 'error');
    } else if (msg['response'] == 'error') {
      launchGenericModal('Error al eliminar', "<b>" + category_name + "</b><br>" + 'Esta categoría no se puedo eliminar.', 'Aceptar', 'error');
    }
    document.getElementById("loadingView").style.visibility = "hidden";
    document.getElementById("loadingEdit").style.visibility = "hidden";
    document.getElementById("loadingAdd").style.visibility = "hidden";
    document.getElementById("loadingTable").style.visibility = "hidden";
  }).fail(function (jqXHR, textStatus, errorThrown) { // Function that is executed if something has gone wrong
    // Error message in console
    console.log("The following error occurred: " + textStatus + " " + errorThrown);
    // Error removal toast message
    launchGenericModal('¡Error en la solicitud Ajax!', 'Se produjo el siguiente error: ' + textStatus + " " + errorThrown, 'Aceptar', 'error');
    document.getElementById("loadingView").style.visibility = "hidden";
    document.getElementById("loadingEdit").style.visibility = "hidden";
    document.getElementById("loadingAdd").style.visibility = "hidden";
    document.getElementById("loadingTable").style.visibility = "hidden";
  });
}

/**
 * Update category via Ajax
 * @param category_id
 * @param from
 */
$("#formUpdateCategory").on('submit', function (e) {
  let formData = new FormData(this);
  formData.append('category_update', 'category_update'),
    e.preventDefault();
  $.ajax({
    type: 'POST',
    url: 'php/controllers/ProductCategoriesController.php',
    data: formData,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend: function () {
      document.getElementById("loadingView").style.visibility = "visible";
      document.getElementById("loadingEdit").style.visibility = "visible";
      document.getElementById("loadingAdd").style.visibility = "visible";
      document.getElementById("loadingTable").style.visibility = "visible";
    },
  }).done(function (msg) {
    let table = $('#tableProductCategories').DataTable();

    if (msg['message'] == 'success') {
      launchGenericModal('¡Actualización correcta!', "<br><b>" + msg['product_category_name'] + "</b><br>" + 'Esta categoría se actualizó correctamente.', 'Aceptar', 'success', '#3085d6');
    } else {
      launchGenericModal('Actualización incorrecta!', "<br><b>" + msg['product_category_name'] + "</b><br>" + '¡Actualización correcta!', 'Aceptar', 'error', '#3085d6');
    }
    document.getElementById("loadingView").style.visibility = "hidden";
    document.getElementById("loadingEdit").style.visibility = "hidden";
    document.getElementById("loadingAdd").style.visibility = "hidden";
    document.getElementById("loadingTable").style.visibility = "hidden";
    table.ajax.reload();
  }).fail(function (jqXHR, textStatus, errorThrown) {
    // Error message in console
    console.log("The following error occurred: " + textStatus + " " + errorThrown);
    // Error removal toast message
    launchGenericModal('¡Error en la solicitud Ajax!', 'Se produjo el siguiente error: ' + textStatus + " " + errorThrown, 'Aceptar', 'error');
    document.getElementById("loadingView").style.visibility = "hidden";
    document.getElementById("loadingEdit").style.visibility = "hidden";
    document.getElementById("loadingAdd").style.visibility = "hidden";
    document.getElementById("loadingTable").style.visibility = "hidden";
  }).always(function (msg) {
    // No code
  });
});

/**
 * Insert new categories via Ajax
 *
 * @returns void
 */
$("#formAddCategory").on('submit', function (e) {
  let formData = new FormData(this);
  formData.append('category_add', 'category_add'),
    e.preventDefault();
  $.ajax({
    type: 'POST',
    url: 'php/controllers/ProductCategoriesController.php',
    data: formData,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend: function () {
      document.getElementById("loadingView").style.visibility = "visible";
      document.getElementById("loadingEdit").style.visibility = "visible";
      document.getElementById("loadingAdd").style.visibility = "visible";
      document.getElementById("loadingTable").style.visibility = "visible";
    },
  }).done(function (msg) {
    let table = $('#tableProductCategories').DataTable();

    if (msg['message'] == 'success') {
      launchGenericModal('¡Registro correcto!', "<br><b>" + msg['product_category_name'] + "</b><br>" + 'Esta categoría se creo correctamente.', 'Aceptar', 'success', '#3085d6');
    } else {
      launchGenericModal('¡Error al crear!', "<br><b>" + msg['product_category_name'] + "</b><br>" + 'Esta categoría no se pudo crear.', 'Aceptar', 'error', '#3085d6');
    }
    table.ajax.reload();
    document.getElementById("loadingView").style.visibility = "hidden";
    document.getElementById("loadingEdit").style.visibility = "hidden";
    document.getElementById("loadingAdd").style.visibility = "hidden";
    document.getElementById("loadingTable").style.visibility = "hidden";
  }).fail(function (jqXHR, textStatus, errorThrown) {
    // Fail to insert new record
    launchGenericModal("Error occurred", textStatus + " " + errorThrown, 'Ok', 'error', '#3085d6', undefined);
    console.log("The following error occurred: " + textStatus + " " + errorThrown);
    document.getElementById("loadingView").style.visibility = "hidden";
    document.getElementById("loadingEdit").style.visibility = "hidden";
    document.getElementById("loadingAdd").style.visibility = "hidden";
    document.getElementById("loadingTable").style.visibility = "hidden";
  }).always(function (msg) {
    // No code
  });
});

/**
 * Get data category and set via Ajax
 *
 * @param categoryId
 * @param from
 */
function getCategoryDataAndSetAjax(category_id, from) {
  // Function that sends and receives response with AJAX
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'php/controllers/ProductCategoriesController.php',
    data: {
      categoryIdView: category_id
    }, beforeSend: function () {
      document.getElementById("loadingView").style.visibility = "visible";
      document.getElementById("loadingEdit").style.visibility = "visible";
      document.getElementById("loadingAdd").style.visibility = "visible";
      document.getElementById("loadingTable").style.visibility = "visible";
    },
  }).done(function (msg) {
    if (from == 'fromListViewButton') {
      $('#inputCategoryIdViewForm').val(msg['product_category_id']);
      $('#inputCategoryNameViewForm').val(msg['product_category_name']);
      $('#textAreaCategoryDescriptionViewForm').val(msg['product_category_description']);
      $('#selectCategoryParentNameViewForm').val(msg['product_category_parent']).change();
      $('#inputNumberOfProductsViewForm').val(msg['product_category_number_of_products']).change();
      $('#labelLastChangeDateViewForm').text(msg['product_category_date_last_change']);
      $('#labelLastCreationDateViewForm').text(msg['product_category_date_creation']);
    } else if (from == 'fromListEditButton' || from == 'fromViewFormEditButton') {
      $('#inputCategoryIdEditForm').val(msg['product_category_id']);
      $('#inputCategoryNameEditForm').val(msg['product_category_name']);
      $('#textAreaCategoryDescriptionEditForm').val(msg['product_category_description']);
      $('#selectCategoryParentNameEditForm').val(msg['product_category_parent']).change();
      $('#inputNumberOfProductsEditForm').val(msg['product_category_number_of_products']).change();
      $('#labelLastChangeDateEditForm').text(msg['product_category_date_last_change']);
      $('#labelLastCreationDateEditForm').text(msg['product_category_date_creation']);
    }
    document.getElementById("loadingView").style.visibility = "hidden";
    document.getElementById("loadingEdit").style.visibility = "hidden";
    document.getElementById("loadingAdd").style.visibility = "hidden";
    document.getElementById("loadingTable").style.visibility = "hidden";
  }).fail(function (jqXHR, textStatus, errorThrown) { // Function that is executed if something has gone wrong
    // Error message in console
    console.log("The following error occurred: " + textStatus + " " + errorThrown);
    // Error removal toast message
    launchGenericModal(modal_error_ajax_category_title, modal_error_ajax_category_text + textStatus + " " + errorThrown, 'Aceptar', 'error');
    document.getElementById("loadingView").style.visibility = "hidden";
    document.getElementById("loadingEdit").style.visibility = "hidden";
    document.getElementById("loadingAdd").style.visibility = "hidden";
    document.getElementById("loadingTable").style.visibility = "hidden";
  });
}

/** DOM Functions --------------------------------------------------------------------------------------------------*/

/**
 * Load the "Add Category" form from list categories
 * @returns void
 */
function viewAddNewCategoryForm() {
  document.getElementById('viewCategoryForm').style.display = 'none';
  document.getElementById('addNewCategoryForm').style.display = 'block';
  document.getElementById('editCategoryForm').style.display = 'none';
}

/**
 * Load the "View Category" form from list categories
 * @returns void
 */
function viewViewCategoryForm(category_id) {
  document.getElementById('viewCategoryForm').style.display = 'block';
  document.getElementById('addNewCategoryForm').style.display = 'none';
  document.getElementById('editCategoryForm').style.display = 'none';
  $("#inputCategoryIdViewForm").val(category_id);
  getCategoryDataAndSetAjax(category_id, 'fromListViewButton');
}

/**
 * Load the "Edit Category" form from list categories
 * @returns void
 */
function viewEditCategoryForm(category_id) {
  document.getElementById('viewCategoryForm').style.display = 'none';
  document.getElementById('addNewCategoryForm').style.display = 'none';
  document.getElementById('editCategoryForm').style.display = 'block';
  $('#listCategoriesSubForm').addClass("col-md-9");
  $('#addNewCategoryForm').addClass("col-md-3");
  $('#editCategoryForm').addClass("col-md-3");
  $('#viewCategoryForm').addClass("col-md-3");
  $("#inputCategoryIdEditForm").val(category_id);
  getCategoryDataAndSetAjax(category_id, 'fromListEditButton')
}

/**
 * Load the "Edit Category" form from view form
 * @returns void
 */
function viewEditCategoryFormFromViewForm() {
  let category_id = $('#inputCategoryIdViewForm').val();
  document.getElementById('viewCategoryForm').style.display = 'none';
  document.getElementById('addNewCategoryForm').style.display = 'none';
  document.getElementById('editCategoryForm').style.display = 'block';
  $('#listCategoriesSubForm').addClass("col-md-9");
  $('#addNewCategoryForm').addClass("col-md-3");
  $('#editCategoryForm').addClass("col-md-3");
  $('#viewCategoryForm').addClass("col-md-3");
  getCategoryDataAndSetAjax(category_id, 'fromViewFormEditButton')
}


/** DataTables -------------------------------------------------------------------------------------------------------*/

/***
 * DataTable initialize function
 *
 * @returns void
 * @type {*|jQuery|HTMLElement}
 */
let table = $(function () {
  $("#tableProductCategories").DataTable({
    "destroy": true,
    "processing": true,
    "serveSide": true,
    'serverMethod': 'get',
    "columnDefs": [
      {"targets": [], visible: false},
    ],
    "ajax": {
      'url': 'php/controllers/ProductCategoriesController.php',
      'type': 'GET',
      'data': {
        categories_get_all: 'categories_get_all',
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
  }).buttons().container().appendTo('#tableProductCategories_wrapper .col-md-6:eq(0)');
});

/** General Functions ------------------------------------------------------------------------------------------------*/

/**
 * Adaptive display resolution
 */
function screenResolutionAdaptative() {
  if (screen.width <= 1366) {
    $('#viewCategoryForm')
      .removeClass('col-md-3')
      .addClass('col-md-4')

    $('#editCategoryForm')
      .removeClass('col-md-3')
      .addClass('col-md-4')

    $('#addNewCategoryForm')
      .removeClass('col-md-3')
      .addClass('col-md-4')

    $('#listCategoriesSubForm')
      .removeClass('col-md-9')
      .addClass('col-md-8')
  } else if (screen.width > 1366) {
    $('#viewCategoryForm')
      .removeClass('col-md-4')
      .addClass('col-md-3')

    $('#editCategoryForm')
      .removeClass('col-md-4')
      .addClass('col-md-3')

    $('#addNewCategoryForm')
      .removeClass('col-md-4')
      .addClass('col-md-3')

    $('#listCategoriesSubForm')
      .removeClass('col-md-8')
      .addClass('col-md-9')
  }
}


/** Modals Functions -----------------------------------------------------------------------------------------------*/

/**
 * Launch a modal delete category
 * @param category_id
 * @param category_name
 * @param number_products
 * @param number_child
 */
function modalDeleteCategory(category_id, category_name, number_products, number_child) {
  Swal.fire({
    title: '¿Está seguro de que desea eliminar ' + category_name + '?',
    text: 'Esta operación no se puede revertir.',
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#007bff",
    cancelButtonColor: "#d33",
    confirmButtonText: 'Aceptar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      deleteCategoryAjax(category_id, category_name, number_products, number_child);
    }
  });
}