<?php
  session_start();
  include 'conexi.php';
  if(isset($_SESSION['perfil']))
  {
    foreach ($_REQUEST as $var => $val) {
        $$var=$val;
      }
      
  $secol = "Select * from colegio where id_colegio='$id_colegio'";
  $sql = mysqli_query($enlace,$secol);
  $row = mysqli_fetch_array($sql);
?>
<form action="validacion_col.php" method="post">
  <div class="col-md-8">
    <input type="hidden" class="form-control" name="id_colegio" value="<?php echo $id_colegio ?>">
    <input type="hidden" class="form-control" name="nombre" value="<?php echo $row['nombre'] ?>">
    <input type="hidden" class="form-control" name="usuario" value="<?php echo $_SESSION['login'] ?>">
    <input type="password" class="form-control" name="codig" required="true">
  </div><div><br></div>
  <div class="modal-footer">
    <input class="btn btn-sm btn-success" type="submit" name="Grabar">
    <button type="button" class="btn btn-sm btn-info" data-dismiss="modal">Cancelar</button>
  </div>
</form>

<?php } ?>