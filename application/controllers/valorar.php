<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Valorar extends CI_Controller {

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
		$this->load->dbforge();
    }

	public function index()
	{
		// llama al modelo "modelo" a la funcion pruebass 


        //recibir parametro "juego" y llamar a una vista juegos con el parametro del juego
		$query['prueba'] = $this->db->get_where('videojuegos', array('nombre' => $_POST['juego']))->result();
	
		
		$this->modelo->view('valorar.php', $query);


	}

}
