<?php if(isset($_SESSION['loggedInAdmin'])){


if(!isset($_SESSION['busquedaUsuario'])){

?>

<h2 class='text-center text-white p-4'> Introduce el Usuario que quieres borrar en la busqueda </h2>



<form method="post" class="my-form formBorrarUsuario" action="<?php echo base_url('/homeAdmin/borrarUsuario') ?>" name="formBorrarUsuario">
  <div class="container ">
    <h2 class='text-center text-white p-4'> Busqueda de Usuario para eliminación </h2>
    <ul>
      <li>
        <div class="grid-1">
          <input type="text" style="text-align:center;" name="usuarioBorrar" placeholder="" >  
         
        </div>
      </li>
      <li>
      <div class="grid ">
        <input type="submit" name="borrarUsuarioSubmit" value="Buscar">
        </div>
      </li>

    </ul>
    
  </div>
</form>

<?php }else{

    $tamaño = count($_SESSION['busquedaUsuario']['usuario']);
    echo '<form method="post" class="formBorrarUsuario" action="'.base_url("/homeAdmin/borrarUsuario").'" id="formBorrarUsuarioFinal" name="formBorrarUsuarioFinal">';
    for($i=0; $i<$tamaño; $i++){
        
        echo"
        <div class='text-center p-3 mt-5'>
            <button name='busquedaUsuarioFinal' onclick='return confirm('Estas seguro de que quieres borrarlo?')' class='myButton' type='submit' value='".$_SESSION['busquedaUsuario']['usuario'][$i]."'>".$_SESSION['busquedaUsuario']['usuario'][$i]."</button>
        </div>
        
        ";


    }
    echo "</form>";
    unset($_SESSION['busquedaUsuario']);

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
        if(!confirm('Estas seguro de borrar este Usuario? Esta accion es irreversible')){
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