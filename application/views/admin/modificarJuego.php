
<?php if(isset($_SESSION['loggedInAdmin'])){



if(!isset($_SESSION['busquedaJuegosModif'])){

?>

<h2 class='text-center text-white p-4'> Introduce el juego que quieres modificar en la busqueda </h2>



<form method="post" class="my-form formModificarJuego" action="<?php echo base_url('/homeAdmin/ModificarJuego') ?>" name="formModificarJuego">
  <div class="container ">
    <h2 class='text-center text-white p-4'> Busqueda de juego para modificación </h2>
    <ul>
      <li>
        <div class="grid-1">
          <input type="text" style="text-align:center;" name="juegoModificar" placeholder="" >  
         
        </div>
      </li>
      <li>
      <div class="grid ">
        <input type="submit" name="ModificarJuegoSubmit" value="Buscar">
        </div>
      </li>

    </ul>
    
  </div>
</form>

<?php }else if(isset($_POST['busquedaJuegoFinalModif'])){


    $this->db->select('*');
    $this->db->from('videojuegos');
    $this->db->where('id',$_POST['busquedaJuegoFinalModif']);
    $query = $this->db->get();
    $i=0;
    foreach ($query->result() as $row)
    {
        echo '
        <form method="post" class="my-form formModificarGuardar" action="'. base_url("/homeAdmin/modificarJuego") .'?>" id="formModificar" name="formModificar">
            <div class="container text-white">
            <h2 class="text-center text-white p-2"> A continuación todas los cambios serán guardados al pulsar el boton Modificar </h2>
            <ul>
                <li>
                    
                Nombre:<input type="text" id="nombre" name="nombre" required value="'.$row->nombre.'">
                </li>
                <li>
                    Descripcion:<textarea name="descripcion" id="descripcion" required>' .$row->descripcion.'</textarea>
                
                </li>
                <li>
            
                    Imagen:<input type="text" name="imagen" id="imagen" required value="'.$row->imagen.'">
                    </li>
                <li>
                    Trailer:<input type="text" name="trailer" id="trailer" required value="'.$row->trailer.'">
                
                </li>
                
                <div class="grid 2">
                    <input type="hidden" name="id" value="'.$row->id.'">
                    <div class="required-msg text-white">CAMPOS OBLIGATORIOS</div>
                    <input type="button" id="modificarJuegoSubmit" name="modificarJuegoSubmit" value="Modificar">
                </div>
            

            </ul>
                
            </div>
        </form>
        ';    
        

    }

    unset($_SESSION['busquedaJuegosModif']);


    }else{

    $tamaño = count($_SESSION['busquedaJuegosModif']['id']);
    echo '<form method="post" class="formModificarJuego" action="'.base_url("/homeAdmin/ModificarJuego").'" name="formModificarJuegoFinal">';
    for($i=0; $i<$tamaño; $i++){
        
        echo"
        <div class='text-center p-3 mt-5'>
            <button name='busquedaJuegoFinalModif' class='myButton' type='submit' value='".$_SESSION['busquedaJuegosModif']['id'][$i]."'>".$_SESSION['busquedaJuegosModif']['nombre'][$i]."</button>
        </div>
        
        ";


    }
    echo "</form>";
    

/*
echo "  <div class='text-center'>
<button type='submit' value='$row->id'>$row->nombre</button>
</div>" ;
*/


?>

                
               
                



<?php } ?>

<script>
  
$('#modificarJuegoSubmit').click(function(){
        if($('#nombre').val() == ""){
            alert('Debes rellenar el nombre del juego');
        }else if($('#descripcion').val() == ""){
            alert('Debes rellenar la descripcion del juego');
        }else if($('#imagen').val() == ""){
            alert('Debes rellenar el imagen del juego');
        }else if($('#trailer').val() == ""){
            alert('Debes rellenar la trailer del juego');

        }else{
			$('#formModificar').submit();
		}
        });

</script>

<?php }else {

header("Location: /homeAdmin");

}?>