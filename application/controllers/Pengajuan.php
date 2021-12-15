<?php class Pengajuan extends CI_Controller
{
    public function index()
    {
        // $this->db->where('jml >', 0);
        $barang = $this->db->get('waserda_produk')->result();
        $list = $this->db->get('waserda_pengajuan_barang')->result();
        $data = [
            'barang' => $barang,
            'list' => $list,
        ];
        $this->template->load('template', 'pengajuan/index', $data);
    }

    public function save()
    {
        $tgl_pengajuan = date('Y-m-d H:i:s', strtotime($this->input->post('tgl')));
        $nama = $this->input->post('nama');
        $jumlah = $this->input->post('jumlah');
        $desc = $this->input->post('desc');

        $data = [
            'tanggal_pengajuan' => $tgl_pengajuan,
            'nama_barang' => $nama,
            'jumlah' => $jumlah,
            'deskripsi' => $desc,
        ];
        // print_r($data);exit;
        $this->db->insert('waserda_pengajuan_barang', $data);

        redirect('Pengajuan');
    }

    public function action($action, $id)
    {
        if ($action == 'acc') {
            # code...
            $data = [
                'status' => 'Approved'
            ];
        } else {
            $data = [
                'status' => 'Refused'
            ];
        }
        $this->db->where('id', $id);
        $data = $this->db->update('waserda_pengajuan_barang', $data);

        if ($data) {
            # code...
            echo json_encode($data);
        }
    }
}
?>