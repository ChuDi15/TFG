<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$this->load->library('session');
    }

	public function index()
	{
		if(isset($_SESSION['arrayJuegos'])){
			unset($_SESSION['arrayJuegos']);
		}
		
		if(isset($_POST['buscarJuegoHome'])){
			$this->modelo->cargarSesion($_POST['buscarJuegoHome']);
		}else{

		
		$this->modelo->cargarSesion();
		// llama al modelo "modelo" a la funcion pruebass 
		}
	
		if(isset($_SESSION['usuarioNoExiste'])){
			echo '<script language="javascript">alert("El usuario no existe");</script>';
			unset($_SESSION['usuarioNoExiste']);
			$this->modelo->view('login.php');
		}else if(isset($_SESSION['wrongPass'])){
			echo '<script language="javascript">alert("Contraseña erronea");</script>';
			unset($_SESSION['wrongPass']);
			$this->modelo->view('login.php');
		}else if(isset($_SESSION['usuarioExistente'])){
			echo '<script language="javascript">alert("El usuario ya existe");</script>';
			unset($_SESSION['usuarioExistente']);
			$this->modelo->view('login.php');
		}else if(isset($_SESSION['correoExiste'])){
			echo '<script language="javascript">alert("El correo ya existe");</script>';
			unset($_SESSION['correoExiste']);
			$this->modelo->view('login.php');
		}else{
			$this->modelo->view('home.php');
		}

		

		
	}
}
