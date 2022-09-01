
<?php if(isset($_SESSION['loggedInAdmin'])){



if(!isset($_SESSION['busquedaAdminModif'])){

?>

<h2 class='text-center text-white p-4'> Introduce el admin que quieres modificar en la busqueda </h2>



<form method="post" class="my-form formModificarAdmin" action="<?php echo base_url('/homeAdmin/modificarAdmin') ?>" name="formModificarAdmin">
  <div class="container ">
    <h2 class='text-center text-white p-4'> Busqueda de admin para modificación </h2>
    <ul>
      <li>
        <div class="grid-1">
          <input type="text" style="text-align:center;" name="adminModificar" placeholder="" >  
         
        </div>
      </li>
      <li>
      <div class="grid ">
        <input type="submit" name="modificarAdminSubmit" value="Buscar">
        </div>
      </li>

    </ul>
    
  </div>
</form>

<?php }else if(isset($_POST['busquedaAdminFinalModif'])){


    $this->db->select('*');
    $this->db->from('usuariosadmin');
    $this->db->where('usuario',$_POST['busquedaAdminFinalModif']);
    $query = $this->db->get();
    $i=0;
    foreach ($query->result() as $row)
    {
        echo '
        <form method="post" class="my-form formModificarGuardar" action="'. base_url("/homeAdmin/modificarAdmin") .'?>" id="formModificarAdmin" name="formModificar">
            <div class="container text-white">
            <h2 class="text-center text-white p-2"> A continuación todas los cambios serán guardados al pulsar el boton Modificar </h2>
            <ul>
                <li>
                    
                Nombre:<input type="text" id="usuario" name="usuario" required value="'.$row->usuario.'">

                </li>
                <li>
                
                Contraseña:<input type="password" id="password" class="form-control" data-toggle="password" name="contraseña" required value="'.$row->contraseña.'">
                <span class="input-group-text" style="width:2vw; min-width:45px;">
                    <i class="far fa-eye" id="togglePassword" 
                  style="cursor: pointer"></i>
                  </span>
                
              

                </li>
                
                <div class="grid 2">
                    <div class="required-msg text-white">CAMPOS OBLIGATORIOS</div>
                    <input type="button" id="modificarAdminSubmit" name="modificarAdminSubmit" value="Modificar">
                </div>
            

            </ul>
                
            </div>
        </form>
        ';    
        

    }

    unset($_SESSION['busquedaAdminModif']);


    }else{

    $tamaño = count($_SESSION['busquedaAdminModif']['usuario']);
    echo '<form method="post" class="formModificarAdmin" action="'.base_url("/homeAdmin/ModificarAdmin").'" name="formModificarAdminFinal">';
    for($i=0; $i<$tamaño; $i++){
        
        echo"
        <div class='text-center p-3 mt-5'>
            <button name='busquedaAdminFinalModif' class='myButton' type='submit' value='".$_SESSION['busquedaAdminModif']['usuario'][$i]."'>".$_SESSION['busquedaAdminModif']['usuario'][$i]."</button>
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
  const togglePassword = document.querySelector("#togglePassword");
  const password = document.querySelector("#password");

togglePassword.addEventListener("click", function () {
   
  // toggle the type attribute
  const type = password.getAttribute("type") === "password" ? "text" : "password";
  password.setAttribute("type", type);
  // toggle the eye icon
  this.classList.toggle('fa-eye');
  this.classList.toggle('fa-eye-slash');
});
$('#modificarAdminSubmit').click(function(){
        if($('#usuario').val() == ""){
            alert('Debes rellenar el nombre del admin');
        }else if($('#contraseña').val() == ""){
            alert('Debes rellenar la contraseña del admin');
        }else{
			$('#formModificarAdmin').submit();
		}
        });

</script>

<?php }else {

header("Location: /homeAdmin");

}?>