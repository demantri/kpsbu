<?php

class m_transaksi extends CI_Model {

    function tambah_data($table, $data){
		$this->db->insert($table, $data);
	}

	function edit_data($table, $where){		
		return $this->db->get_where($table,$where);
	}
	function update_data($table,$data){
		//$this->db->where($where);
		return $this->db->update($table,$data);
	}

	function hapus_data($table, $where){
		$this->db->where($where);
		return 	$this->db->delete($table);
	}

	function get_aset($id_supplier) {
		$this->db->where('id_supplier', $id_supplier);
  		$this->db->order_by('aset', 'ASC');

  		$query = $this->db->get("aset");
  		// print_r($query);exit;
  		$output = '<option value="">Pilih aset</option>';
  		foreach($query->result() as $row)
  		{
   			$output .= '<option value="'.$row->id.'">'.$row->aset.'</option>';
  		}
  		return $output;
	}
}