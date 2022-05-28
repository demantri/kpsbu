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

        $this->db->where('nm_pegawai', $name);
        $penggajian = $this->db->get('tb_penggajian')->result();
        $data = [
            'user' => $pegawai,
            'lembur' => $lembur,
            'penggajian' => $penggajian,
        ];
        $this->template->load('template', 'profile/index', $data);
    }

    public function slipgaji($nama_pegawai, $id_gaji)
    {
        $query = $this->db->query("SELECT b.*, a.nm_pegawai, a.tanggal, c.nip
        FROM tb_penggajian a
        JOIN tb_detail_penggajian b ON a.id_penggajian = b.id_penggajian
        JOIN pegawai c on a.nm_pegawai = c.nama
        WHERE nm_pegawai = '$nama_pegawai'
        AND b.id_penggajian = '$id_gaji'
        AND LEFT(tanggal, 7) = left(sysdate(),7)")->row();
        $data = [
            'pegawai' => $query
        ];
        $this->load->library('pdf');
        $this->pdf->setPaper('a4', 'potrait');
        $this->pdf->filename = "slip-gaji.pdf";
        $this->pdf->load_view('profile/slipgaji_pdf', $data);
    }
}
?>