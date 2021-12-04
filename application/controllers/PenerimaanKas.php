<?php 
class PenerimaanKas extends CI_Controller
{
    public function view_penerimaan_kas()
    {  
        $text = "INI PUNYA SALMA";
        $judul = "INI JUDUL";
        $pegawai = $this->db->get('pegawai')->result();
        $data = [
            'data' => $text,
            'x' => $judul,
            'pegawai' => $pegawai
        ];
        // print_r($pegawai);exit;
        $this->template->load('template', 'penerimaan_kas/index', $data);
    }
}
?>