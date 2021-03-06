<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perpustakaan extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');

		$this->load->model('DataMaster_Buku');
		$this->load->model('DataMaster_Anggota');
		$this->load->model('DataMaster_Petugas');
		$this->load->model('DataMaster_Peminjaman');

		$this->md_buku = $this->DataMaster_Buku;
		$this->md_ang = $this->DataMaster_Anggota;
		$this->md_pet = $this->DataMaster_Petugas;
		$this->md_pem = $this->DataMaster_Peminjaman;
	}
	public function petugas()
	{
	 	$this->load->view('admin/index');
	}
	// public function anggota()
	// {
	// 	$this->load->view('admin/dashboard/anggota/index');
	// }
	public function index()
	{
		redirect( base_url() );
	}
	public function listPeminjaman()
	{
		$data['peminjam'] = $this->md_pem->list_all();
		$data['petugas'] = $this->md_pem->petugas();
		//var_dump($data);
		$this->load->view('admin/dashboard/petugas/master_peminjam',$data);
	}
	public function listBuku()
	{
		$this->load->database();
		 $jumlah_data = $this->md_buku->jumlah_data();
		 $this->load->library('pagination');
		 //tampilan
		 $config['first_link']       = 'First';
		   $config['last_link']        = 'Last';
		   $config['next_link']        = 'Next';
		   $config['prev_link']        = 'Prev';
		   $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		   $config['full_tag_close']   = '</ul></nav></div>';
		   $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		   $config['num_tag_close']    = '</span></li>';
		   $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		   $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		   $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		   $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		   $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		   $config['prev_tagl_close']  = '</span>Next</li>';
		   $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		   $config['first_tagl_close'] = '</span></li>';
		   $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		   $config['last_tagl_close']  = '</span></li>';
		 $config['base_url'] = base_url().'index.php/Perpustakaan/listBuku/';
		 $config['total_rows'] = $jumlah_data;
		 $config['per_page'] = 2;
		 $from = $this->uri->segment(3);
		 $this->pagination->initialize($config);
		 //var_dump($config);
		 $data['buku'] = $this->md_buku->list_all($config['per_page'],$from);
		 $this->load->view('admin/dashboard/petugas/master_buku',$data);
		// $data['buku'] = $this->md_buku->list_all();
		// //var_dump($data);
		// $this->load->view('admin/dashboard/petugas/master_buku',$data);
	}
	public function listAnggota()
	{
		$data['anggota'] = $this->md_ang->list_all();
		//var_dump($data);
		$this->load->view('admin/dashboard/petugas/master_anggota',$data);
	}

	//untuk petugas
	public function listPetugas()
	{
		$data['petugas'] = $this->md_pet->list_all();
		$this->load->view('admin/dashboard/petugas/master_petugas', $data);
	}

	public function addNew()
	{
		if( empty($this->uri->segment('3'))) {
			redirect( base_url() );
		}

		$cek=$this->uri->segment('3');
		//var_dump($cek);

		switch ($cek) {
			case 'buku':
				if( $_SERVER['REQUEST_METHOD'] == 'POST') {
					$judul= $this->security->xss_clean( $this->input->post('judul'));
					$penerbit= $this->security->xss_clean( $this->input->post('penerbit'));
					$pengarang= $this->security->xss_clean( $this->input->post('pengarang'));
					$tahun= $this->security->xss_clean( $this->input->post('tahun'));

					// validasi
					$this->form_validation->set_rules('judul', 'Judul Buku', 'required');
					if(!$this->form_validation->run()) {
						$this->session->set_flashdata('msg_alert_error', 'Gagal Menambah data Buku');
						redirect( base_url('Perpustakaan/listBuku') );
					}

		            $data['JudulBuku'] = $judul;
					$data['Pengarang'] = $pengarang;
					$data['Penerbit'] = $penerbit;
					$data['TahunTerbit'] = $tahun;
					$this->md_buku->tambahBuku($data);

					redirect(base_url('Perpustakaan/listBuku'));
				}
				break;
				case 'anggota':
				if( $_SERVER['REQUEST_METHOD'] == 'POST') {
					$nama= $this->security->xss_clean( $this->input->post('nama'));
					$jenjang= $this->security->xss_clean( $this->input->post('jenjang'));
					$prodi= $this->security->xss_clean( $this->input->post('prodi'));
					$alamat= $this->security->xss_clean( $this->input->post('alamat'));

					// validasi
					$this->form_validation->set_rules('nama', 'Nama Anggot', 'required');
					if(!$this->form_validation->run()) {
						$this->session->set_flashdata('msg_alert_error', 'Gagal Menambah data Anggot');
						redirect( base_url('Perpustakaan/listAnggota') );
					}

		            $data['Nama'] = $nama;
					$data['Jenjang'] = $jenjang;
					$data['Prodi'] = $prodi;
					$data['Alamat'] = $alamat;
					$this->md_ang->tambahAnggota($data);

					redirect(base_url('Perpustakaan/listAnggota'));
				}
				break;
				case 'petugas':
					if( $_SERVER['REQUEST_METHOD'] == 'POST') {
					$nama= $this->security->xss_clean( $this->input->post('nama'));
					$username= $this->security->xss_clean( $this->input->post('username'));
					$alamat= $this->security->xss_clean( $this->input->post('alamat'));
					$password = $this->security->xss_clean($this->input->post('password'));

					// validasi
					$this->form_validation->set_rules('nama', 'Nama Anggot', 'required');
					if(!$this->form_validation->run()) {
						$this->session->set_flashdata('msg_alert_error', 'Gagal Menambah data Petugas');
						redirect( base_url('Perpustakaan/listPetugas') );
					}

		            $data['Nama'] = $nama;
					$data['Password'] = $password;
					$data['Username'] = $username;
					$data['Alamat'] = $alamat;
					$this->md_pet->tambahPetugas($data);

					redirect(base_url('Perpustakaan/listPetugas'));
				}					
				break;
			default:
				redirect( base_url() );
				break;
		}
	}
	public function hapus()
	{
		if( empty($this->uri->segment('3'))) {
			redirect( base_url() );
		}

		if( empty($this->uri->segment('4'))) {
			redirect( base_url() );
		}

		$cek = $this->uri->segment('3');
		$id = $this->uri->segment('4');
		//var_dump($id);

		switch ($cek) {
			case 'buku':
				$this->md_buku->hapusBuku($id);
			    redirect(base_url('Perpustakaan/listBuku'));
			break;
			case 'anggota':
				$this->md_ang->hapusAnggota($id);
			    redirect(base_url('Perpustakaan/listAnggota'));
			break;
			case 'petugas':
				$this->md_pet->hapusPetugas($id);
				redirect(base_url('Perpustakaan/listPetugas'));
			break;
			case 'peminjam':
				$this->md_pem->hapusPeminjaman($id);
			    redirect(base_url('Perpustakaan/listPeminjaman'));
			break;
			default:
				redirect( base_url() );
			break;
		}
	}
	public function update()
	{
		if( empty($this->uri->segment('3'))) {
			redirect( base_url() );
		}
		$cek = $this->uri->segment('3');
		//var_dump($cek);

		switch ($cek) {
			case 'buku':
				if( $_SERVER['REQUEST_METHOD'] == 'POST') {
					$id= $this->security->xss_clean( $this->input->post('id'));
					$judul= $this->security->xss_clean( $this->input->post('judul'));
					$penerbit= $this->security->xss_clean( $this->input->post('penerbit'));
					$pengarang= $this->security->xss_clean( $this->input->post('pengarang'));
					$tahun= $this->security->xss_clean( $this->input->post('tahun'));

					// validasi
					$this->form_validation->set_rules('judul', 'Judul Buku', 'required');
					if(!$this->form_validation->run()) {
						$this->session->set_flashdata('msg_alert_error', 'Gagal Update data Buku');
						redirect( base_url('Perpustakaan/listBuku') );
					}

					$data['JudulBuku'] = $judul;
					$data['Pengarang'] = $pengarang;
					$data['Penerbit'] = $penerbit;
					$data['TahunTerbit'] = $tahun;

					// var_dump($data);
					$this->md_buku->updateBuku($id,$data);
					redirect(base_url('Perpustakaan/listBuku'));
				}
			break;
			case 'anggota':
				if( $_SERVER['REQUEST_METHOD'] == 'POST') {
					$id= $this->security->xss_clean( $this->input->post('id'));
					$nama= $this->security->xss_clean( $this->input->post('nama'));
					$jenjang= $this->security->xss_clean( $this->input->post('jenjang'));
					$prodi= $this->security->xss_clean( $this->input->post('prodi'));
					$alamat= $this->security->xss_clean( $this->input->post('alamat'));

					// validasi
					$this->form_validation->set_rules('nama', 'Nama Anggot', 'required');
					if(!$this->form_validation->run()) {
						$this->session->set_flashdata('msg_alert_error', 'Gagal Updata Anggot');
						redirect( base_url('Perpustakaan/listAnggota') );
					}

		            $data['Nama'] = $nama;
					$data['Jenjang'] = $jenjang;
					$data['Prodi'] = $prodi;
					$data['Alamat'] = $alamat;

					// var_dump($data);
					$this->md_ang->updateAnggota($id,$data);
					redirect(base_url('Perpustakaan/listAnggota'));
				}
			break;
			case 'petugas':
				if( $_SERVER['REQUEST_METHOD'] == 'POST'){
					$id = $this->security->xss_clean( $this->input->post('id'));
					$nama = $this->security->xss_clean( $this->input->post('nama'));
					$alamat = $this->security->xss_clean( $this->input->post('alamat'));
					$username = $this->security->xss_clean( $this->input->post('username'));
					// validasi
					$this->form_validation->set_rules('nama', 'Nama Petugas', 'required');
					if(!$this->form_validation->run()) {
						$this->session->set_flashdata('msg_alert_error', 'Gagal Updata Petugas');
						redirect( base_url('Perpustakaan/listPetugas') );
					}

		            $data['Nama'] = $nama;
					$data['Alamat'] = $alamat;
					$data['Username'] = $username;

					// var_dump($data);
					$this->md_pet->updatePetugas($id,$data);
					redirect(base_url('Perpustakaan/listPetugas'));

				}	
			break;
			case 'peminjam':
				if( $_SERVER['REQUEST_METHOD'] == 'POST') {
					$id_buku= $this->security->xss_clean( $this->input->post('id_buku'));
					$id_peminjam= $this->security->xss_clean( $this->input->post('id_anggota'));
					$id_pinjam= $this->security->xss_clean( $this->input->post('id_pinjam'));
					$id_petugas= $this->security->xss_clean( $this->input->post('petugas'));
					$kembali= $this->security->xss_clean( $this->input->post('kembali'));
					$pinjam= $this->security->xss_clean( $this->input->post('pinjam'));

					// validasi
					$this->form_validation->set_rules('pinjam', 'Nama Anggot', 'required');
					if(!$this->form_validation->run()) {
						$this->session->set_flashdata('msg_alert_error', 'Gagal update data Peminjaman');
						redirect( base_url('Perpustakaan/listPeminjaman') );
					}

					$id = $id_pinjam;

					$data['Kd_anggota'] = $id_peminjam;
					$data['Kd_petugas'] = $id_petugas;

		            $item['Kd_register'] = $id_buku;
					$item['Tgl_kembali'] = $kembali;
					$item['Tgl_pinjam'] = $pinjam;
					//$data['sekarang'] = date('Y-m-d');

					//var_dump($data);
					$this->md_pem->updateTbPeminjaman($id,$data);
					$this->md_pem->updateTbDetailPinjam($id,$item);
					redirect(base_url('Perpustakaan/listPeminjaman'));
				}
			break;
			default:
				redirect( base_url() );
				break;
		}
	}
	public function kembali()
	{
		$id = $this->uri->segment('3');

		$item['Tgl_kembali'] = date('Y-m-d');
		$this->md_pem->bukuKembali($id,$item);
		//var_dump($id);
		redirect(base_url('Perpustakaan/listPeminjaman'));
	}
	public function pinjamBuku()
	{
		$data['petugas'] = $this->md_pem->petugas();
		$data['anggota'] = $this->md_pem->anggota();
		$data['buku'] = $this->md_pem->buku();
		//var_dump($data);
		$this->load->view('admin/dashboard/petugas/peminjaman_buku',$data);
	}
	public function riwayatPeminjam()
	{
		$data['peminjam'] = $this->md_pem->list_all();
		$this->load->view('admin/dashboard/petugas/riwayat_peminjaman',$data);
	}
	public function peminjaman()
	{
		if( $_SERVER['REQUEST_METHOD'] == 'POST') {
			$buku= $this->security->xss_clean( $this->input->post('buku'));
			$petugas= $this->security->xss_clean( $this->input->post('petugas'));
			$anggota= $this->security->xss_clean( $this->input->post('anggota'));
			
			// validasi
			$this->form_validation->set_rules('anggota', 'Nama Anggot', 'required');
			if(!$this->form_validation->run()) {
				$this->session->set_flashdata('msg_alert_error', 'Gagal Meminjam Buku');
				redirect( base_url('Perpustakaan/pinjamBuku') );
			}

			$data['Kd_anggota'] = $anggota;
			$data['Kd_petugas'] = $petugas;
			$item['Kd_register'] = $buku;
			$item['Tgl_pinjam'] = date('Y-m-d');
			$this->md_pem->peminjaman($data,$item);

			redirect(base_url('Perpustakaan/listPeminjaman'));
		}
	}
	public function Logout()
	{
		$this->load->view('admin/dashboard/petugas/login');
	}
}
