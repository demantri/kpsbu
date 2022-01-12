<?php 
class Penggajian extends CI_Controller
{
    public function index()
    {
        $pegawai = $this->Absensi_model->detailPegawai()->result();
        $data = [
            'pegawai' => $pegawai,
        ];
        $this->template->load('template', 'penggajian/index', $data);
    }

    public function slip_gaji($nip)
    {
        $this->db->where('nip', $nip);
        $peg = $this->db->get('pegawai')->row();
        $detilPeg = $this->Absensi_model->getDetailPegawai($nip)->row();
        // print_r($peg);exit;
        $q = "SELECT a.*, gaji_pokok, tunjangan_jabatan, tunjangan_kesehatan, b.desc, b.nominal
        FROM pegawai a
        LEFT JOIN tb_jenis_pegawai c ON c.desc = a.id_jenis_pegawai
        LEFT JOIN tb_jabatan d ON d.desc = a.id_jabatan
        LEFT JOIN tb_ptkp b ON a.id_ptkp = b.desc
        WHERE nip = '$nip'
        ORDER BY a.id ASC
        ";
        $result = $this->db->query($q)->result();
        foreach ($result as $data) {
            $ptkp1 = $data->nominal;
            $tambah = $data->gaji_pokok + $data->tunjangan_jabatan + $data->tunjangan_kesehatan;
            $pengurang = (5/100 * $tambah);
            $penghasilan_perbulan = ($tambah - $pengurang);

            $atuatu = 50000000/12;
            $duadua = 250000000/12;
            $tigatiga = 500000000/12;

            if($penghasilan_perbulan > $ptkp1){
                $hasilptkp = $penghasilan_perbulan - $ptkp1;
                if($hasilptkp < $atuatu){
                    $satu = $hasilptkp * 5/100;
                    $akhir = round($satu);
                }
                elseif($hasilptkp > $atuatu AND $hasilptkp < $duadua){
                    $satu = $atuatu *5/100;
                    $dua = ($hasilptkp - $atuatu) * 15/100;
                    $akhir = round($satu + $dua);
                }
                elseif($hasilptkp > $duadua AND $hasilptkp < $tigatiga){
                    $satu = $atuatu *5/100;
                    $dua = $duadua * 15/100;
                    $tiga = ($hasilptkp - $atuatu - $duadua) * 25/100;
                    $akhir = round($satu + $dua + $tiga);
                }
                else{
                    $satu = $atuatu *5/100;
                    $dua = $duadua * 15/100;
                    $tiga = $tigatiga * 25/100;
                    $empat = ($hasilptkp - $satu - $dua - $tiga) * 30/100;
                    $akhir = round($satu + $dua + $tiga + $empat);
                }
            }else{
                $akhir = 0;
            }
            $hasil_ptkp = $akhir;
            
            $bonus = 0;
            $lembur = 0;
            $total = ($tambah + $bonus + $lembur) - ($hasil_ptkp);
            $data = [
                'peg' => $peg,
                'detil' => $detilPeg,
                'ptkp' => $hasil_ptkp,
                'detail2' => $result,
                'total' => $total,
            ];
            $this->template->load('template', 'penggajian/sip_gaji', $data);
        }
    }

    public function bayar_gaji($nip, $total, $tanggal)
    {
        $id_gaji = $this->Absensi_model->id_gaji();
        $this->db->where('nip', $nip);
        $pegawai = $this->db->get('pegawai')->row();
        
        $tb_penggajian = [
            'id_penggajian' => $id_gaji,
            'tanggal' => date('Y-m-d'),
            'nm_pegawai' => $pegawai->nama,
            'nominal' => $total,
        ];
        // print_r($tb_penggajian);exit;
        $this->db->insert('tb_penggajian', $tb_penggajian);

        // kirim ke db pengajuan jurnal 
        $pengajuan = [
            'kode' => $id_gaji,
            'tanggal' => $tanggal,
            'nominal' => $total,
            'jenis' => 'penggajian',
        ];
        $this->db->insert("pengajuan_jurnal", $pengajuan);

        // $debit = [
        //     'id_jurnal' => $id_gaji,
        //     'tgl_jurnal' => date('Y-m-d'),
        //     'no_coa' => 5311,
        //     'posisi_dr_cr' => 'd',
        //     'nominal' => $total,
        // ];
        // $this->db->insert('jurnal', $debit);

        // $kredit = [
        //     'id_jurnal' => $id_gaji,
        //     'tgl_jurnal' => date('Y-m-d'),
        //     'no_coa' => 1111,
        //     'posisi_dr_cr' => 'k',
        //     'nominal' => $total,
        // ];
        // $this->db->insert('jurnal', $kredit);

        redirect('Penggajian');
    }

    public function laporan_penggajian()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $periode = $tahun.'-'.$bulan;
        if ($periode) {
            $list = $this->db->query("select * from tb_penggajian where LEFT(tanggal, 7) = '$periode' order by tanggal asc")->result();
            $data = [
                'list' => $list,
            ];
            $this->template->load('template', 'penggajian/laporan_penggajian', $data);
        } else {
            $list = $this->db->query("select * from tb_penggajian where LEFT(tanggal, 7) = '$periode' order by tanggal asc")->result();
            $data = [
                'list' => $list,
            ];
            $this->template->load('template', 'penggajian/laporan_penggajian', $data);
        }
        
    }
}
?>