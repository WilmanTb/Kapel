<?php
class M_Jadwal_Lainnya extends CI_Model
{
    function get_all_misa()
    {
        $result = $this->db->query("SELECT*FROM tbl_jadwal_lainnya ORDER BY tanggal_ibadah ASC");
        return $result;
    }

    function add_misa($nama, $tanggal, $waktu, $keterangan)
    {
        $result = $this->db->query("INSERT INTO tbl_jadwal_lainnya (nama_ibadah, tanggal_ibadah, waktu_ibadah, keterangan)
        VALUES ('$nama', '$tanggal', '$waktu', '$keterangan')");
        return $result;
    }

    function edit_misa($id, $nama, $tangal, $waktu, $keterangan)
    {
        $result = $this->db->query("UPDATE tbl_jadwal_lainnya SET nama_ibadah = '$nama', tanggal_ibadah = '$tangal', waktu_ibadah = '$waktu', keterangan = '$keterangan' WHERE id = '$id'");
        return $result;
    }

    function delete_misa($id)
    {
        $result = $this->db->query("DELETE FROM tbl_jadwal_lainnya WHERE id = '$id'");
        return $result;
    }
}