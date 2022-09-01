<?php 

if(isset($_SESSION['juegoCreado'])){
    echo '<script language="javascript">alert("El juego ha sido creado");</script>';
    unset($_SESSION['juegoCreado']);
  
}else if(isset($_SESSION['usuarioNoExisteAdmin'])){
    echo '<script language="javascript">alert("El usuario no existe");</script>';
    unset($_SESSION['usuarioNoExisteAdmin']);
   
}else if(isset($_SESSION['wrongPassAdmin'])){
    echo '<script language="javascript">alert("Contraseña erronea");</script>';
    unset($_SESSION['wrongPassAdmin']);
  
}else if(isset($_SESSION['juegoBorrado'])){
    echo '<script language="javascript">alert("Juego borrado correctamente");</script>';
    unset($_SESSION['juegoBorrado']);
 
}else if(isset($_SESSION['juegoModificado'])){
    echo '<script language="javascript">alert("Juego modificado correctamente");</script>';
    unset($_SESSION['juegoModificado']);
  
}else if(isset($_SESSION['usuarioAdminCreado'])){
            
    echo '<script language="javascript">alert("Has creado un nuevo usuario administrador");</script>';
    unset($_SESSION['usuarioAdminCreado']);
    
}else if(isset($_SESSION['administradorBorrado'])){
    
    echo '<script language="javascript">alert("El administrador se ha borrado correctamente");</script>';
    unset($_SESSION['administradorBorrado']);
    
}else if(isset($_SESSION['usuarioBorrado'])){
    
    echo '<script language="javascript">alert("El usuario se ha borrado correctamente");</script>';
    unset($_SESSION['usuarioBorrado']);
    
}else if(isset($_SESSION['usuarioCreado'])){
    
    echo '<script language="javascript">alert("El usuario se ha creado correctamente");</script>';
    unset($_SESSION['usuarioCreado']);
    
}else if(isset($_SESSION['administradorModificado'])){
    
    echo '<script language="javascript">alert("El administrador se ha modificado correctamente");</script>';
    unset($_SESSION['administradorModificado']);
    
}else if(isset($_SESSION['usuarioModificado'])){
    
    echo '<script language="javascript">alert("El usuario se ha modificado correctamente");</script>';
    unset($_SESSION['usuarioModificado']);
    
}





if(isset($_SESSION['loggedInAdmin'])){

?>

<h2 class='text-center text-white mt-5'> Bienvenido <?php echo $_SESSION['loggedInAdmin'] ?> a la pagina de administración, ¿que desea hacer? </h2>


    <div class="container-fluid botonesAdmin botonesAdminDiv">
        <div class="botonesAdmin">
        <h2 class='text-center text-white'> Modificar Juegos </h2>
        <a href="<?php echo base_url('homeAdmin/crearJuego') ?>" class="myButton">Crear nuevo juego</a>
        <a href="<?php echo base_url('homeAdmin/borrarJuego') ?>" class="myButton">Borrar juego</a>
        <a href="<?php echo base_url('homeAdmin/modificarJuego') ?>" class="myButton">Modificar Juego</a>
        </div>
        <div class="botonesAdmin">
        <h2 class='text-center text-white'> Modificar Usuarios Administradores</h2>
        <a href="<?php echo base_url('homeAdmin/crearUsuarioAdmin') ?>" class="myButton">Crear usuario Admin</a>
        <a href="<?php echo base_url('homeAdmin/borrarAdministrador') ?>" class="myButton">Borrar usuario Admin</a>
        <a href="<?php echo base_url('homeAdmin/modificarAdmin') ?>" class="myButton">Modificar usuario Admin</a>
        </div>
        <div class="botonesAdmin">
        <h2 class='text-center text-white'> Modificar Usuarios </h2>
        <a href="<?php echo base_url('homeAdmin/crearUsuario') ?>" class="myButton">Crear usuario </a>
        <a href="<?php echo base_url('homeAdmin/borrarUsuario') ?>" class="myButton">Borrar usuario </a>
        <a href="<?php echo base_url('homeAdmin/modificarUsuario') ?>" class="myButton">Modificar usuario </a>
        </div>
    </div>



<?php 
    
}else{


?>
<h2 class='text-center text-white mt-5'> Bienvenido, logeate para poder realizar actividades de administrador </h2>

<div class="box-container">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>

        <div class="container form">
            <div class="frame">
                <div class="nav">
                    <ul class="links">
                    <li class="signin-active"><a class="btn">Iniciar Sesion</a></li>
                 
                    </ul>
                </div>
                <div ng-app ng-init="checked = false">
                    <form class="form-signin" id="formLog" action="<?php echo base_url('loginAdmin/logearse') ?>"
                        method="post" name="form">
                        <label for="username">Usuario</label>
                        <input class="form-styling" id="username" type="text" name="username" placeholder="" />
                        <label for="password">Password</label>
                        <input class="form-styling" type="password" id="pass" name="password" placeholder="" />
                        <div class="btn-animate">
                            <button type="button" id="btn-signin" class="btn-signin p-0">Iniciar sesion</button>
                        </div>
                    </form>
                    

                </div>
                
            </div>
        </div>
    </div>


    <?php 
        }
    ?>

    <script>
	
	var regex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;

       $(function() {
	$(".btn").click(function() {
		$(".form-signin").toggleClass("form-signin-left");
    $(".form-signup").toggleClass("form-signup-left");
    $(".frame").toggleClass("frame-long");
    $(".signup-inactive").toggleClass("signup-active");
    $(".signin-active").toggleClass("signin-inactive");
    $(".forgot").toggleClass("forgot-left");   
    $(this).removeClass("idle").addClass("active");
	});
});

        $('#btn-signin').click(function(){
        if($('#username').val() == ""){
            alert('Debes rellenar el usuario');
        }else if($('#pass').val() == ""){
            alert('Debes rellenar la contraseña');
        }else{
            $('#formLog').submit();
        }
        });

        
        $('#btn-signup').click(function(){
        if($('#usernameReg').val() == ""){
            alert('Debes rellenar el usuario');
        }else if($('#email').val() == ""){
            alert('Debes rellenar el correo');
        }else if($('#passwordReg').val() == ""){
            alert('Debes rellenar la contraseña');
        }else if($('#passwordRegconf').val() == ""){
            alert('Debes rellenar la confirmacion de contraseña');
        }else if($('#passwordRegconf').val() != ($("#passwordReg").val())){
            alert('Las contraseñas no coinciden');
        }else if(!regex.test($("#email").val())){
            alert('email erroneo');
        }else{
			$('#formReg').submit();
		}
        });



    </script>