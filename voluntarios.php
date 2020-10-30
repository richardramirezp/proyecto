<?php
  include ('conexi.php'); 
  session_start();
  if(isset($_SESSION['perfil'])){   
    $recibido = 0;
    foreach ($_REQUEST as $var => $val) {
      $$var=$val;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Voluntarios</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="fonts/fonts.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="img/voluntary.png" />
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/estilo.css" rel="stylesheet">

</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
        </div>
        <div class="sidebar-brand-text mx-3">Voluntariado</div>
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Inicio</span></a>
      </li>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-list-ul"></i>
          <span>Programas</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Programas:</h6>
            <?php 
              $secol = "Select * from programa";
              $sql = mysqli_query($enlace,$secol);
              while($row = mysqli_fetch_array($sql)){?>
                  <a class="collapse-item codigoEnt" data-toggle="modal" data-target="#ModalCapa" href="" data-idprograma="<?php echo $row['id_programa'];?>">
                    <?php echo $row['nombre'];?>
                  </a>
            <?php } ?>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTree" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-school"></i>
          <span>Labor Social</span>
        </a>
        <div id="collapseTree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Colegios:</h6>
            <?php 
              $se = "Select * from colegio";
              $sql = mysqli_query($enlace,$se);
              while($row = mysqli_fetch_array($sql)){?>
                  <a class="collapse-item codigoCol" data-toggle="modal" data-target="#CodigoCol" href="" data-idcolegio="<?php echo $row['id_colegio'];?>">
                    <?php echo $row['nombre'];?>
                  </a>
            <?php } ?>
            <a class="collapse-item" href="reporte.php">Historial</a>
          </div>
        </div>
      </li>
      <li class="nav-item active">
        <a class="nav-link collapsed" href="voluntarios.php" data-toggle="" data-target="" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-child"></i>
          <span>Voluntarios</span>
        </a>
      </li>
      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-clipboard-list"></i>
          <span>Reportes</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Reportes Horas:</h6>
            <a class="collapse-item" href="horas_mes.php">Total Horas Mes</a>
             <a class="collapse-item" href="reporte_hora.php">Total Horas Voluntarios</a>
          </div>
        </div>
      </li>
    </ul>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['perfil'] ?></span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="cerrars.php">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar Sesi&oacute;n
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabla De Datos Voluntarios</h6>
            </div>
            <div class="card-body">
              <button type="button" class="btn btn-lg btn-success agregarEst" data-toggle="modal" data-target="#agregarVol" data-idcolegio="<?php echo $id_colegio; ?>"><i class="fas fa-user-plus"></i></button><br><br>
              <?php if($recibido == 1){ ?>
                <div class="alert alert-success col-xl-12 col-md-6 mb-4">
                  <strong>Exito!</strong> Voluntario Agregado. 
                </div>
              <?php }elseif ($recibido == 2) { ?>
                <div class="alert alert-danger col-xl-12 col-md-6 mb-4">
                  <strong>Exito!</strong> Voluntario No Agregado. 
                </div>
                <?php }elseif($recibido == 3){ ?>
                <div class="alert alert-success col-xl-12 col-md-6 mb-4">
                  <strong>Exito!</strong> Voluntario Editado. 
                </div>
              <?php }elseif ($recibido == 4) { ?>
                <div class="alert alert-danger col-xl-12 col-md-6 mb-4">
                  <strong>Exito!</strong> Voluntario No Editado. 
                </div>
              <?php }elseif ($recibido == 5) { ?>
                <div class="alert alert-success col-xl-12 col-md-6 mb-4">
                  <strong>Exito!</strong> Voluntario Eliminado. 
                </div>
              <?php }elseif ($recibido == 6) { ?>
                <div class="alert alert-danger col-xl-12 col-md-6 mb-4">
                  <strong>Advertencia!</strong> Voluntario No Eliminado. 
                </div>
              <?php }elseif ($recibido == 7) { ?>
                <div class="alert alert-info col-xl-12 col-md-6 mb-4">
                  <strong>Informaci&oacute;n!</strong> El Voluntario ya se encuentra registrado, <strong>D.I <?php echo $documento?>. </strong>
                </div>
               <?php } ?>
              <div class="table-responsive">
                <table id="listar" class="table table-striped table-bordered"  >
                  <thead>
                    <tr>
                      <th>Documento</th>
                      <th>Nombre</th>
                      <th>Direcci&oacute;n</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
          <?php
            $consulta= "select * from voluntario left join pro_vol on voluntario.id_voluntario=pro_vol.id_voluntario group by documento";
            $sql = mysqli_query($enlace,$consulta);
            while ($fila = mysqli_fetch_array($sql)){?>
              <tr>
                <td>
                  <?php echo $fila['documento']; ?>
                </td>
                <td>
                  <?php echo $fila['nombre']; ?> <?php echo $fila['apellido']; ?>
                </td>
                <td>
                  <?php echo $fila['direccion']; ?>
                </td>
                <td>
                  <button type="button" class="btn btn-sm btn-warning editarVoluntario" data-toggle="modal" data-target="#editarVol" data-idvoluntario="<?php echo $fila['0']; ?>" ><i class="fas fa-user-edit"></i></button>

                  <button type="button" class="btn btn-sm btn-danger eliminarVoluntario" data-toggle="modal" data-target="#ModalEliminar" data-idvoluntario="<?php echo $fila['0']; ?>" data-idprovol="<?php echo $fila['id_pro_vol']; ?>"><i class="fas fa-user-times"></i></button>

                  
                </td>
              </tr>
          <?php } ?>      
        </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
         </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

      
         

<!-- Modal -->
<div class="modal fade "  id="ModalCapa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Codigo Programa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="contenido_agregar">
              <!--Contenido Del Cuerpo-->
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade "  id="CodigoCol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Codigo Colegio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="contenido_col">
              <!--Contenido Del Cuerpo-->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal Agregar Usuario-->
<div class="modal fade "  id="agregarVol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Voluntario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="consultas/voluntarios/insertar_voluntario.php" method="POST">
        <div class="col-md-12">
          Documento
          <input type="text" class="form-control" name="documento" required="true">
        </div><div><br></div>
        <div class="col-md-12">
          Nombre
          <input type="text" class="form-control" name="nombre" required="true">
        </div><div><br></div>
        <div class="col-md-12">
          Apellidos
          <input type="text" class="form-control" name="apellido" required="true">
        </div><div><br></div>
        <div class="col-md-12">
          Direcci&oacute;n
          <input type="text" class="form-control" name="direccion" required="true">
        </div><div><br></div>
      </div>
      <div class="modal-footer">
        <input class="btn btn-sm btn-success" type="submit" name="Grabar">
      <button type="button" class="btn btn-sm btn-info" data-dismiss="modal">Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Editar voluntario-->
<div class="modal fade "  id="editarVol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Voluntario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="contenido">
          
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Eliminar-->
<div class="modal fade "  id="ModalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">Advertencia!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="eliminar"></div>
      </div>
    </div>
  </div>
</div>

  <!-- Modal Informacion-->


  
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script src="js/acciones.js"></script>
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/calen.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/dataTables.buttons.min.js"></script>
  <script src="js/buttons.flash.min.js"></script>
  <script src="js/jszip.min.js"></script>
  <script src="js/pdfmake.min.js"></script>
  <script src="js/vfs_fonts.js"></script>
  <script src="js/buttons.html5.min.js"></script>
  <script src="js/buttons.colVis.min.js"></script>
  <script src="js/buttons.print.min.js"></script>
  <script>
    //Funcion DataTable
    $(document).ready( function () {
      $('#listar').DataTable({
            "order": [[ 0, 'desc' ]],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                text: 'Copiar',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2]
                }
            },
            {
                extend: 'colvis',
                text: 'Visualizar Columnas',
            }
            
        ],
          "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
          "language": {
          "sProcessing":     "Procesando...",
          "sLengthMenu":     "Mostrar _MENU_ registros",
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "Ningún dato disponible en esta tabla",
          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix":    "",
          "sSearch":         "Buscar:",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
              "sFirst":    "Primero",
              "sLast":     "Último",
              "sNext":     "Siguiente",
              "sPrevious": "Anterior"
          },
            "oAria": {
              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
            
      }); 
    });
  </script>

</body>

</html>
<?php } ?>