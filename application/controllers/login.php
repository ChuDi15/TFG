<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller {

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
		

		$this->modelo->view('login.php');
	}

    public function logearse()
	{
        // llama al modelo "modelo" a la funcion pruebass 
        $user = $this->db->get_where('usuarios', array('usuario' => $_POST['username']))->result();
       
        $this->db->select('contraseña');
        $this->db->from('usuarios');
        $this->db->where('usuario',$_POST['username']);
        $query = $this->db->get();

        foreach ($query->result() as $row)
        {
            $pass = $row->contraseña;
            
        }

        if(empty($user)){
            echo "usuario no existe";
            $_SESSION['usuarioNoExiste']="";
        }else if(empty($pass)){
            echo"contraseña erronea";
            $_SESSION['wrongPass']="";
        }else if(password_verify($_POST['password'], $pass))
        {
            echo "usuario existe";
            $_SESSION['loggedIn'] = $_POST['username'];

        }else{
            echo"contraseña erronea";
            $_SESSION['wrongPass']="";
        }

       echo  $_SESSION['loggedIn'];
       header("Location: /home");
        
    }

    public function registrarse()
	{
        // llama al modelo "modelo" a la funcion pruebass 


        $user = $this->db->get_where('usuarios', array('usuario' => $_POST['usernameReg']))->result();
        $email = $this->db->get_where('usuarios', array('email' => $_POST['email']))->result();
        
  

        if(empty($user)&&empty($email)){
            $cifrado = password_hash($_POST['passwordReg'], PASSWORD_BCRYPT);

            $data = array(
                'usuario' => $_POST['usernameReg'],
                'contraseña' =>  $cifrado,
                'email' => $_POST['email']
        );
        
        $this->db->insert('usuarios', $data);

        $_SESSION['loggedIn']= $_POST['usernameReg'];
        
        }else if(!empty($user)){
           
            $_SESSION['usuarioExistente']="";
        

        }else{
            $_SESSION['correoExiste']="";
        }

      
       header("Location: /home");
        
    }
}