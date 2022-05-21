<?php class Profile extends CI_Controller
{
    public function index()
    {
        $name = $this->session->userdata('nama_lengkap');
        $this->db->where('nama', $name);
        $pegawai = $this->db->get('pegawai')->row();

        $nip = $this->session->userdata('nip');
        $this->db->where('id_pegawai', $nip);
        $lembur = $this->db->get('tb_lembur')->result();
        $data = [
            'user' => $pegawai,
            'lembur' => $lembur,
        ];
        $this->template->load('template', 'profile/index', $data);
    }
}
?>