<?php class Profile extends CI_Controller
{
    public function index()
    {
        $name = $this->session->userdata('nama_lengkap');
        $this->db->where('nama', $name);
        $pegawai = $this->db->get('pegawai')->row();
        // print_r($pegawai);exit;
        $data = [
            'user' => $pegawai, 
        ];
        $this->template->load('template', 'profile/index', $data);
    }
}
?>