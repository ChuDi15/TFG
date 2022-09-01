<?php if(isset($_SESSION['loggedInAdmin'])){


if(isset($_SESSION['usuarioAdminExistente'])){
            
  echo '<script language="javascript">alert("Este usuario ya existe");</script>';
  unset($_SESSION['usuarioAdminExistente']);
  
}

?>


<form class="my-form crearUsuarioFrom" id="formularioAdminCrear" method="post" action="<?php echo base_url('/homeAdmin/crearUsuarioAdmin') ?>">
  <div class="container">
    <h2 class='text-center text-white p-2'> Crear nuevo usuario </h2>
    <ul>
      <li>
        <div class="grid grid-2">
          <input type="text" name="crearUsuarioAdmin" id="crearUsuarioAdmin" placeholder="Nombre de usuario" required>  
          <input type="password" name="crearContraseñaAdmin" id="password" class="form-control" data-toggle="password" placeholder="Contraseña" required>
          <div class="grid grid-2 text-white">
        Ver contraseña:
        <span class="input-group-text" style="width:2vw; min-width:45px;">
                    <i class="far fa-eye" id="togglePassword" 
                  style="cursor: pointer"></i>
                  </span>
          </div>
        </div>
       

      </li>
      <li>
        <input type="checkbox"  id="terms" >
        <label for="terms"> Confirmar </label>
      </li>  
      <li>
        <div class="grid grid-3">
          <div class="required-msg text-white">CAMPOS OBLIGATORIOS</div>
          <button class="btn-grid" type="button" id="btnCrear" disabled>
            <span class="back">
              <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/email-icon.svg" alt="">
            </span>
            <span class="front">ENVIAR</span>
          </button>
          <button class="btn-grid" type="reset" disabled>
            <span class="back">
              <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/eraser-icon.svg" alt="">
            </span>
            <span class="front">RESETEAR</span>
          </button> 
        </div>
      </li>    
    </ul>
  </div>
</form>

<script>


const checkbox = document.querySelector('.my-form input[type="checkbox"]');
const btns = document.querySelectorAll(".my-form button");

checkbox.addEventListener("change", function() {
  const checked = this.checked;
  for (const btn of btns) {
    checked ? (btn.disabled = false) : (btn.disabled = true);
  }
});


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
  
$('#btnCrear').click(function(){
        if($('#crearUsuarioAdmin').val() == ""){
            alert('Debes rellenar el nombre del administrador');
        }else if($('#crearContraseñaAdmin').val() == ""){
          alert('Debes rellenar la contraseña del administrador');
        }else{
			$('#formularioAdminCrear').submit();
		}
        });

</script>

<?php }else {
  header("Location: /homeAdmin");
}?>