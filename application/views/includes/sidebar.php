<aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="profile.html"><img src="<?php echo base_url(); ?>assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
              	  <h5 class="centered">
                    <?php 
                    if (isset($_SESSION['nombre']) && isset($_SESSION['apellidos'])) {
                        echo strtoupper($_SESSION['nombre'] . " " . $_SESSION['apellidos']);
                    }
                    
                    ?>
                  </h5>
              	  	
                  <li class="mt">
                      <a class="active" href="<?php echo base_url()."DashBoard" ?>">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <?php 
                  //Solo se mostrará si es profesor
                  if($_SESSION['tipo'] == "profesor") {
                  ?>
                  <li class="sub-menu">
                      <a href="<?php echo base_url()."DashBoard/gestionAlumnos" ?>" >
                          <i class="fa fa-th"></i>
                          <span>Gestión de Alumnos</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="<?php echo base_url(); ?>DashBoard/crearTareas" >
                          <i class="fa fa-desktop"></i>
                          <span>Crear Tareas</span>
                      </a>
                  </li>
                  <?php 
                  }
                  ?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Mis Tareas</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>Mensajes</span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>