<?php 
class simpanan_model extends CI_model
{
	
	public function getDetails($id_peternak)
	{
		# code...

		$sql = "
		SELECT detail_pembelian_bb.no_trans, jumlah, harga, subtotal, detail_pembelian_bb.no_peternak, nama_peternak, tgl_trans
		FROM detail_pembelian_bb
		JOIN peternak ON peternak.no_peternak = detail_pembelian_bb.no_peternak
		JOIN pembelian_bb ON pembelian_bb.no_trans = detail_pembelian_bb.no_trans
		WHERE detail_pembelian_bb.no_peternak = '$id_peternak'
		";
		return $this->db->query($sql);
	}

	public function anggota($id_peternak)
	{
		# code...
		$sql = "
		SELECT no_peternak, nama_peternak
		FROM `peternak`
		WHERE no_peternak = '$id_peternak'
		";
		return $this->db->query($sql);
	}

	public function detailHr($id_peternak)
	{
		# code...

		$sql = "
		SELECT kode_simpanan_hr, tgl_simpanan, nama_peternak, nominal
		FROM log_simpanan_hr
		JOIN peternak ON peternak.no_peternak = log_simpanan_hr.id_anggota
		WHERE log_simpanan_hr.id_anggota = '$id_peternak'
		";
		return $this->db->query($sql);
	}

	public function _simpanan_wajib_list($id_peternak)
	{
		$sql = "SELECT a.*, b.tgl_transaksi, c.nama_peternak
		FROM log_pembayaran_susu a
		JOIN pembayaran_susu b ON b.kode_pembayaran = a.id_pembayaran
		JOIN peternak c ON c.no_peternak = a.id_anggota
		WHERE id_anggota = '$id_peternak'
		";
		return $this->db->query($sql);
	}

	public function sum_simpwajib($id_peternak)
	{
		# code...
		$sql = "SELECT SUM(simpanan_wajib) as total_simpanan_wajib
		FROM `log_pembayaran_susu`
		WHERE id_anggota = '$id_peternak'
		";
		return $this->db->query($sql);
	}
	
}