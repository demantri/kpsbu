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
}
?>