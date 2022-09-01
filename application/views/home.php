<section class="galeria" id="galeria">


<?php 
    if(isset($_SESSION['noExiste'])){
        echo '<h2 class="text-center text-white p-2"> El juego que has intentado buscar no existe </h2>';
    }
?>

<div class="container">

<form method="post" class="p-5" action="<?php echo base_url('/home') ?>">
    <div class="row height d-flex justify-content-center align-items-center">

            <div class="col-md-8">

                <div class="search">
                    <i class="fa fa-search"></i>
                    <input type="text" class="form-control" name="buscarJuegoHome" placeholder="¿Quieres buscar un juego?">
                <button class="btn btn-primary">Buscar</button>
            </div>
                        
        </div>
                      
    </div>
</div>
</form>

<div class="box-container">


    
<?php 

$tamaño = count($_SESSION['arrayJuegos']['nombre']);

for($i=0; $i<$tamaño; $i++){

    echo '
    <div class="box">
        <img src="'.$_SESSION['arrayJuegos']['imagen'][$i].'" alt="">
        <div class="contenido">
            <h3> '.$_SESSION['arrayJuegos']['nombre'][$i].' </h3>
            <p class="descripcion">'.$_SESSION['arrayJuegos']['descripcion'][$i].'</p>
           
            <p class="valoracion"> <i class="fa-solid fa-star-half-stroke"></i> '.round($_SESSION['arrayJuegos']['valoracion'][$i],1).' </p>
            <form class="valorar" method="post" action="'.base_url("valorar").'">
                <button class="p-1" type="submit" value="'.$_SESSION['arrayJuegos']['nombre'][$i].'" name="juego">Valorar</button>
            </form>
        </div>
    </div>';
    
}
unset($_SESSION['noExiste']);
?>


</div>

</section>