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

    public function cek_pegawai()
    {
        $q = "SELECT a.*
        -- , is_complete
        FROM pegawai a
        -- left JOIN jadwal_shift b ON a.nip = b.id_pegawai
        -- WHERE is_complete = 1
        -- GROUP BY rfid
        ";
        return $this->db->query($q);
    }

    public function shift()
    {
        $q = "SELECT a.*, b.nama, c.desc as shift FROM jadwal_shift a
        JOIN pegawai b ON a.id_pegawai = b.nip
        JOIN shift c ON a.id_shift = c.id
        ORDER BY a.id desc
        ";
        return $this->db->query($q);
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
		$query1   = "SELECT MAX(RIGHT(invoice,3)) as kode FROM pos_penjualan WHERE status != 'dalam proses'";
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

    public function invoice_pmb()
	{
		$query1   = "SELECT MAX(RIGHT(invoice,3)) as kode FROM pos_pembelian WHERE status != 'dalam proses'";
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
        $kode   = "KPSBUPMB".$date.$kd;
        return $kode;
	}
	
}