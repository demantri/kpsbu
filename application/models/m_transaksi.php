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

	// public function detail_penyusutan() {
	// 	$this->db->select("detail_pembelian.*, aset.id as kd_aset, aset, umur_aset, sisa_umur");
	// 	$this->db->join("aset", "aset.id = detail_pembelian.id_aset");
	// 	// $this->db->join("penyusutan", "aset.id = penyusutan.id_aset");
	// 	$this->db->where("sisa_umur !=", "0");
	// 	$this->db->where("is_rev =", 0);
	// 	$this->db->where("cek_bulan_peny !=", date("Y-m"));

	// 	$sql = $this->db->get("detail_pembelian");
	// 	return $sql->result();
	// }

	public function getAset()
	{
		$sql = "SELECT detail_pembelian.*, aset.id as kd_aset, aset, umur_aset, sisa_umur 
		FROM detail_pembelian
		JOIN aset ON aset.id = detail_pembelian.id_aset
		";
		return $this->db->query($sql);
	}

	public function detail_penyusutan() {
		$sql = "SELECT detail_pembelian.*, aset.id as kd_aset, aset, umur_aset, sisa_umur 
		FROM detail_pembelian
		JOIN aset ON aset.id = detail_pembelian.id_aset
		WHERE sisa_umur != 0
		AND is_rev = 0
		AND cek_bulan_peny != LEFT(SYSDATE(), 7)
		AND cek_bulan_perb is null
		";
		return $this->db->query($sql)->result();
	}

	public function detail_rev() {
		$sql = "SELECT a.*, b.id as kd_aset, aset, umur_aset, sisa_umur
		from detail_pembelian a
		join aset b on a.id_aset = b.id 
		where sisa_umur != 0 
		and cek_bulan_perb is not null
		";
		return $this->db->query($sql)->result();
	}

	public function list_aset($id)
	{
		$sql = "SELECT a.*, aset
		FROM detail_pembelian a
		INNER JOIN aset b ON a.id_aset = b.id
		WHERE cek_bulan_perb IS NULL
		AND id_detail_aset = '$id' ";
		return $this->db->query($sql);
	}

	public function anggota_pinjaman_dropdown() {
		$this->db->select("peternak.no_peternak, nama_peternak, COUNT(no_trans) as total_trans");
	    // $this->db->from("peternak");
	    $this->db->join("detail_pembelian_bb", "peternak.no_peternak = detail_pembelian_bb.no_peternak");
	    $this->db->where("no_trans >=" , "8");
	    $this->db->group_by("peternak.no_peternak");
	    $sql = $this->db->get("peternak");

		return $sql->result();
	}

	function get_jumlah($id_peternak){ 
        $query = "SELECT SUM(jumlah) as total_jumlah, SUM(subtotal) as total_trans_susu, pinjaman
		FROM detail_pembelian_bb
		JOIN pembelian_bb ON (pembelian_bb.no_trans = detail_pembelian_bb.no_trans)
		JOIN peternak ON (peternak.no_peternak = detail_pembelian_bb.no_peternak)
        WHERE tgl_trans BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW() AND detail_pembelian_bb.no_peternak = '$id_peternak'";
		return $this->db->query($query);
    }

    function coba($id_peternak){ 
        // $query = "SELECT SUM(jumlah) as total_jumlah, SUM(subtotal) as total_trans_susu, pinjaman, tgl_trans, tgl_trans + INTERVAL 14 DAY as nextPayment
		// FROM detail_pembelian_bb
		// JOIN pembelian_bb ON (pembelian_bb.no_trans = detail_pembelian_bb.no_trans)
		// JOIN peternak ON (peternak.no_peternak = detail_pembelian_bb.no_peternak)
		// WHERE tgl_trans BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW() AND detail_pembelian_bb.no_peternak = '$id_peternak'
		// GROUP BY tgl_trans";
		$query = "SELECT SUM(jumlah) as total_jumlah, SUM(subtotal) as total_trans_susu, pinjaman, tgl_trans, tgl_trans + INTERVAL 14 DAY as nextPayment
		FROM detail_pembelian_bb
		JOIN pembelian_bb ON (pembelian_bb.no_trans = detail_pembelian_bb.no_trans)
		JOIN peternak ON (peternak.no_peternak = detail_pembelian_bb.no_peternak)
		WHERE tgl_trans BETWEEN (LEFT(SYSDATE(),10) - INTERVAL 14 DAY) AND LEFT(SYSDATE(),10) 
		AND detail_pembelian_bb.no_peternak = '$id_peternak'";
		return $this->db->query($query);
    }

    public function getJumlah($id_peternak)
    {
    	# code...
    	$query = "
    	SELECT id_anggota, tgl_transaksi, tgl_transaksi + INTERVAL 14 DAY as next_trans
		FROM peternak
		JOIN log_pembayaran_susu ON log_pembayaran_susu.id_anggota = peternak.no_peternak
		JOIN pembayaran_susu ON pembayaran_susu.kode_pembayaran = log_pembayaran_susu.id_pembayaran
        WHERE no_peternak = '$id_peternak'
        ORDER BY tgl_transaksi DESC
        ";
		return $this->db->query($query);
    }

    public function getSyarat($id_peternak)
    {
    	// $sql = "SELECT total, log_pembayaran_susu.id_anggota, pinjaman
		// -- , nominal, status
		// FROM peternak
		// JOIN 
		// (
		// 	SELECT id_anggota, count(id_pembayaran) as total
		// 	FROM log_pembayaran_susu
		// 	WHERE id_anggota = '$id_peternak'
		// 	GROUP BY id_anggota
		// ) log_pembayaran_susu ON peternak.no_peternak = log_pembayaran_susu.id_anggota
		// -- JOIN log_pinjaman ON log_pinjaman.id_anggota = peternak.no_peternak
		// WHERE log_pembayaran_susu.id_anggota = '$id_peternak'
    	// ";

		// nyoba ganti sql nya 
		$sql = "SELECT t.id_anggota, 
		t.pinjaman, 
		t.total_bayar, 
		t.tgl_transaksi, 
		(
			SELECT COUNT(id_pembayaran) AS total
			FROM log_pembayaran_susu
			WHERE id_anggota = '$id_peternak'
		) AS total
		FROM 
			(
			SELECT id_anggota, id_pembayaran, pinjaman, total_bayar, tgl_transaksi
			FROM peternak a
			INNER JOIN log_pembayaran_susu b ON a.no_peternak = b.id_anggota
			INNER JOIN pembayaran_susu c ON c.kode_pembayaran = b.id_pembayaran
			WHERE id_anggota = '$id_peternak' 
		) t
		ORDER BY tgl_transaksi DESC
		LIMIT 1";
    	return $this->db->query($sql);
    }

    public function UtangPinjamanByMember($id_anggota)
    {
    	# code...
    	$sql = "
    	SELECT no_peternak, nama_peternak, nominal, status
		FROM peternak
		JOIN log_pinjaman ON log_pinjaman.id_anggota = peternak.no_peternak
		WHERE no_peternak = '$id_anggota'
    	";
    	return $this->db->query($sql);
    }

    public function getIndex()
    {
    	# code...
    	$sql = "
    	SELECT kode_pinjaman, id_anggota, tanggal_pinjaman, nominal, status, nama_peternak
		FROM log_pinjaman
		JOIN peternak ON peternak.no_peternak = log_pinjaman.id_anggota
		ORDER BY tanggal_pinjaman DESC
    	";
    	return $this->db->query($sql);
     }

    function get14day()
    {
    	# code...
    	$sql = "
	    SELECT tgl_transaksi + INTERVAL 14 DAY as tgl_transaksi
	    FROM peternak 
	    JOIN log_pembayaran_susu ON log_pembayaran_susu.id_anggota = peternak.no_peternak
	    JOIN pembayaran_susu ON log_pembayaran_susu.id_pembayaran = pembayaran_susu.kode_pembayaran";
	    return $this->db->query($sql);
    }

    function id_otomatis($value='')
	{
	    # code...
	    $this->db->select('RIGHT(pembayaran_susu.kode_pembayaran,  4) as kode', FALSE);
	    $this->db->order_by('kode_pembayaran','DESC');    
	    $this->db->limit(1);    
	    $query = $this->db->get('pembayaran_susu');//cek dulu apakah ada sudah ada kode di tabel.    
	    if($query->num_rows() <> 0){      
	     //jika kode ternyata sudah ada.      
	        $data = $query->row();      
	        $kode = intval($data->kode) + 1;    
	    }
	    else {      
	     //jika kode belum ada      
	        $kode = 1;    
	    }

	    $datenow = date('dmY');
	    $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
	    $kodejadi = "PMBS-".$datenow.''.$kodemax;    // hasilnya tgl sekarang + kode dst.
	    return $kodejadi;
	}

	public function next_datePayment($id_peternak)
	{
		# code...
		$now = date("Y-m-d");

		$sql = "
		SELECT tgl_trans, tgl_trans + INTERVAL 14 DAY as nextPayment
		FROM pembelian_bb
		JOIN detail_pembelian_bb ON detail_pembelian_bb.no_trans = pembelian_bb.no_trans
		WHERE detail_pembelian_bb.no_peternak = '$id_peternak'
		ORDER BY `pembelian_bb`.`tgl_trans`  ASC
		limit 1
		";
		return $this->db->query($sql);
	}

	public function getTruck($id)
	{
		$sql = "SELECT a.id, aset, id_detail_aset, id_aset
		FROM detail_pembelian a
		INNER JOIN aset b ON a.id_aset = b.id
		WHERE a.id = $id ";
		return $this->db->query($sql);
	}

	public function getPny()
	{
		$sql = "SELECT a.id_penyusutan, a.bulan_penyusutan, d.aset, c.id_detail_aset, total_penyusutan
		FROM penyusutan a
		INNER JOIN log_penyusutan b ON a.id_penyusutan = b.id_penyusutan
		INNER JOIN detail_pembelian c ON a.id_detail = c.id_detail_aset
		INNER JOIN aset d ON c.id_aset = d.id";
		return $this->db->query($sql);
	}
}