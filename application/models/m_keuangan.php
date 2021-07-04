<?php 
class m_keuangan extends CI_model
{
	public function GenerateJurnal ($no_akun, $no_transaksi, $posisi_dr_cr, $nominal)
	{
		date_default_timezone_set("Asia/Bangkok");
		$jurnal = array(
			'id_jurnal' => $no_transaksi,
			'tgl_jurnal' => date('Y-m-d'),
			'no_coa' => $no_akun,
			'posisi_dr_cr' => $posisi_dr_cr,
			'nominal' => $nominal,
			);
			$this->db->insert('jurnal',$jurnal);
	}
	
	//pagination
	public function HitungJumlahBaris(){
		$query = $this->db->get('pembelian');
		return $query->num_rows();
	}

	//pagination jurnal cok
	public function hitungjumlah(){
		return $this->db->get('jurnal')->num_rows();
	}
	/*
	//ambildata untuk laporan keuangan_penjualan pnj
	public function GetDataLaporanPnj($start , $limit){
		$this->db->limit($limit, $start);
		return $this->db->get('transaksi_penjualan')->result_array();
	}
	*/
	public function GetDataAkun()
	{
		return $this->db->get('coa')->result_array();
	}
	
	public function GetSaldoAkun($no_akun)
	{
		$this->db->where('no_coa', $no_akun);
		return $this->db->get('coa')->row_array();
	}
	
	//public function GetDataJurnal($limit, $start)
	public function GetDataJurnal()
	{
		//$this->db->limit($limit, $start);
		if(isset($_POST['tgl_awal'], $_POST ['tgl_akhir']))
		{
			$this->db->where('tgl_jurnal >=', $_POST['tgl_awal']);
			$this->db->where('tgl_jurnal <=', $_POST['tgl_akhir']);
		}
		$this->db->select('a.no_coa, tgl_jurnal, nama_coa, a.posisi_dr_cr, nominal, id_jurnal');
		$this->db->from('jurnal a');
		$this->db->join('coa b', 'b.no_coa = a.no_coa');
		$this->db->order_by('no');
		$query = $this->db->get();
		return $query->result_array();	
	}

	public function getdatajurnalall(){
		$this->db->select('a.no_coa, tgl_jurnal, nama_coa, a.posisi_dr_cr, nominal, id_jurnal');
		$this->db->from('jurnal a');
		$this->db->join('coa b', 'b.no_coa = a.no_coa');
		$this->db->order_by('no');
		$query = $this->db->get();
		return $query->result_array();	
	}
	public function GetDataJurnalfilter($awal, $akhir)
	{
		//$this->db->limit($limit, $start);
			$this->db->where('tgl_jurnal >=', $awal);
			$this->db->where('tgl_jurnal <=', $akhir);
		$this->db->select('a.no_coa, tgl_jurnal, nama_coa, a.posisi_dr_cr, nominal, id_jurnal');
		$this->db->from('jurnal a');
		$this->db->join('coa b', 'b.no_coa = a.no_coa');
		$this->db->order_by('no');
		$query = $this->db->get();
		return $query->result_array();	
	}
	

		public function GetDataBukuBesar($no_akun, $bulan, $tahun){
		//public function GetDataBukuBesar(){
				// $this->db->limit($limit, $start);
		$this->db->where('a.no_coa', $no_akun);
		$this->db->select('a.no_coa, tgl_jurnal, nama_coa,a.posisi_dr_cr, nominal');
		$this->db->from('jurnal a');
		$this->db->join('coa b', 'b.no_coa = a.no_coa');
		$this->db->where('a.no_coa', $no_akun);
		$this->db->where('MONTH(tgl_jurnal)', $bulan );
		$this->db->where('YEAR(tgl_jurnal)', $tahun);
		$query = $this->db->get();
		return $query->result_array();
		}

	public function getBB($coa, $tgl)
	{
		$sql ="SELECT a.*, nama_coa, saldo_awal
		FROM jurnal a
		JOIN coa b ON a.no_coa = b.no_coa
		WHERE a.no_coa = '$coa'
		AND LEFT(tgl_jurnal, 7) = '$tgl'
		";
		return $this->db->query($sql);
	}

	public function bb_kosongan()
	{
		$sql ="SELECT a.*, nama_coa, saldo_awal
		FROM jurnal a
		JOIN coa b ON a.no_coa = b.no_coa
		WHERE a.no_coa = ''
		AND LEFT(tgl_jurnal, 7) = LEFT(SYSDATE(),7)
		";
		return $this->db->query($sql);
	}

	
}