<?php
class M_Jadwal_Misa extends CI_Model
{
    function get_all_misa()
    {
        $result = $this->db->query("SELECT*FROM tbl_misa ORDER BY tanggal_ibadah ASC");
        return $result;
    }

    function add_misa($nama, $tanggal, $waktu, $keterangan)
    {
        $result = $this->db->query("INSERT INTO tbl_misa (nama_ibadah, tanggal_ibadah, waktu_ibadah, keterangan)
        VALUES ('$nama', '$tanggal', '$waktu', '$keterangan')");
        return $result;
    }

    function edit_misa($id, $nama, $tangal, $waktu, $keterangan)
    {
        $result = $this->db->query("UPDATE tbl_misa SET nama_ibadah = '$nama', tanggal_ibadah = '$tangal', waktu_ibadah = '$waktu', keterangan = '$keterangan' WHERE id = '$id'");
        return $result;
    }

    function delete_misa($id)
    {
        $result = $this->db->query("DELETE FROM tbl_misa WHERE id = '$id'");
        return $result;
    }
}