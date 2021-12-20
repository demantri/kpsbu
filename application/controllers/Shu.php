<?php 
class Shu extends CI_Controller
{
    public function laporan()
    {
        $pnj = $this->db->query("SELECT
        SUM(nominal) AS total
        FROM jurnal a
        LEFT JOIN (
            SELECT id, no_coa, nama_coa, header, is_shu
            FROM coa
        ) AS b ON a.no_coa = b.no_coa
        WHERE b.is_shu = 1
        AND b.header = 4
        AND YEAR(tgl_jurnal) = 2021
        AND posisi_dr_cr = 'k'")->row()->total;

        $beban = $this->db->query("SELECT
        SUM(nominal) AS total, b.nama_coa, tgl_jurnal
        FROM jurnal a
        LEFT JOIN (
            SELECT id, no_coa, nama_coa, is_shu
            FROM coa
        ) AS b ON a.no_coa = b.no_coa
        WHERE b.is_shu = 1
        AND YEAR(tgl_jurnal) = 2021
        AND posisi_dr_cr = 'd'
        GROUP BY nama_coa")->result();

        $data = [
            'beban' => $beban,
            'pnj' => $pnj,
        ];
        $this->template->load('template', 'shu/laporan_shu/index', $data);
    }
}
?>