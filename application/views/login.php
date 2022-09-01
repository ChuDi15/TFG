<section class="galeria" id="galeria">


<div class="box-container">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>

<div class="box-container">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>

        <div class="container form">
            <div class="frame">
                <div class="nav">
                    <ul class="links">
                        <li class="signin-active"><a class="btn">Iniciar sesion</a></li>
                        <li class="signup-inactive"><a class="btn">Registrarse </a></li>
                    </ul>
                </div>
                <div ng-app ng-init="checked = false">
                    <form class="form-signin" id="formLog" action="<?php echo base_url('login/logearse') ?>"
                        method="post" name="form">
                        <label for="username">Usuario</label>
                        <input class="form-styling" id="username" type="text" name="username" placeholder="" />
                        <label for="password">Contraseña</label>
                        <input class="form-styling" type="password" id="pass" name="password" placeholder="" />
                        <div class="btn-animate">
                            <button type="button" id="btn-signin" class="btn-signin p-0">Iniciar sesion</button>
                        </div>
                    </form>

                    <form class="form-signup" action="<?php echo base_url('login/registrarse') ?>" method="post"
                        id="formReg" name="formReg">
                        <label for="fullname">Usuario</label>
                        <input class="form-styling" type="text" name="usernameReg" id="usernameReg" />
                        <label for="email">Email</label>
                        <input class="form-styling" type="email" required
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" id="email" />
                        <label for="password">Contraseña</label>
                        <input class="form-styling" type="password" name="passwordReg" id="passwordReg" />
                        <label for="confirmpassword">Confirmar contraseña</label>
                        <input class="form-styling" type="password" name="confirmpassword" id="passwordRegconf" />
                        <button type="button" id="btn-signup" class="btn-signup">Registrarse</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</section>
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
            alert('email no valido');
        }else{
			$('#formReg').submit();
		}
        });

    </script>