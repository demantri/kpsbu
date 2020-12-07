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

	// public function get_detail($id_pembelian)
	// {
	// 	# code...
	// 	$this->db->select('a.jumlah, a.subtotal, b.nama_bhn, b.harga, nama_jenis_bahan, d.kd_pemasok, nama_pemasok');
 //    	$this->db->from('detail_pembelian_aset a');
 //    	$this->db->join('bhn_baku b', 'a.kd_bhn_baku = b.kd_bhn_baku');
 //    	$this->db->join('jenis_bahan c', 'a.id_jenis_bahan = c.id_jenis_bahan');
 //    	$this->db->join('pemasok d', 'a.kd_pemasok = d.kd_pemasok');
	// 	$this->db->where('a.no_pembelian', $kd);
	// 	return $this->db->get()->result();
	// }

	public function simpanDetail(){
    	//Ambil Harga dari Tabel Bhn Baku
    	$this->db->where('kd_bhn_baku', $this->input->post('kd_bhn_baku'));
    	$hargabarang = $this->db->get('bhn_baku')->row()->harga;

       // detail pembelian
    	$this->db->where(array(
    		'id_pembelian' => $this->input->post('id'),
    		'id_aset' => $this->input->post('id_aset')
    	));

    	$query = $this->db->get('detail_pembelian');
    	if($query->num_rows() == 0){
    		$subtotal = $this->input->post('jumlah') * $hargabarang;
    		$insert = array(
			'no_pembelian' => $this->input->post('kode'),
			'id_jenis_bahan' => $this->input->post('id_jenis_bahan'),
			'kd_bhn_baku'    => $this->input->post('kd_bhn_baku'),
			'jumlah'       => $this->input->post('jumlah'),
			'subtotal'     => $subtotal,
			'kd_pemasok'     => $this->input->post('kd_pemasok'),
		);
			$this->db->insert('detail_pembelian', $insert);
		}else{
			$this->db->set('jumlah', "jumlah + ".$this->input->post('jumlah')."", FALSE);
			$this->db->set('subtotal', "subtotal + ".$this->input->post('jumlah') * $hargabarang."", FALSE);
			$this->db->where(
				array(
					'no_pembelian' => $this->input->post('kode'), 
					'kd_bhn_baku' => $this->input->post('kd_bhn_baku')
				));
			$this->db->update('detail_pembelian');
		}
	}
}