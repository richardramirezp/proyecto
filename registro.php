<?php 
  include ('conexi.php');
  /*Recoleccion de Variables*/
  $inicio=0;
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

  <title>Voluntariado - Registro</title>
  <link rel="icon" type="image/png" href="img/inicio.png" />

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="fonts/letras.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-12">

        <div class="card o-hidden border-0 shadow-lg my-5" style="">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6">
                <div class="p-5" style="margin-top: 140px;margin-bottom: 140px;">
                  <div class="text-center">
                    <h1 class="h1 text-gray-900 mb-4">Bienvenido!</h1>
                  </div>
                  <form class="user" action="index.php" method="post">
                    <div class="form-group">
                      <input class="form-control form-control-user" id="usu" type="text" name="txtlogin" required="true" placeholder="Usuario">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="pass" name="txtpass" placeholder="Password" required="true" >
                    </div>
                    <div class="form-group">
                    </div>
                    <input class="btn btn-primary btn-user btn-block" type="submit" value="Ingresar" >
                  </form><br><br>
                  <?php 
                    if ($inicio == 1){
                      echo 
                        "<div class='col-md-12' id='mensaje'>
                          <div class='alert alert-danger'>
                              <strong>Advertencia!</strong> El Nombre De Usuario o La Contraseña Es Incorrecta.
                          </div>
                        </div>";
                    }else{
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
<?php
  if(isset($_POST['txtpass'])) 
  {
    session_start();
    //variable de conexion: recibe dirección del host , usuario, contraseña y el nombre base de datos
    $mysqli = new mysqli("localhost", "admin", "1234", "voluntariado") or die ("Error de conexion porque: ".$mysqli->connect_errno);
    // comprobar la conexión 
    if (mysqli_connect_errno()) 
    {
        printf("Falló la conexión: %s\n", mysqli_connect_error());
        exit();
    }
    printf("", $mysqli->character_set_name());
    /* cambiar el conjunto de caracteres a utf8 */
    if (!$mysqli->set_charset("utf8")) {
        printf("", $mysqli->error);
        exit();
    } else {
        printf("", $mysqli->character_set_name());
    }

    $login = $mysqli->real_escape_string($_POST['txtlogin']); 
    $pass = $mysqli->real_escape_string($_POST['txtpass']);
    
    $resultado = $mysqli->query("SELECT * FROM usuario where login='$login' and pass='$pass'");
    $valida=$resultado->num_rows;
    if($valida != 0)
    {
      $datosUsu = $resultado->fetch_row();
      $_SESSION['id_usuario'] = $datosUsu[0];
      $_SESSION['nombreusu'] = $datosUsu[1];
      $_SESSION['apellidousu'] = $datosUsu[2];
      $_SESSION['perfil'] = $datosUsu[5];   
      $_SESSION['login'] = $datosUsu[3];  
            
      echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=dashboard.php'>";
    }
    else
    {
      echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?inicio=1'>";
    } 
  }
  
  
?>
