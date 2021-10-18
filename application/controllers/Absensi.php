<?php class Absensi extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Absensi_model');
    }
    public function index()
    {
        $this->template->load('template', 'absensi/index');
    }

    public function save($rfid)
    {
        // $id = $rfid;
        // $p = "SELECT * FROM pegawai WHERE rfid = '$rfid' ";
        $peg = $this->db->query("SELECT * FROM pegawai WHERE rfid = '$rfid'")->row();
        if ($peg) {
            # code...
            $id_absensi = $this->Absensi_model->absensiID();

            $q = "SELECT COUNT(*) AS jml FROM detail_absen_rfid WHERE id_absensi = '$id_absensi' AND rfid = '$rfid'";

            $jml_absen = $this->db->query($q)->row();

            if ($jml_absen->jml < 2) {
                # code...
                $status = ($jml_absen->jml > 0) ? "Presensi Keluar" : "Presensi Masuk";
                $data = array(
                    'id_absensi' => $id_absensi,
                    'status' => 'Masuk',
                    'rfid' => $rfid,
                    'jam' => date("H:i:s"),
                    'keterangan' => $status
                );
                if($this->db->insert('detail_absen_rfid', $data)){
                    $absen = array(
                        'status' => true,
                        'info' => 'Berhasil Melakukan Presensi'
                    );
                }else{
                    $absen = array(
                        'status' => false,
                        'info' => 'Gagal Melakukan Absensi.'
                    );
                }
            } else {
                $absen = array(
                    'status' => false,
                    'info' => 'Sudah melakukan absensi.'
                );
            }
        } else {
            # code...
            $absen = array(
                'status' => false,
                'info' => 'Shift dan rfid tidak terdaftar'
            );
        }
        echo json_encode($absen);
    }
}
?>