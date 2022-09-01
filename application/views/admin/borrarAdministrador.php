<?php if(isset($_SESSION['loggedInAdmin'])){


if(!isset($_SESSION['busquedaAdministrador'])){

?>

<h2 class='text-center text-white p-4'> Introduce el Administrador que quieres borrar en la busqueda </h2>



<form method="post" class="my-form formBorrarAdministrador" action="<?php echo base_url('/homeAdmin/borrarAdministrador') ?>" name="formBorrarAdministrador">
  <div class="container ">
    <h2 class='text-center text-white p-4'> Busqueda de Administrador para eliminación </h2>
    <ul>
      <li>
        <div class="grid-1">
          <input type="text" style="text-align:center;" name="administradorBorrar" placeholder="" >  
         
        </div>
      </li>
      <li>
      <div class="grid ">
        <input type="submit" name="borrarAdministradorSubmit" value="Buscar">
        </div>
      </li>

    </ul>
    
  </div>
</form>

<?php }else{

    $tamaño = count($_SESSION['busquedaAdministrador']['usuario']);
    echo '<form method="post" class="formBorrarAdministrador" action="'.base_url("/homeAdmin/borrarAdministrador").'" id="formBorrarAdministradorFinal" name="formBorrarAdministradorFinal">';
    for($i=0; $i<$tamaño; $i++){
        
        echo"
        <div class='text-center p-3 mt-5'>
            <button name='busquedaAdministradorFinal' onclick='return confirm('Estas seguro de que quieres borrarlo?')' class='myButton' type='submit' value='".$_SESSION['busquedaAdministrador']['usuario'][$i]."'>".$_SESSION['busquedaAdministrador']['usuario'][$i]."</button>
        </div>
        
        ";


    }
    echo "</form>";
    unset($_SESSION['busquedaAdministrador']);

/*
echo "  <div class='text-center'>
<button type='submit' value='$row->id'>$row->nombre</button>
</div>" ;
*/


?>


<?php } ?>

<script language="JavaScript" type="text/javascript">
$(document).ready(function(){
    $(".myButton").click(function(e){
        if(!confirm('Estas seguro de borrar este Administrador? Esta accion es irreversible')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});
</script>

<?php }else {

header("Location: /homeAdmin");

}?>