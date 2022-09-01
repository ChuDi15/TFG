<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeAdmin extends CI_Controller {

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
		$this->load->model('modeloAdmin');

        $this->load->dbforge();
    }   

	public function index()
	{

        if(isset($_SESSION['busquedaJuegosModif'])){
            unset($_SESSION['busquedaJuegosModif']);
        }
        if(isset($_SESSION['busquedaAdminModif'])){
            unset($_SESSION['busquedaAdminModif']);
        }
        if(isset($_SESSION['busquedaUsuarioModif'])){
            unset($_SESSION['busquedaUsuarioModif']);
        }


        $this->modeloAdmin->view('admin/homeAdmin.php');

		
	}

    public function crearJuego()
	{
		
	    $this->modeloAdmin->view('admin/crearJuego.php');
		

		
	}

    public function crearJuegoBBDD()
	{
		
            
            $data = array(
                'nombre' => $_POST['nombreJuego'],
                'descripcion' =>  $_POST['descripcionJuego'],
                'imagen' => $_POST['urlJuego'],
                'trailer' => $_POST['trailerJuego']
        );
        

        $this->db->insert('videojuegos', $data);

        
        $this->db->select('id');
        $this->db->from('videojuegos');
        $this->db->order_by("id", "DESC");
        $this->db->limit(1);

        
        $juego = $this->db->get();

        foreach ($juego->result() as $row)
        {  

            $id = $row->id;
        }

        $this->db->query('use tfgbbdd');



        // define table fields
        $fields = array(
        'usuario' => array(
            'type' => 'VARCHAR',
            'constraint' => 30
        ),
        'puntuacion' => array(
            'type' => 'VARCHAR',
            'constraint' => 2
        ),
        'valoracion' => array(
            'type' => 'VARCHAR',
            'constraint' => 500
        )
        );

        $this->dbforge->add_field($fields);

        // define primary key
        $this->dbforge->add_key('usuario', TRUE);

        // create table

        intval($id+1);
        if( $this->dbforge->create_table('valorar'.intval($id), TRUE)){
            $_SESSION['juegoCreado']="";
            header("Location: /homeAdmin");

        }else{
            echo "error creando la base de datos";
        }
    


            
    }

    
    
    public function crearUsuarioAdmin()
	{
        

        if(isset($_POST['crearUsuarioAdmin'])){
            $user = $this->db->get_where('usuariosadmin', array('usuario' => $_POST['crearUsuarioAdmin']))->result();
            if(empty($user)){

           
                $cifrado = password_hash($_POST['crearContraseñaAdmin'], PASSWORD_BCRYPT);
                
                $data = array(
                    'usuario' => $_POST['crearUsuarioAdmin'],
                    'contraseña' =>  $cifrado
                );
                


                $this->db->insert('usuariosadmin', $data);
                $_SESSION['usuarioAdminCreado']="";
                header("Location: /homeAdmin");

            }else{
                    $_SESSION['usuarioAdminExistente']="";
            
              
                }
        }

        $this->modeloAdmin->view('admin/crearAdministrador.php');

       

	}

     
    public function crearUsuario()
	{
        

        if(isset($_POST['crearUsuario'])){
            $user = $this->db->get_where('usuarios', array('usuario' => $_POST['crearUsuario']))->result();
            $email = $this->db->get_where('usuarios', array('email' => $_POST['crearEmail']))->result();
            if((empty($user))&&(empty($email))  ){

                
                $cifrado = password_hash($_POST['crearContraseña'], PASSWORD_BCRYPT);
                
                $data = array(
                    'usuario' => $_POST['crearUsuario'],
                    'contraseña' =>  $cifrado,
                    'email' =>  $_POST['crearEmail']
                );
                


                $this->db->insert('usuarios', $data);
                $_SESSION['usuarioCreado']="";
                header("Location: /homeAdmin");

            }else{
                    $_SESSION['usuarioEmailExistente']="";
            
              
                }
        }

        $this->modeloAdmin->view('admin/crearUsuario.php');

       

	}






    public function borrarJuego()
	{
		
	   
		if(isset($_POST['juegoBorrar'])){
            
            $this->db->select('*');
            $this->db->from('videojuegos');
            $this->db->like('nombre',$_POST['juegoBorrar']);
            $this->db->order_by("id", "ASC");
            $query = $this->db->get();
            $i=0;
            foreach ($query->result() as $row)
            {
                  
            $_SESSION['busquedaJuegos']['id'][$i]=$row->id;
            $_SESSION['busquedaJuegos']['nombre'][$i]=$row->nombre;
               
                
                $i++;
            }
        
        }else if(isset($_POST['busquedaJuegoFinal'])){
            $this->db->delete('videojuegos', array('id' => $_POST['busquedaJuegoFinal'])); 
                if ($this->dbforge->drop_table('valorar'.intval($_POST['busquedaJuegoFinal']))) {
                    $_SESSION['juegoBorrado']="";
                }
                header("Location: /homeAdmin");
        }
            
        $this->modeloAdmin->view('admin/borrarJuego');
        
	}

    

    public function borrarAdministrador()
	{
		
	   
		if(isset($_POST['administradorBorrar'])){
            
            $this->db->select('*');
            $this->db->from('usuariosadmin');
            $this->db->like('usuario',$_POST['administradorBorrar']);
            $query = $this->db->get();
            $i=0;
            foreach ($query->result() as $row)
            {
                  
            $_SESSION['busquedaAdministrador']['usuario'][$i]=$row->usuario;
               
                
                $i++;
            }
        
        }else if(isset($_POST['busquedaAdministradorFinal'])){
            if($this->db->delete('usuariosadmin', array('usuario' => $_POST['busquedaAdministradorFinal']))){
                $_SESSION['administradorBorrado']="";
            } 
                   
                header("Location: /homeAdmin");
        }
            
        $this->modeloAdmin->view('admin/borrarAdministrador');
        
	}

    

    public function borrarUsuario()
	{
		
	   
		if(isset($_POST['usuarioBorrar'])){
            
            $this->db->select('*');
            $this->db->from('usuarios');
            $this->db->like('usuario',$_POST['usuarioBorrar']);
            $query = $this->db->get();
            $i=0;
            foreach ($query->result() as $row)
            {
                  
            $_SESSION['busquedaUsuario']['usuario'][$i]=$row->usuario;
               
                
                $i++;
            }
        
        }else if(isset($_POST['busquedaUsuarioFinal'])){
            if($this->db->delete('usuarios', array('usuario' => $_POST['busquedaUsuarioFinal']))){
                $_SESSION['usuarioBorrado']="";
            } 
                   
                header("Location: /homeAdmin");
        }
            
        $this->modeloAdmin->view('admin/borrarUsuario');
        
	}


    
    public function modificarJuego()
	{
		
	   
		if(isset($_POST['juegoModificar'])){
            
            $this->db->select('*');
            $this->db->from('videojuegos');
            $this->db->like('nombre',$_POST['juegoModificar']);
            $this->db->order_by("id", "ASC");
            $query = $this->db->get();
            $i=0;
            foreach ($query->result() as $row)
            {
                  
            $_SESSION['busquedaJuegosModif']['id'][$i]=$row->id;
            $_SESSION['busquedaJuegosModif']['nombre'][$i]=$row->nombre;
               
                
                $i++;
            }
        
        }else if(isset($_POST['busquedaJuegoFinalModif'])){
            $_SESSION['modificarJuegoSession']=$_POST['busquedaJuegoFinalModif'];
          
                    
            
        }else if(isset($_POST['nombre'])){
            $data = array(
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'imagen' => $_POST['imagen'],
                'trailer' => $$_POST['trailer']
            );

            $this->db->set('nombre', $_POST['nombre']);
            $this->db->set('descripcion', $_POST['descripcion']);
            $this->db->set('imagen', $_POST['imagen']);
            $this->db->set('trailer', $_POST['trailer']);
			$this->db->where('id', $_POST['id']);
			$this->db->update('videojuegos'); // gives UPDATE mytable SET field = field+1 WHERE id = 2
            $_SESSION['juegoModificado']="";
            header("Location: /homeAdmin");
        }
        
        $this->modeloAdmin->view('admin/modificarJuego');
        
	}

    

    
    public function modificarAdmin()
	{
		
	   
		if(isset($_POST['adminModificar'])){
            
            $this->db->select('*');
            $this->db->from('usuariosadmin');
            $this->db->like('usuario',$_POST['adminModificar']);
            $query = $this->db->get();
            $i=0;
            foreach ($query->result() as $row)
            {
                  
            $_SESSION['busquedaAdminModif']['usuario'][$i]=$row->usuario;
               
                
                $i++;
            }
        
        }else if(isset($_POST['busquedaAdminFinalModif'])){
            $_SESSION['modificarAdminSession']=$_POST['busquedaAdminFinalModif'];
          
                    
            
        }else if(isset($_POST['usuario'])){
            $cifrado = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $data = array(
                'usuario' => $_POST['usuario'],
                'contraseña' => $cifrado
            );

            $this->db->set('usuario', $_POST['usuario']);
            $this->db->set('contraseña', $cifrado);
			$this->db->where('usuario', $_POST['usuario']);
			$this->db->update('usuariosadmin'); // gives UPDATE mytable SET field = field+1 WHERE id = 2
            $_SESSION['administradorModificado']="";
            header("Location: /homeAdmin");
        }
        
        $this->modeloAdmin->view('admin/modificarAdmin');
        
	}

    
    public function modificarUsuario()
	{
		
	   
		if(isset($_POST['usuarioModificar'])){
            
            $this->db->select('*');
            $this->db->from('usuarios');
            $this->db->like('usuario',$_POST['usuarioModificar']);
            $query = $this->db->get();
            $i=0;
            foreach ($query->result() as $row)
            {
                  
            $_SESSION['busquedaUsuarioModif']['usuario'][$i]=$row->usuario;
               
                
                $i++;
            }
        
        }else if(isset($_POST['busquedaUsuarioFinalModif'])){
            $_SESSION['modificarUsuarioSession']=$_POST['busquedaUsuarioFinalModif'];
          
                    
            
        }else if(isset($_POST['usuario'])){
            $cifrado = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);
            $data = array(
                'usuario' => $_POST['usuario'],
                'contraseña' => $cifrado,
                'email' => $_POST['email'],
            );

            $this->db->set('usuario', $_POST['usuario']);
            $this->db->set('contraseña', $cifrado);
            $this->db->set('email', $_POST['email']);
			$this->db->where('usuario', $_POST['usuario']);
			$this->db->update('usuarios'); // gives UPDATE mytable SET field = field+1 WHERE id = 2
            $_SESSION['usuarioModificado']="";
            header("Location: /homeAdmin");
        }
        
        $this->modeloAdmin->view('admin/modificarUsuario');
        
	}


   
}
