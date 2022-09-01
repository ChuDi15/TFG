
<?php if(isset($_SESSION['loggedInAdmin'])){



if(!isset($_SESSION['busquedaUsuarioModif'])){

?>

<h2 class='text-center text-white p-4'> Introduce el usuario que quieres modificar en la busqueda </h2>



<form method="post" class="my-form formModificarUsuario" action="<?php echo base_url('/homeAdmin/modificarUsuario') ?>" name="formModificarUsuario">
  <div class="container ">
    <h2 class='text-center text-white p-4'> Busqueda de usuario para modificación </h2>
    <ul>
      <li>
        <div class="grid-1">
          <input type="text" style="text-align:center;" name="usuarioModificar" placeholder="" >  
         
        </div>
      </li>
      <li>
      <div class="grid ">
        <input type="submit" name="modificarUsuarioSubmit" value="Buscar">
        </div>
      </li>

    </ul>
    
  </div>
</form>

<?php }else if(isset($_POST['busquedaUsuarioFinalModif'])){


    $this->db->select('*');
    $this->db->from('usuarios');
    $this->db->where('usuario',$_POST['busquedaUsuarioFinalModif']);
    $query = $this->db->get();
    $i=0;
    foreach ($query->result() as $row)
    {
        echo '
        <form method="post" class="my-form formModificarGuardar" action="'. base_url("/homeAdmin/modificarUsuario") .'?>" id="formModificarUsuario" name="formModificar">
            <div class="container text-white">
            <h2 class="text-center text-white p-2"> A continuación todas los cambios serán guardados al pulsar el boton Modificar </h2>
            <ul>
                <li>
                    
                Nombre:<input type="text" id="usuario" name="usuario" required value="'.$row->usuario.'">

                </li>
                <li>
                    
                Email:<input type="email" id="email" name="email" required value="'.$row->email.'">

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
                    <input type="button" id="modificarUsuarioSubmit" name="modificarUsuarioSubmit" value="Modificar">
                </div>
            

            </ul>
                
            </div>
        </form>
        ';    
        

    }

    unset($_SESSION['busquedaUsuarioModif']);


    }else{

    $tamaño = count($_SESSION['busquedaUsuarioModif']['usuario']);
    echo '<form method="post" class="formModificarUsuario" action="'.base_url("/homeAdmin/ModificarUsuario").'" name="formModificarUsuarioFinal">';
    for($i=0; $i<$tamaño; $i++){
        
        echo"
        <div class='text-center p-3 mt-5'>
            <button name='busquedaUsuarioFinalModif' class='myButton' type='submit' value='".$_SESSION['busquedaUsuarioModif']['usuario'][$i]."'>".$_SESSION['busquedaUsuarioModif']['usuario'][$i]."</button>
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
var regex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;

togglePassword.addEventListener("click", function () {
   
  // toggle the type attribute
  const type = password.getAttribute("type") === "password" ? "text" : "password";
  password.setAttribute("type", type);
  // toggle the eye icon
  this.classList.toggle('fa-eye');
  this.classList.toggle('fa-eye-slash');
});

$('#modificarUsuarioSubmit').click(function(){
        if($('#usuario').val() == ""){
            alert('Debes rellenar el nombre del usuario');
        }else if($('#password').val() == ""){
            alert('Debes rellenar la contraseña del usuario');
        }else if($('#email').val() == ""){
            alert('Debes rellenar el email del usuario');
        }else if(!regex.test($("#email").val())){
            alert('email no valido');
        }else{
			$('#formModificarUsuario').submit();
		}
        });
</script>

<?php }else {

header("Location: /homeAdmin");

}?>