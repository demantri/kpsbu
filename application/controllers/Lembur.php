<?php 
class Lembur extends CI_Controller
{
    public function index()
    {
        $id_pengajuan = $this->id_pengajuan();
        $lembur = $this->db->query("select a.*, b.nama from tb_lembur a join pegawai b on a.id_pegawai = b.nip")->result();
        $pgw = $this->db->query("select * from pegawai where status ='1'")->result();
        $data = [
            'kode' => $id_pengajuan,
            'lembur' => $lembur,
            'pegawai' => $pgw,
        ];
        $this->template->load('template', 'pengajuan/hrd/pengajuan_lembur/index', $data);
    }

    public function save()
    {
        $id_pengajuan = $this->input->post('id_pengajuan');
        $tgl = $this->input->post('tgl');
        $nama = $this->input->post('nama');
        $jam = $this->input->post('jam');

        $perjam = 20000;
        $total_nominal_lembur = $perjam * $jam;

        $data = [
            'id_pengajuan' => $id_pengajuan,
            'tgl_pengajuan' => $tgl,
            'id_pegawai' => $nama,
            'total_jam' => $jam,
            'nominal_perjam' => $perjam,
            'total_nominal_lembur' => $total_nominal_lembur,
        ];

        $this->db->insert('tb_lembur', $data);

        redirect('Lembur');
    }

    public function id_pengajuan()
    {
        $query1   = "SELECT MAX(RIGHT(id_pengajuan,3)) as kode FROM tb_lembur";
        $abc      = $this->db->query($query1);
        $kode = "";
        if ($abc->num_rows() > 0) {
            foreach ($abc->result() as $k) {
                $tmp = ((int) $k->kode) + 1;
                $kd  = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        $kode   = "LMBR".date('Ymd').$kd;
        return $kode;
    }
}
?>