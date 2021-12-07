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

    public function getDetailPegawai($rfid)
    {
        // $month = date('m');
        // print_r($month);exit;
        $q = "SELECT a.rfid, tanggal, nama, COUNT(b.rfid) AS total
        FROM pegawai a
        JOIN detail_absen_rfid b ON a.rfid = b.rfid
        JOIN absensi c ON c.id = b.id_absensi
        WHERE MONTH(tanggal) = '11'
        AND keterangan LIKE '%Keluar%'
        AND a.rfid = '$rfid'
        GROUP BY b.rfid ";
        return $this->db->query($q);
    }

    public function detailPegawai()
    {
        $month = date('m');
        $q = "SELECT a.id, nip, npwp, a.rfid, nama, total, tanggal
        FROM pegawai a
        LEFT JOIN (
            SELECT COUNT(z.rfid) AS total, tanggal, z.rfid
            FROM detail_absen_rfid z
            JOIN pegawai x ON z.rfid = x.rfid
            LEFT JOIN absensi s ON s.id = z.id_absensi
            WHERE keterangan LIKE '%Masuk%'
            AND MONTH(tanggal) = '$month'
            GROUP BY z.rfid
        ) as b ON b.rfid = a.rfid
        ORDER BY nama ASC ";
        return $this->db->query($q);
    }
}
?>