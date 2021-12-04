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
            'total' => $this->produk->get_total_detail($inv)->row()->total, 
            'jenis_anggota' => $this->db->get('waserda_jenis_anggota')->result(), 
            'anggota' => $this->db->get('peternak')->result()
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
        $this->db->where('id_produk', $produk->kode);
        $cek = $this->db->get('pos_detail_penjualan')->row();
        // print_r($cek);exit;

        $this->db->where('status', 'dalam proses');
        $cek_penjualan = $this->db->get('pos_penjualan')->num_rows();

        if ($cek_penjualan == 0) {
            # code...
            $penjualan = [
                'invoice' => $invoice,
                'status' => 'dalam proses',
                'tanggal' => date('Y-m-d'),
            ];
            $this->db->insert('pos_penjualan', $penjualan);

            $data = [
                'invoice' => $invoice,
                'id_produk' => $produk->kode,
                'jml' => $qty,
                'harga' => $produk->harga_jual,
                'status' => 'dalam proses',
            ];
            $this->db->insert('pos_detail_penjualan', $data);
        } else {
            if ($cek->id_produk != $produk->kode) {
                # code...
                $data = [
                    'invoice' => $invoice,
                    'id_produk' => $produk->kode,
                    'jml' => $qty,
                    'harga' => $produk->harga_jual,
                    'status' => 'dalam proses',
                ];
                $this->db->insert('pos_detail_penjualan', $data);
                // var_dump('data baru');exit;

            } else {
                $hasil = $cek->jml + $qty;
                $arr = [
                    'jml' => $hasil
                ];
                $this->db->where('invoice', $invoice);
                $this->db->where('id_produk', $produk->kode);
                $this->db->update('pos_detail_penjualan', $arr);
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

    public function update_qty($kode, $invoice, $qty)
    {
        // $qty_update = $this->input->post('qty_update');
        // print_r($qty_update);exit;
        $arr = [
            'jml' => $qty
        ];
        $this->db->where('invoice', $invoice);
        $this->db->where('id_produk', $kode);
        $this->db->update('pos_detail_penjualan', $arr);

        echo json_encode('Sukses Update');
        // redirect('Kasir');
    }

    public function checkout()
    {
        $kode = $this->input->post('kode');
        $jenis = $this->input->post('jenis');
        $pembeli = $this->input->post('pembeli');
        $tipe = $this->input->post('tipe');
        $pembayaran = $this->input->post('pembayaran');
        $kembalian = $this->input->post('kembalian');
        $total = $this->input->post('total');
        $status = ($tipe == 'kredit') ? 'kredit' : 'terbayar';
        $data = [
            'total' => $total,
            'nama_pembeli' => $pembeli,
            'jenis_pembayaran' => $tipe,
            'kembalian' => $kembalian,
            'pembayaran' => $pembayaran,
            'id_detail_jenis_anggota' => $jenis,
            'status' => $status
        ];
        // print_r($data);exit;
        $this->db->where('invoice', $kode);
        $this->db->update('pos_penjualan', $data);

        $this->session->set_flashdata('notif', '<div class="alert alert-success">Pembayaran berhasil.</div>');

        redirect('Kasir');
    }

    public function jenis($tipe)
    {
        if ($tipe) {
            echo $this->produk->jenis_anggota($tipe);
        }
    }
}
?>