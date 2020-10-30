<?php
  session_start();
  include 'conexi.php';
  if(isset($_SESSION['perfil']))
  {
    foreach ($_REQUEST as $var => $val) {
        $$var=$val;
      }
      
      $secol = "Select * from programa where id_programa='$id_programa'";
      $sql = mysqli_query($enlace,$secol);
      $row = mysqli_fetch_array($sql);

  if(isset($_POST['codigo'])) 
  {
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

    $pass = $mysqli->real_escape_string($_POST['codigo']); 
    $user = $mysqli->real_escape_string($_POST['usuario']); 
    $prog = $mysqli->real_escape_string($_POST['id_programa']); 
    $nombre = $mysqli->real_escape_string($_POST['nombre']); 
    
    $resultado = $mysqli->query("SELECT * FROM codigos_pc  INNER JOIN programa on codigos_pc.id_programa=programa.id_programa WHERE codigos_pc.codigo='$pass' and programa.id_programa='$prog'");
    $valida=$resultado->num_rows;
    if($valida != 0)
    {     
      header("Location: programa.php?&id_programa=".$id_programa."&nombre=".$nombre);
    }
    else
    {
      header("Location: dashboard.php?&recibido=1");
    } 
  }

  }
?>