<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function index()
	{
		$this->loadViews("home");
	}

	public function login()
	{
		if ($_POST["username"] && $_POST["password"]) {
			$login = $this->Site_model->loginUser($_POST);

			if ($login) {
				$array = array(
					"id" => $login[0]->id,
					"nombre" => $login[0]->nombre,
					"apellidos" => $login[0]->apellidos,
					"username" => $login[0]->username,
					"curso" => $login[0]->curso
				);

				//Guardar tipo de usuario (profesor/alumno)
				$array['tipo'] = isset($login[0]->is_profesor) ? "profesor" : "alumno";
				$this->session->set_userdata($array);
			}
		}
		$this->loadViews("login");
	}

	public function misTareas()
	{

		if ($_SESSION["id"]) {
			$data['tareas'] = $this->Site_model->getTareas($_SESSION['curso']);
			$this->loadViews("misTareas", $data);
		} else {
			redirect(base_url() . "DashBoard", "location");
		}

	}

	public function mensajes()
	{
		if ($_SESSION["id"]) {
			$token = $this->Site_model->getToken($_SESSION['id'], $_SESSION['tipo']);
			//INSERTAR MENSAJE
			if ($_POST) {
				$this->Site_model->insertMensaje($_POST, $token);
			}

			//OBTENER TODOS LOS USUARIOS
			$data['usuarios'] = $this->Site_model->getUsuarios($_SESSION['tipo'], $_SESSION['curso']);
			$data['mensajes'] = $this->Site_model->getMensajes($token);
			$this->loadViews("mensajes", $data);
		} else {
			redirect(base_url() . "DashBoard", "location");
		}
	}

	public function getMensaje() {
		$texto = $this->Site_model->getTextMensaje($_POST["idmensaje"]);
		echo $texto[0]->texto;
	}

	public function crearTareas()
	{

		if (!empty($_FILES["archivo"]["name"])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			//$config['max_size'] = 100;
			//$config['max_width'] = 1024;
			//$config['max_height'] = 768;
			$config['file_name'] = uniqid() . $_FILES['archivo']['name'];

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('archivo')) {
				echo "error";
			} else {
				$this->Site_model->uploadTarea($_POST, $config['file_name']);
			}
		} else {
			$this->Site_model->uploadTarea($_POST);
		}

		$this->loadViews("crearTareas");
	}

	public function gestionAlumnos()
	{
		if ($_SESSION['tipo'] == "profesor") {
			$data['alumnos'] = $this->Site_model->getAlumnos($_SESSION['curso']);
			$this->loadViews("gestionAlumnos", $data);
		} else {
			redirect(base_url() . "DashBoard", "location");
		}

	}

	public function eliminarAlumno()
	{
		if ($_POST['idalumno']) {
			$this->Site_model->deleteAlumno($_POST['idalumno']);
		}
	}

	//A partir de ahora llamaremos a loadViews en todas las funciones
	public function loadViews($view, $data = null)
	{
		//Si tenemos sessión creada
		if ($_SESSION['username']) {
			//si la vista es login se redirige a la home
			if ($view == "login") {
				redirect(base_url() . "DashBoard", "location");
			}
			//si es una vista cualquiera se carga
			$this->load->view('includes/header');
			$this->load->view('includes/sidebar');
			$this->load->view($view, $data);
			$this->load->view('includes/footer');
			//si no tenemos iniciada sessión
		} else {
			//si la vista es login se carga
			if ($view == "login") {
				$this->load->view($view);
				//si la vista es otra cualquiera se redirige a login
			} else {
				redirect(base_url() . "DashBoard/login", "location");
			}
		}
	}
}
