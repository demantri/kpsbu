<?php 
class Laporan extends CI_Controller
{

    public function __construct() {
        parent::__construct();
        $this->load->model('Produk_model', 'produk');
    }

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

    // sarah
    public function laporan_simpanan()
    {
        // $list = $this->db->query("SELECT 
        // z.nama_peternak, 
        // z.no_peternak, 
        // z.deposit, 
        // x.total_liter, 
        // x.total_harga, 
        // x.total_masuka, 
        // x.total_simpanan_wajib
        // FROM peternak z
        // LEFT JOIN (
        //     SELECT a.no_peternak, 
        //     a.nama_peternak, 
        //     a.deposit, 
        //     sum(b.jumlah_liter_susu) AS total_liter, 
        //     sum(b.jumlah_harga_susu) AS total_harga, 
        //     sum(b.simpanan_masuka) AS total_masuka, 
        //     sum(b.simpanan_wajib) AS total_simpanan_wajib, 
        //     c.total_bayar, 
        //     c.tgl_transaksi
        //     FROM peternak a 
        //     LEFT JOIN log_pembayaran_susu b ON a.no_peternak = b.id_anggota
        //     LEFT JOIN pembayaran_susu c ON b.id_pembayaran = c.kode_pembayaran
        //     WHERE left(tgl_transaksi, 4) = '$year'
        //     GROUP BY nama_peternak
        // ) AS x ON z.no_peternak = x.no_peternak
        // WHERE z.is_deactive = 0")->result();
        $list = $this->M_transaksi->data_laporan_shu()->result();
        // print_r($list);exit;
        $data = [
            'list' => $list,
        ];
        $this->template->load('template', 'laporan_simpanan', $data);
    }

    // siti 
    public function laporan_penjualan_waserda()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        $periode = $tahun.'-'.$bulan;

        $show_all = $this->input->post('show_all');
        // print_r($show_all);exit;

        if (isset($periode)) {
            $list = $this->db->query("SELECT * FROM pos_penjualan 
            WHERE LEFT(tanggal, 7) = '$periode'")->result();
            $data = [
                'list' => $list, 
            ];
            $this->template->load('template', 'laporan/laporan_penjualan_waserda', $data);
        } 
        // if (isset($show_all)) {
        //     $list = $this->db->query("SELECT * FROM pos_penjualan")->result();
        //     $data = [
        //         'list' => $list, 
        //     ];
        //     $this->template->load('template', 'laporan/laporan_penjualan_waserda', $data);
        // }
    }

    public function kartu_stok()
    {
        $getProduk = $this->produk->getProdukWaserda()->result();
        $getKartuStok = $this->produk->getKartuStok()->result();
        $data = [
            'produk' => $getProduk, 
            'kartu_stok' => $getKartuStok,
        ];
        $this->template->load('template', 'laporan/kartu_stok', $data);
    }

    // salma 
    public function buku_kas_kecil()
    {
        $list = $this->db->get('buku_kas_kecil')->result();
        $data = ['list' => $list];
        $this->template->load('template', 'laporan/buku_kas_kecil', $data);
    }
}
?>