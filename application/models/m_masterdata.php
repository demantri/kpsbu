<?php

class m_masterdata extends CI_Model {

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

	function simpanan_wajib() {
		$sql = "SELECT * FROM `simpanan` where simpanan like 'simpanan wajib' ";
		return $this->db->query($sql);
	}

	public function kategori_code()
	{
		# code...
		$query1   = "SELECT MAX(RIGHT(kode,3)) as kode FROM waserda_kategori";
        $abc      = $this->db->query($query1);
        $kode = "";
        if ($abc->num_rows() > 0) {
            foreach ($abc->result() as $k) {
                $tmp = ((int) $k->kode) + 1;
                $kd  = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        $kode   = "WKS".$kd;
        return $kode;
	}

	public function kode_produk()
	{
		$query1   = "SELECT MAX(RIGHT(kode,3)) as kode FROM waserda_produk";
        $abc      = $this->db->query($query1);
        $kode = "";
        if ($abc->num_rows() > 0) {
            foreach ($abc->result() as $k) {
                $tmp = ((int) $k->kode) + 1;
                $kd  = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        $kode   = "WSP".$kd;
        return $kode;
	}

	public function invoice()
	{
		$query1   = "SELECT MAX(RIGHT(invoice,3)) as kode FROM pos_penjualan";
        $abc      = $this->db->query($query1);
        $kode = "";
        if ($abc->num_rows() > 0) {
            foreach ($abc->result() as $k) {
                $tmp = ((int) $k->kode) + 1;
                $kd  = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
		$date = date('dmy');
        $kode   = "KPSBU".$date.$kd;
        return $kode;
	}
	
}