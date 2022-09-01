<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Valoracion extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function __construct()
    {
        parent::__construct();
		$this->db = $this->load->database("default", true);
		$this->load->model('modelo');

    }

	public function index()
	{
		// llama al modelo "modelo" a la funcion pruebass 
       

        //recibir parametro "juego" y llamar a una vista juegos con el parametro del juego
		

        if(isset($_GET["data"]))
        {
            $puntuacion = $_GET["data"];
            $id = $_GET["data2"];

        

            $data = array(
                'usuario' => $_SESSION['loggedIn'],
                'puntuacion' => $puntuacion
            );

            $this->db->insert('valorar'.$id, $data);
            header("Location: /home");
        }
        
    

	}


	
	public function guardarOpinion()
	{
		// llama al modelo "modelo" a la funcion pruebass 


        //recibir parametro "juego" y llamar a una vista juegos con el parametro del juego
		if(isset($_GET["data"]))
        {
            $id = $_GET["data"];

			
            $usuario = $_SESSION['loggedIn'];
            $valoracion = $_POST['textAreaOpinion'];




			$this->db->set('valoracion', $valoracion);
			$this->db->where('usuario', $usuario);
			$this->db->update('valorar'.$id); // gives UPDATE mytable SET field = field+1 WHERE id = 2

			header("Location: /home");
        }
        


	}
}
