<?php class Absensi_model extends CI_Model
{
    public function cekRfid($rfid)
    {
        $this->db->where('rfid', $rfid);
        $q = $this->db->get('pegawai');
        if(count($q->result()) <= 0){
            return false;
        }else{
            return true;
        }
    }

    public function absensiID(){
        $tgl = date('Y-m-d');
        $this->db->where('tanggal', $tgl);
        $absensi = $this->db->get('absensi');
        // $absensi = $this->db->get($this->absensi);
        if(count( $absensi->result() ) <= 0){
            $data = array(
                'tanggal' => $tgl
            );
            $this->db->insert('absensi',$data);
            $insertID = $this->db->insert_id();
        }else{
            $insertID = $absensi->row()->id;
        }
        return $insertID;
    }

    public function cekAbsensi($rfid){
        // return false if already tap
        // return true if hasnt tap rfid

        $this->db->join('detail_absensi_rfid','detail_absensi_rfid.id_absensi = absensi.id_absensi');
        $this->db->where('rfid',$rfid);
        $this->db->where('tanggal',date('Y-m-d'));
        $q = $this->db->Get('absensi');
        if(count($q->result()) <= 0){

            // belum absen
            return true;
        }else{

            // sudah absen
            return false;
        }
    }
}
?>