<?php if(isset($_SESSION['loggedInAdmin'])){
  
if(isset($_SESSION['usuarioExistente'])){
            
  echo '<script language="javascript">alert("Este usuario ya existe");</script>';
  unset($_SESSION['usuarioExistente']);
  
}


?>
<form class="my-form crearJuegoForm" id="formularioJuego" method="post" action="<?php echo base_url('/homeAdmin/crearJuegoBBDD') ?>">
  <div class="container">
  <h2 class='text-center text-white p-2'> Crear nuevo juego </h2>
    <ul>
      <li>
        <div class="grid grid-2">
          <input type="text" name="nombreJuego" id="nombreJuego" placeholder="Nombre del juego" required>  
          <input type="text" name="urlJuego" id="urlJuego" placeholder="URL a imagen del juego" required>
        </div>
      </li>
      <li>
        
          <input type="text" name="trailerJuego" id="trailerJuego" placeholder="Trailer del juego" required>  
      
      </li>    
      <li>
        <textarea placeholder="Descripcion"  name="descripcionJuego" id="descripcionJuego" required></textarea>
      </li>   
      <li>
        <input type="checkbox"  id="terms" >
        <label for="terms"> He constrastado la informacion, y toda la informacion es correcta</label>
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


  
$('#btnCrear').click(function(){
        if($('#nombreJuego').val() == ""){
            alert('Debes rellenar el nombre del juego');
        }else if($('#urlJuego').val() == ""){
            alert('Debes rellenar la imagen del juego');
        }else if($('#trailerJuego').val() == ""){
            alert('Debes rellenar el trailer del juego');
        }else if($('#descripcionJuego').val() == ""){
            alert('Debes rellenar la descripcion del juego');

        }else{
			$('#formularioJuego').submit();
		}
        });

</script>
<?php }else {

  header("Location: /homeAdmin");

}?>