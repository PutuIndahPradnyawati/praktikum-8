<?php 

	class Login extends CI_Controller{
		function __construct(){
			parent:: __construct();
			$this->load->model('m_login');
		}
		function index(){
			$this->load->view('admin/dashboard/petugas/login');
		}
		function aksi_login(){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$where = array(
					'username' => $username,
					'password' => $password
				);
			$cek = $this->m_login->cek_login("petugas",$where);
			if($cek >0)
			{
				$data_session = array(
								'nama' => $username,
								'id' => $session->Kd_Petugas,
								'status' => "login"
							);
				$this->session->set_userdata($data_session);
				$this->m_login->last_login();
				redirect(base_url("Perpustakaan/petugas"));
			}
			else{
				echo("Username dan password salah!");
			}
			$this->load->view('admin/dashboard/petugas/login');
		}
	}
 ?>