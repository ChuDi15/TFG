<?php if(isset($_SESSION['loggedInAdmin'])){


if(!isset($_SESSION['busquedaJuegos'])){

?>

<h2 class='text-center text-white p-4'> Introduce el juego que quieres borrar en la busqueda </h2>



<form method="post" class="my-form formBorrarJuego" action="<?php echo base_url('/homeAdmin/borrarJuego') ?>" name="formBorrarJuego">
  <div class="container ">
    <h2 class='text-center text-white p-4'> Busqueda de juego para eliminación </h2>
    <ul>
      <li>
        <div class="grid-1">
          <input type="text" style="text-align:center;" name="juegoBorrar" placeholder="" >  
         
        </div>
      </li>
      <li>
      <div class="grid ">
        <input type="submit" name="borrarJuegoSubmit" value="Buscar">
        </div>
      </li>

    </ul>
    
  </div>
</form>

<?php }else{

    $tamaño = count($_SESSION['busquedaJuegos']['id']);
    echo '<form method="post" class="formBorrarJuego" action="'.base_url("/homeAdmin/borrarJuego").'" id="formBorrarJuegoFinal" name="formBorrarJuegoFinal">';
    for($i=0; $i<$tamaño; $i++){
        
        echo"
        <div class='text-center p-3 mt-5'>
            <button name='busquedaJuegoFinal' onclick='return confirm('Estas seguro de que quieres borrarlo?')' class='myButton' type='submit' value='".$_SESSION['busquedaJuegos']['id'][$i]."'>".$_SESSION['busquedaJuegos']['nombre'][$i]."</button>
        </div>
        
        ";


    }
    echo "</form>";
    unset($_SESSION['busquedaJuegos']);

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
        if(!confirm('Estas seguro de borrar este juego? Esta accion es irreversible')){
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