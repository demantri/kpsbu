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
        // print_r($total);exit;
        $data = [
            'kode' => $inv,
            'supplier' => $supplier,
            'detail' => $detail,
            'total' => $total,
            'ppn' => $ppn,
            'grandtotal' => $grand,
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
            if ($cek->id_produk != $produk) {
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

    public function simpan_produk($total, $ppn, $grand, $id)
    {
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

        // $this->db->where('invoice', $id);
        // $cek_detail = $this->db->get('pos_detail_pembelian')->result();
        // print_r($cek_detail);exit;

        // $res = [];
        // for ($i=0; $i < count($cek_detail); $i++) { 
        //     # code...
        //     $res[] = array(
        //         'jml' => $cek_detail[$i]
        //     );
        // }
        // $this->db->update_batch('waserda_produk', $res); 

        redirect('Pembelian');
    }
}
?>