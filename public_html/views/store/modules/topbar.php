<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Template file
   * File description:    Contains the template topbar module.
   * Module:              Template Store
   * -------------------------------------------------------------------------------------------------------------------
   */
?>

<!-- Topbar Start -->
<div class="container-fluid">
  <div class="row bg-secondary py-1 px-xl-5">
    
    <!-- Top menu /-->
    <div class="col-lg-6 d-none d-lg-block">
      <div class="d-inline-flex align-items-center h-100">
        <a class="text-body mr-3" href="">Nosostros</a>
        <a class="text-body mr-3" href="">Contacto</a>
        <a class="text-body mr-3" href="">Ayuda</a>
        <a class="text-body mr-3" href="">Preguntas</a>
      </div>
    </div>
    
    <!-- Sign in - Currency - Language Menus /-->
    <div class="col-lg-6 text-center text-lg-right" >
      <div class="d-inline-flex align-items-center">
        <div class="btn-group" id="buttonMyAccount">
          <a href="#" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Mi Cuenta</a>
          <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item" type="button">Iniciar sesión</button>
          </div>
        </div>
        <div class="btn-group mx-2">
          <a href="#" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">MXN</a>
          <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item" type="button">USD</button>

          </div>
        </div>
        
        
      </div>
      <div class="d-inline-flex align-items-center d-block d-lg-none">
        <a href="" class="btn px-0 ml-2">
          <i class="fas fa-heart text-dark"></i>
          <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
        </a>
        <a href="" class="btn px-0 ml-2">
          <i class="fas fa-shopping-cart text-dark"></i>
          <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
        </a>
      </div>
    </div>
  </div>
  
  <!-- Logo and name -->
  <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
    <div class="col-lg-4">
      <a href="" class="text-decoration-none">
        <span class="h1 text-uppercase text-primary bg-dark px-2">ZOE</span>
        <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">STORE</span>
      </a>
    </div>
    
    <!-- Search -->
    <div class="col-lg-4 col-6 text-left">
      <form action="">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Búsqueda de productos">
          <div class="input-group-append">
            <span class="input-group-text bg-transparent text-primary">
                <i class="fa fa-search"></i>
            </span>
          </div>
        </div>
      </form>
    </div>
    
    <!-- Customer service /-->
    <div class="col-lg-4 col-6 text-right">
      <p class="m-0">Servicio al Cliente</p>
      <h5 class="m-0">+012 345 6789</h5>
    </div>
  </div>
  
</div>
<!-- Topbar End -->

<script>
  document.getElementById("buttonMyAccount").addEventListener("click", function(event){
    event.preventDefault()
  });
</script>