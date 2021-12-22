<?php 
class Laporan extends CI_Controller
{
    public function buku_pembantu_kas()
    {
        $list = $this->db->get('buku_pembantu_kas')->result();
        $data = [
            'list' => $list,
        ];
        $this->template->load('template', 'buku_pembantu_kas', $data);
    }

    public function laporan_arus_kas()
    {
        $total_d = $this->db->query("select sum(nominal) as total from buku_pembantu_kas where posisi_dr_cr = 'd' ")->row()->total;
        $total_k = $this->db->query("select sum(nominal) as total from buku_pembantu_kas where posisi_dr_cr = 'k' ")->row()->total;
        $kas_diterima = $total_d - $total_k;

        $pmb = $this->db->query("SELECT
        SUM(nominal) as total
        FROM jurnal a
        JOIN coa b ON a.no_coa = b.no_coa
        WHERE b.header = 5
        AND nama_coa LIKE '%pembelian%'")->row()->total;

        $beban = $this->db->query("SELECT
        SUM(nominal) as total, 
        nama_coa
        FROM jurnal a
        JOIN coa b ON a.no_coa = b.no_coa
        WHERE b.header = 5
        AND is_arus_kas = 1
        GROUP BY a.no_coa")->result();
        // print_r($kas_diterima);exit;
        $data = [
            'kas_diterima' => $kas_diterima,
            'pmb' => $pmb,
            'beban' => $beban,
        ];
        $this->template->load('template', 'arus_kas', $data);
    }
}
?>