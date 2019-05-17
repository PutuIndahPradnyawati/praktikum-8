<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class DataMaster_Petugas extends CI_Model
{
	
	public function list_all() {
		$data = $this->db->select('*')
					 ->from('petugas')
					 ->get();
		return $data->result();
	}
	public function tambahPetugas($data)
	{
		$this->db->insert('petugas', $data);
		$this->session->set_flashdata('msg_alert', 'Petugas berhasil ditambahkan');
	}
	public function hapusPetugas($id)
    {
	  	$this->db->where('Kd_Petugas',$id)
				 ->delete('petugas');
	  	$this->session->set_flashdata('msg_alert', 'Data Petugas berhasil dihapus');
    }
    public function updatePetugas($id,$data)
    {
		$this->db->where('Kd_Petugas',$id)
				 ->update('petugas', $data);
		$this->session->set_flashdata('msg_alert', 'Data Petugas berhasil diupdate');
    }
}

