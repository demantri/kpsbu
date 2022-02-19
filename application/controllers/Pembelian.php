<?php class Pembelian extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model(array(
            'm_masterdata' => 'master',
            'Produk_model' => 'produk',
        ));
    }
    public function index()
    {
        $list = $this->produk->list()->result();
        $data = [
            'list' => $list,
        ];
        $this->template->load('template', 'waserda/pembelian/index', $data);
    }

    public function add()
    {
        $inv = $this->master->invoice_pmb();
        $supplier = $this->db->get('waserda_supplier')->result();
        $detail = $this->produk->detail_pembelian($inv)->result();
        $total = $this->produk->total_pembelian($inv)->row()->total;
        $ppn = $total * 0.1;
        $grand = $total + $ppn;
        $id_bb = $this->db->query("select id_produk from pos_detail_pembelian where invoice = '$inv'")->result();
        // print_r($total);exit;
        $data = [
            'kode' => $inv,
            'supplier' => $supplier,
            'detail' => $detail,
            'total' => $total,
            'ppn' => $ppn,
            'grandtotal' => $grand,
            'id_bb' => $id_bb,
        ];
        $this->template->load('template', 'waserda/pembelian/add', $data);
    }

    public function supplier()
    {
        if ($this->input->post('supplier')) {
            echo $this->produk->get_produk_by_supplier($this->input->post('supplier'));
        }
    }

    public function produk($id)
    {
        $this->db->where('kode', $id);
        $data = $this->db->get('waserda_produk')->row();
        echo json_encode($data);
    }

    public function add_to_detail()
    {
        $kode = $this->input->post('kode');
        $tanggal = $this->input->post('tanggal');
        $supplier = $this->input->post('supplier');
        $produk = $this->input->post('produk');
        $jml = $this->input->post('jml');
        $harga = $this->input->post('harga');
        // print_r($produk);exit;

        $this->db->where('invoice', $kode);
        $this->db->where('id_produk', $produk);
        $cek = $this->db->get('pos_detail_pembelian')->row();

        $this->db->where('status', 'dalam proses');
        $cek_beli = $this->db->get('pos_pembelian')->num_rows();

        if ($cek_beli == 0) {
            # code...
            $data = [
                'invoice' => $kode,
                'id_supplier' => $supplier,
                'id_produk' => $produk,
                'harga_satuan' => $harga,
                'jml' => $jml,
                'status' => 'dalam proses',
            ];
            $this->db->insert('pos_detail_pembelian', $data);
    
            $pembelian = [
                'invoice' => $kode,
                'status' => 'dalam proses',
                'tanggal' => date('Y-m-d'),
            ];
            $this->db->insert('pos_pembelian', $pembelian);
        } else {
            if (empty($cek->id_produk)) {
                # code...
                $data = [
                    'invoice' => $kode,
                    'id_supplier' => $supplier,
                    'id_produk' => $produk,
                    'harga_satuan' => $harga,
                    'jml' => $jml,
                    'status' => 'dalam proses',
                ];
                $this->db->insert('pos_detail_pembelian', $data);
            } else {
                $hasil = $cek->jml + $jml;
                $arr = [
                    'jml' => $hasil
                ];
                $this->db->where('invoice', $kode);
                $this->db->where('id_produk', $produk);
                $this->db->update('pos_detail_pembelian', $arr);
            }
        }
        redirect('Pembelian/add');
    }

    public function simpan_produk()
    {
        $id = $this->input->post('id');
        $total = $this->input->post('total');
        $ppn = $this->input->post('ppn');
        $grand = $this->input->post('grandtotal');
        $id_bb = $this->input->post('id_bb');

        $arr = [
            'total' => $total,
            'ppn' => $ppn,
            'grandtotal' => $grand,
            'status' => 'selesai'
        ];
        $this->db->where('invoice', $id);
        $this->db->update('pos_pembelian', $arr);

        $arr2 = [
            'status' => 'selesai'
        ];
        $this->db->where('invoice', $id);
        $this->db->update('pos_detail_pembelian', $arr2);

        $this->db->where('invoice', $id);
        $cek_invoice = $this->db->get('pos_detail_pembelian')->result();

        $where = [];
        $bb = [];
        foreach ($id_bb as $key => $value) {
            $where = array(
                'kode' => $value
            );
            // ambil stok akhir
            $this->db->where(['kode' => $value]);
            $jumlah = $this->db->get('waserda_produk')->row()->jml;

            $bb = array(
                'jml' => $jumlah + $cek_invoice[$key]->jml,
            );
            $this->db->where($where);
            $this->db->update('waserda_produk', $bb);
        }
 

        redirect('Pembelian');
    }

    // test
    public function hapus_detail($id)
    {
        $this->db->where('id', $id);
        $data = $this->db->delete('pos_detail_pembelian');

        if ($data) {
            echo json_encode($data);
        }
    }
}
?>