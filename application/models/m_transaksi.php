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

	public function get_detail($id_pembelian)
	{
		# code...
		$this->db->select('*');
    	$this->db->from('detail_pembelian');
    	$this->db->join('aset', 'aset.id = detail_pembelian.id_aset');
    	$this->db->join('supplier_aset', 'supplier_aset.id = aset.id_supplier');
		$this->db->where('id_pembelian', $id_pembelian);
		return $this->db->get()->result();
	}

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

	public function detail_view()
	{
		# code...
		$this->db->select("*");
		$this->db->join("detail_pembelian", "detail_pembelian.id_pembelian = pembelian_aset.id_pembelian");
		$sql = $this->db->get("pembelian_aset");
		return $sql->result();
	}

	public function detail_penyusutan() {
		$this->db->select("detail_pembelian.*, aset.id as kd_aset, aset, umur_aset, sisa_umur");
		$this->db->join("aset", "aset.id = detail_pembelian.id_aset");
		// $this->db->join("penyusutan", "aset.id = penyusutan.id_aset");
		$this->db->where("sisa_umur !=", "0");
		$this->db->where("cek_bulan_peny !=", date("Y-m") );

		$sql = $this->db->get("detail_pembelian");
		return $sql->result();
	}

	public function anggota_pinjaman_dropdown() {
		// $this->db->select("detail_pembelian.*, aset.id as kd_aset, aset, umur_aset, sisa_umur");
		// $this->db->join("aset", "aset.id = detail_pembelian.id_aset");
		// // $this->db->join("penyusutan", "aset.id = penyusutan.id_aset");
		// $this->db->where("sisa_umur !=", "0");
		// $this->db->where("cek_bulan_peny !=", date("Y-m") );

		// $sql = $this->db->get("detail_pembelian");


		$this->db->select("peternak.no_peternak, nama_peternak, COUNT(no_trans) as total_trans");
	    // $this->db->from("peternak");
	    $this->db->join("detail_pembelian_bb", "peternak.no_peternak = detail_pembelian_bb.no_peternak");
	    $this->db->where("no_trans >=" , "8");
	    $this->db->group_by("peternak.no_peternak");
	    $sql = $this->db->get("peternak");

		return $sql->result();
	}
}