<?php
  if(isset($_POST['codig'])) 
  {
    foreach ($_REQUEST as $var => $val) {
        $$var=$val;
      }
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

    $login = $mysqli->real_escape_string($_POST['codig']);
    
    $resultado = $mysqli->query("SELECT * FROM codigos_pc INNER JOIN colegio ON codigos_pc.id_colegio=colegio.id_colegio WHERE codigos_pc.codigo_col='$login' AND colegio.id_colegio='$id_colegio'");
    $valida=$resultado->num_rows;
    if($valida != 0)
    {
      $datosUsu = $resultado->fetch_row();
      $_SESSION['nombre'] = $datosUsu[4]; 
            
      header("Location: listar_colegios.php?&id_colegio=".$id_colegio."&nombre=".$nombre);
    }
    else
    {
      header("Location: dashboard.php?&recibido=1");
    } 
  }
?>