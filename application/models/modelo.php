<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modelo extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //Carga Modelos
    }

    /*
    Función que carga la vistas
    @param String $view Vista que queremos cargar
    @param Array $data  Datos que queramos en la vista
     */

    public function cargarSesion($busqueda = null){

        if($busqueda==null){

        
        $this->db->select('*');
        $this->db->from('videojuegos');
        $this->db->order_by("id", "asc");

        $juego = $this->db->get();

       

   
		$puntos=0;
        $numeroValoraciones = $this->db->count_all_results('valorar1');

		$i=0;
        
        //guardamos los datos de la tabla juegos en una sesion, para mostrarlos en la pantalla inicio
		foreach ($juego->result() as $row)
		{
          
			$_SESSION['arrayJuegos']['id'][$i] = $row->id;
			$_SESSION['arrayJuegos']['nombre'][$i] = $row->nombre;
			$_SESSION['arrayJuegos']['created_at'][$i] = $row->created_at;
			$_SESSION['arrayJuegos']['updated_at'][$i] = $row->updated_at;
			$_SESSION['arrayJuegos']['descripcion'][$i] = $row->descripcion;
			$_SESSION['arrayJuegos']['imagen'][$i] = $row->imagen;

            $valoracionJuego = "valorar".$row->id;
            //cargamos la tabla puntuacion, del juego que queramos saber su puntuacion media
            $valoracion = $this->db->get($valoracionJuego);
            foreach ($valoracion->result() as $row2)
            {
                $puntos+=intval($row2->puntuacion);
            }


            $numeroValoraciones = $this->db->count_all_results($valoracionJuego);


           //calculamos la puntuacion media si es necesario
            if($numeroValoraciones!=0){
                $_SESSION['arrayJuegos']['valoracion'][$i] = $puntos/$numeroValoraciones;
            }else{
                $_SESSION['arrayJuegos']['valoracion'][$i] = $puntos;
            }

			$i++;
            $puntos=0;
		}
    }else{
        
        unset($_SESSION['arrayJuegos']);
        $this->db->select('*');
        $this->db->from('videojuegos');
        $this->db->like('nombre',$busqueda);
        $this->db->order_by("id", "ASC");
        $juego = $this->db->get();

       
        if($juego->num_rows()>0){
         
    
   
		$puntos=0;
        $numeroValoraciones = $this->db->count_all_results('valorar1');

		$i=0;
        
        //guardamos los datos de la tabla juegos en una sesion, para mostrarlos en la pantalla inicio
		foreach ($juego->result() as $row)
		{
          
			$_SESSION['arrayJuegos']['id'][$i] = $row->id;
			$_SESSION['arrayJuegos']['nombre'][$i] = $row->nombre;
			$_SESSION['arrayJuegos']['created_at'][$i] = $row->created_at;
			$_SESSION['arrayJuegos']['updated_at'][$i] = $row->updated_at;
			$_SESSION['arrayJuegos']['descripcion'][$i] = $row->descripcion;
			$_SESSION['arrayJuegos']['imagen'][$i] = $row->imagen;

            $valoracionJuego = "valorar".$row->id;
            //cargamos la tabla puntuacion, del juego que queramos saber su puntuacion media
            $valoracion = $this->db->get($valoracionJuego);
            foreach ($valoracion->result() as $row2)
            {
                $puntos+=intval($row2->puntuacion);
            }


            $numeroValoraciones = $this->db->count_all_results($valoracionJuego);


           //calculamos la puntuacion media si es necesario
            if($numeroValoraciones!=0){
                $_SESSION['arrayJuegos']['valoracion'][$i] = $puntos/$numeroValoraciones;
            }else{
                $_SESSION['arrayJuegos']['valoracion'][$i] = $puntos;
            }

			$i++;
            $puntos=0;
            }
        }else{
            $this->db->select('*');
        $this->db->from('videojuegos');
        $this->db->order_by("id", "asc");

        $juego = $this->db->get();

       

   
		$puntos=0;
        $numeroValoraciones = $this->db->count_all_results('valorar1');

		$i=0;
        
        //guardamos los datos de la tabla juegos en una sesion, para mostrarlos en la pantalla inicio
		foreach ($juego->result() as $row)
		{

            $_SESSION['noExiste']="";
			$_SESSION['arrayJuegos']['id'][$i] = $row->id;
			$_SESSION['arrayJuegos']['nombre'][$i] = $row->nombre;
			$_SESSION['arrayJuegos']['created_at'][$i] = $row->created_at;
			$_SESSION['arrayJuegos']['updated_at'][$i] = $row->updated_at;
			$_SESSION['arrayJuegos']['descripcion'][$i] = $row->descripcion;
			$_SESSION['arrayJuegos']['imagen'][$i] = $row->imagen;

            $valoracionJuego = "valorar".$row->id;
            //cargamos la tabla puntuacion, del juego que queramos saber su puntuacion media
            $valoracion = $this->db->get($valoracionJuego);
            foreach ($valoracion->result() as $row2)
            {
                $puntos+=intval($row2->puntuacion);
            }


            $numeroValoraciones = $this->db->count_all_results($valoracionJuego);


           //calculamos la puntuacion media si es necesario
            if($numeroValoraciones!=0){
                $_SESSION['arrayJuegos']['valoracion'][$i] = $puntos/$numeroValoraciones;
            }else{
                $_SESSION['arrayJuegos']['valoracion'][$i] = $puntos;
            }

			$i++;
            $puntos=0;
		}
        }
    }
    }

    public function view($view = 'home_view', $data = null)
    {
        //Data
        $this->load->view('header');
        $this->load->view($view, $data);
        $this->load->view('footer');
    }

    public function valoracion($puntuacion, $data = null)
    {
        $this->load->view('header');
        $this->load->view($view, $data);
        $this->load->view('footer');
    }
}

/*


    public function cargarSesion(){
        $juego = $this->db->get('videojuegos');

        $puntos=0;
		
		$i=0;
    
		foreach ($juego->result() as $row)
		{
          
			$_SESSION['arrayJuegos']['id'][$i] = $row->id;
			$_SESSION['arrayJuegos']['nombre'][$i] = $row->nombre;
			$_SESSION['arrayJuegos']['created_at'][$i] = $row->created_at;
			$_SESSION['arrayJuegos']['updated_at'][$i] = $row->updated_at;
			$_SESSION['arrayJuegos']['descripcion'][$i] = $row->descripcion;
			$_SESSION['arrayJuegos']['imagen'][$i] = $row->imagen;
           

			$i++;

            $valoracionJuego = "valorar".$row->id;

            $valoracion = $this->db->get($valoracionJuego);
            foreach ($valoracion->result() as $row)
		    {
                $puntos+=$row->puntuacion;
            }

            $numeroValoraciones = $this->db->count_all_results($valoracionJuego);

            

            $_SESSION['arrayJuegos']['valoracion'][$i] = $puntos/$numeroValoraciones;
            exit;
		}
    }

    public function view($view = 'home_view', $data = null)
    {
        //Data
        $this->load->view('header');
        $this->load->view($view, $data);
        $this->load->view('footer');
    }
}
*/