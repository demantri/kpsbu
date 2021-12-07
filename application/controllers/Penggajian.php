<?php 
class Penggajian extends CI_Controller
{
    public function index()
    {
        // $pegawai = $this->db->get('pegawai')->result();
        $pegawai = $this->Absensi_model->detailPegawai()->result();
        $data = [
            'pegawai' => $pegawai,
        ];
        $this->template->load('template', 'penggajian/index', $data);
    }
}
?>