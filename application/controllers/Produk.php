<?php class Produk extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model(array(
            'm_masterdata' => 'master',
            'crud_model' => 'crud',
            'Produk_model' => 'produk'
        ));
    }

    public function index()
    {
        $data = [
            'produk' => $this->produk->get_produk()->result(),
            'kode' => $this->master->kode_produk(),
            'kategori' => $this->db->get('waserda_kategori')->result(),
            'supplier' => $this->db->get('waserda_supplier')->result(),
        ];
        // print_r($data);exit;
        $this->template->load('template', 'waserda/produk/index', $data);
    }

    public function save()
    {
        $data = [
            'kode' => $this->input->post('kode'),
            'id_supplier_produk' => $this->input->post('supplier'),
            'id_kategori' => $this->input->post('kategori'),
            'nama_produk' => $this->input->post('produk'),
            'harga_satuan' => $this->input->post('harga'),
            'satuan_produk' => $this->input->post('satuan'),
        ];
        $this->crud->input_data($data, 'waserda_produk');
        $this->session->set_flashdata('notif', '<div class="alert alert-success">Data berhasil disimpan.</div>');
        redirect('Produk');
    }
}
?>