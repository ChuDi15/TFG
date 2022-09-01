<?php 


foreach ($prueba as $item)
{   
    $id = $item->id;
    $nombre = $item->nombre;
    $descripcion = $item->descripcion;
    $imagen = $item->imagen;
    $trailer = $item->trailer;
}


//if //comprobamos si el usuario que tenemos guardado en la session de inicio de sesion, ya ha valorado en la tabla valorar+$id;
//si ha valorado, ponemos aqui un if que diga que ya ha valorado y si quiere borrar la valoracion, si no ha valorado
//dejamos lo de abajo ->

?>

<div class="container pagValorar pt-5">
    <div class="imagenTexto">
        <img src=<?php echo $imagen ?> class="img-fluid imagen" alt="">
        <p class="descripcionValorar">
        <?php echo $descripcion ?>
       
       
        </p>
    </div>
    <div class="ratio ratio-16x9">
    <iframe class="p-5 embed-responsive-item" width="1280" height="720" src=<?php echo $trailer ?> frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</div>

<div class="estrellas" id="estrellas">
    <p>Puntúa el juego!</p>

    <?php 

   

    if(isset($_SESSION['loggedIn'])){
        $user = $this->db->get_where('valorar'.$id, array('usuario' => $_SESSION['loggedIn']))->result();

        if(empty($user)){

        
    ?>

    <div class="star-wrapper">
        <a href="<?php echo base_url('valoracion?data=5&data2='.$id) ?>" value="1" class="fas fa-star s1"></a>
        <a href="<?php echo base_url('valoracion?data=4&data2='.$id) ?>" class="fas fa-star s2"></a>
        <a href="<?php echo base_url('valoracion?data=3&data2='.$id) ?>" class="fas fa-star s3"></a>
        <a href="<?php echo base_url('valoracion?data=2&data2='.$id) ?>" class="fas fa-star s4"></a>
        <a href="<?php echo base_url('valoracion?data=1&data2='.$id) ?>" class="fas fa-star s5"></a>
    </div>

    

    
    <?php 
        }else{
            echo "<h2 class='text-center text-white'> Ya has puntuado </h2>";
        }


        $this->db->select('valoracion');
        $this->db->from('valorar'.$id);
        $this->db->where('usuario',$_SESSION['loggedIn']);
        $opinion = $this->db->get();

            foreach ($opinion->result() as $row)
            {  
                $valoracion = $row->valoracion;
            }


         if(empty($valoracion)){
                                     
            if(empty($user)){
                echo "<h2 class='text-center text-white'> Debes votar para poder opinar </h2>";
            }else{
            echo "<div class='opinion'>

                    <button id='mostrarForm' onclick='showForm();' class='text-center m-5'>Opina haciendo clic aqui</button>
                    </div>
        
                    <div class='opinion'>
                    <form method='post' action='" .base_url('valoracion/guardarOpinion?data='.$id ) ."' id='formElement' style='display: none;'>
                    <textarea class='p-5' name='textAreaOpinion' placeholder='Escribe tu opinión aqui' cols='80' rows='10' minlength='10' maxlength='500' required></textarea>
                    <br/>
                    <button class='text-center' type='submit' value='' name='enviarOpinion'>Enviar</button>
                    </form>
                    </div>
                ";
            
            }
           

         }else{
            echo "<h2 class='text-center text-white'> Ya has opinado </h2>";
         }
    }else {
        echo "<h2 class='text-center text-white'>Debes loggearte para votar/opinar</h2>";
    }

    ?>

    <?php 

    echo "<h4 class='text-center text-white'>Opiniones de otros usuarios: </h4>";

        $this->db->select('*');
        $this->db->from('valorar'.$id);
        $this->db->order_by("valoracion", "RANDOM");
        $this->db->limit(5);
    


        $juego = $this->db->get();

        foreach ($juego->result() as $row)
        {  
            if(empty($row->valoracion)){

            }else{

            
            echo " 
                    <div class='container'>
                    <h4 class='text-info'> Usuario: ".$row->usuario."</h4>
                        <h5 class=' text-white'>".$row->valoracion."</h5>
                        <h5 class=' text-white'>  Puntuación: <i class='fa-solid fa-star-half-stroke'>".$row->puntuacion." </i></h5>
                    </div>
                ";
            
                }
            
        }

 ?>

</div>

<script type="text/javascript">
    function showForm() {
        document.getElementById('formElement').style.display = 'inline-block';
       
    }
</script>
