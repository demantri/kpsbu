<?php class Produk_model extends CI_Model
{
    public function get_produk()
    {
        $sql = "SELECT a.*, deskripsi, c.nama AS supplier 
        FROM waserda_produk a
        JOIN waserda_kategori b ON b.kode = a.id_kategori
        JOIN waserda_supplier c ON c.kode = a.id_supplier_produk
        ORDER BY id desc
        ";
        return $this->db->query($sql);
    }

    public function get_item($post)
    {
        $response = array();
        if ($post['search']) {
            # code...
            $this->db->select('*');
            $this->db->where('nama_produk like "%'.$post['search'].'%"');
            $record = $this->db->get('waserda_produk')->result();

            foreach ($record as $key => $value) {
                # code...
                $response[] = array(
                    "value" => $value->kode,
                    "label" => $value->nama_produk
                );
            }
        }
        return $response;
    }

    public function detail_pos($inv)
    {
        $q = "SELECT b.kode, b.barcode_id, b.nama_produk, a.invoice, sum(a.jml) AS jml, a.harga, a.status
        FROM pos_detail_penjualan a 
        JOIN waserda_produk b ON a.id_produk = b.kode
        WHERE invoice = '$inv' AND a.status = 'dalam proses' 
        GROUP BY kode
        ORDER BY a.id desc
        ";
        return $this->db->query($q);
    }

    public function get_total_detail($inv)
    {
        $sql = "SELECT SUM(a.jml * harga) AS total
        FROM pos_detail_penjualan a 
        JOIN waserda_produk b ON a.id_produk = b.kode
        WHERE invoice = '$inv' AND a.status = 'dalam proses' 
        -- GROUP BY kode
        ORDER BY a.id desc";
        return $this->db->query($sql);
    }
}
?>