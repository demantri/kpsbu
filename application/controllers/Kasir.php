<?php class Kasir extends CI_Controller
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
        $user = $this->session->nama_lengkap;
        // print_r($user);exit;
        $inv = $this->master->invoice();
        $data = [
            'kode' => $inv,
            'user' => $user, 
            'produk' => $this->db->get('waserda_produk')->result(),
            'detail' => $this->produk->detail_pos($inv)->result(),
            'total' => $this->produk->get_total_detail($inv)->row()->total
        ];
        // print_r($data['total']);exit;
        $this->template->load('template', 'kasir/index', $data);
    }

    public function add($barcode)
    {
        # code...
        $produk = $this->db->query("SELECT * FROM waserda_produk WHERE barcode_id = '$barcode'")->row();
        echo json_encode($produk);
    }

    public function list()
    {
        # code...
        // $data = "SELECT nama_peternak  FROM peternak";
        // $result = $this->db->query($data)->result();
        // echo json_encode($result);
        // // echo json_encode($result);

        $post = $this->input->post();
        $data = $this->produk->get_item($post);
        echo json_encode($data);
    }

    public function add_detail()
    {
        $invoice = $this->input->post('invoice');
        $barang = $this->input->post('barang');
        $qty = $this->input->post('qty');

        if (is_numeric($barang)) {
            # code...
            $produk = $this->db->query("SELECT * FROM waserda_produk WHERE barcode_id = '$barang' ")->row();

            if(empty($produk->barcode_id)) 
            {
                $info = [
                    'status' => false,
                    'info' => 'Barcode tidak terdaftar',
                ];
            }
        } else {
            # code...
            $produk = $this->db->query("SELECT * FROM waserda_produk WHERE nama_produk = '$barang' ")->row();

        }

        $this->db->where('invoice', $invoice);
        $cek = $this->db->get('pos_detail_penjualan')->num_rows();

        // $data = [
        //     'invoice' => $invoice,
        //     'id_produk' => $produk->kode,
        //     'jml' => $qty,
        //     'harga' => $produk->harga_jual,
        //     'status' => 'dalam proses',
        // ];
        // $this->db->insert('pos_detail_penjualan', $data);

        // if ($cek > 0) {
        //     # code...
        //     $this->db->set('jml', + $qty);
        //     $this->db->where('invoice', $invoice);
        //     $this->db->where('id_produk', $produk->id_produk);
        //     $this->db->update('pos_detail_penjualan');
        // } else {
        //     $data = [
        //         'invoice' => $invoice,
        //         'id_produk' => $produk->kode,
        //         'jml' => $qty,
        //         'harga' => $produk->harga_jual,
        //         'status' => 'dalam proses',
        //     ];
        //     $this->db->insert('pos_detail_penjualan', $data);
        // }
        if ($cek == 0) {
            # code...
            $data = [
                'invoice' => $invoice,
                'id_produk' => $produk->kode,
                'jml' => $qty,
                'harga' => $produk->harga_jual,
                'status' => 'dalam proses',
            ];
            $this->db->insert('pos_detail_penjualan', $data);
        } else {
            if ($produk->kode) {
                # code...
                $this->db->set('jml', 'jml+1', FALSE);
                $this->db->where('invoice', $invoice);
                $this->db->where('id_produk', $produk->id_produk);
                $this->db->insert('pos_detail_penjualan');
                // var_dump($qty);exit;
            }
        }
        $this->session->set_flashdata('notif', '<div class="alert alert-success">Data berhasil ditambahkan.</div>');
        
        redirect('Kasir');
        
        // print_r($data);exit;
    }

    public function detail_barcode($qty, $invoice, $barcode)
    {
        $produk = $this->db->query("SELECT * FROM waserda_produk WHERE barcode_id = '$barcode' ")->row();

        if ($produk) {
            # code...
            $data = [
                'invoice' => $invoice,
                'id_produk' => $produk->kode,
                'jml' => $qty,
                'harga' => $produk->harga_jual,
                'status' => 'dalam proses',
            ];
            if ($this->db->insert('pos_detail_penjualan', $data)) {
                # code...
                $result = [
                    'status' => true, 
                    'info'   => 'Berhasil disimpan.'
                ];
            } else {
                # code...
                $result = [
                    'status' => true, 
                    'info'   => 'Gagal disimpan.'
                ];
            }
        } else {
            # code...
            $result = [
                'status' => false, 
                'info'   => 'No Barcode Recoreded'
            ];
        }
        echo json_encode($result);
    }

    public function update_qty($kode, $invoice)
    {
        $qty_update = $this->input->post('qty_update');
        $data = [
            'jml' => $qty_update
        ];

        $where = [
            'invoice' => $invoice,
            'id_produk' => $kode
        ];
    }
}
?>