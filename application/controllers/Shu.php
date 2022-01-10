<?php 
class Shu extends CI_Controller
{
    public function index()
    {
        $kode = $this->M_transaksi->kode_shu();
        $shu = $this->db->get('alokasi_shu')->result();
        $total_penjualan = $this->M_transaksi->t_penjualan_shu()->row()->total_penjualan;
        $total_beban = $this->M_transaksi->t_beban_shu()->result();
        $hpp = $this->M_transaksi->t_hpp()->result();
        $total_beban_1 = 0;
        foreach ($total_beban as $key => $value) {
            $total_beban_1 += $value->total;
        }
        $total_hpp = 0;
        foreach ($hpp as $key => $value) {
            $total_hpp += $value->hpp;
        }
        $pendapatan_lain = 0;

        $penambah = ($total_penjualan + $total_hpp + $pendapatan_lain);
        $pengurang = $total_beban_1;
        $shu_sblm_pajak = ($penambah - $pengurang);
        $pajak = round($shu_sblm_pajak * 0.01);
        $shu_setelah_pajak = ($shu_sblm_pajak - $pajak); 

        $this->get_data_jasa_anggota($shu_setelah_pajak);

        $year = date('Y');
        $this->db->where('year(tanggal)', $year);
        $cek = $this->db->get('transaksi_shu')->row();
        // print_r($cek);exit;
        $list = $this->db->get('transaksi_shu')->result();
        $detail_shu = $this->db->get('detail_transaksi_shu')->result();
        
        $data = [
            'kode' => $kode,
            'shu' => $shu,
            'nominal_shu' => $shu_setelah_pajak,
            'cek' => $cek,
            'list' => $list,
            'detail_shu' => $detail_shu,
        ];
        $this->template->load('template', 'shu/transaksi/index', $data);
    }

    public function save_transaksi_shu()
    {
        $kode_shu = $this->input->post('kode_shu');
        $uraian = $this->input->post('uraian');
        $total = $this->input->post('total');
        $grandtot = 0;
        foreach ($total as $item) {
            $grandtot += $item;
        }

        $shu = [
            'kode_shu' => $kode_shu,
            'tanggal' => date('Y-m-d'),
            'nominal' => $grandtot,
            'status' => 2
        ];
        $this->db->insert('transaksi_shu', $shu);
        
        // insert ke detail
        $detail = [];
        foreach ($total as $key => $value) {
            $detail[$key] = [
                'kode_shu' => $kode_shu,
                'uraian' => $uraian[$key],
                'nominal' => $value,
            ];
        }
        $this->db->insert_batch('detail_transaksi_shu', $detail);
        // print_r($detail);exit;

        // // kirim ke db pengajuan jurnal 
        // $pengajuan = [
        //     'kode' => $kode_shu,
        //     'tanggal' => date('Y-m-d'),
        //     'nominal' => $grandtot,
        //     'jenis' => 'transaksi shu',
        // ];
        // $this->db->insert("pengajuan_jurnal", $pengajuan);
        redirect('shu');
    }

    public function jasa_anggota()
    {
        $this->db->where('is_deactive', 0);
        $anggota = $this->db->get('peternak')->result();
        $data = [
            'anggota' => $anggota
        ];
        $this->template->load('template', 'shu/jasa_anggota/index', $data);
    }

    public function get_data_jasa_anggota()
    {
        $id_peternak = $this->input->post('id');
        $total_penjualan = $this->M_transaksi->t_penjualan_shu()->row()->total_penjualan;
        $total_transaksi = $this->M_transaksi->trans_susu($id_peternak)->row()->total_transaksi;
        $jasa_anggota = $this->M_transaksi->jasa_anggota()->row()->nominal;
        $data = [
            'total_penjualan' => $total_penjualan,
            'total_transaksi' => $total_transaksi,
            'jasa_anggota' => $jasa_anggota,
        ];
        echo json_encode($data);
    }

    public function save_jasa_anggota()
    {
        # code...
    }

    public function laporan()
    {
        $tahun = date('Y');
        $pnj = $this->db->query("SELECT
        SUM(nominal) AS total
        FROM jurnal a
        LEFT JOIN (
            SELECT id, no_coa, nama_coa, header, is_shu
            FROM coa
        ) AS b ON a.no_coa = b.no_coa
        WHERE b.is_shu = 1
        AND b.header = 4
        AND YEAR(tgl_jurnal) = '$tahun'
        AND posisi_dr_cr = 'k'")->row()->total;

        $beban = $this->db->query("SELECT
        SUM(nominal) AS total, b.nama_coa, tgl_jurnal
        FROM jurnal a
        LEFT JOIN (
            SELECT id, no_coa, nama_coa, is_shu, header
            FROM coa
        ) AS b ON a.no_coa = b.no_coa
        WHERE b.is_shu = 1
        AND b.header = 5
        AND YEAR(tgl_jurnal) = '$tahun'
        AND posisi_dr_cr = 'd'
        GROUP BY nama_coa")->result();

        $hpp = $this->M_transaksi->t_hpp()->result();
        $t_hpp = 0;
        foreach ($hpp as $key => $value) {
            $t_hpp += $value->hpp;
        }

        $data = [
            'beban' => $beban,
            'pnj' => $pnj,
            't_hpp' => $t_hpp,
        ];
        // print_r($data);exit;
        $this->template->load('template', 'shu/laporan_shu/index', $data);
    }
}
?>