<?php
class M_fakultas extends CI_Model
{

    function get_all_fakultas($type)
    {
        $result = $this->db->query("SELECT F.*, U.pengguna_nama as nama_admin, COUNT(M.id_Fakultas) as total_mahasiswa 
        FROM tbl_fakultas F INNER JOIN tbl_pengguna U ON  U.pengguna_id = F.admin_fakultas 
        LEFT JOIN tbl_mahasiswa M ON M.id_fakultas = F.id WHERE F.is_fakultas = '$type' GROUP BY F.id");
        return $result;
    }

    function add_fakultas($nama, $admin, $isFakultas)
    {
        $result = $this->db->query("INSERT INTO tbl_fakultas(nama_fakultas, admin_fakultas, is_fakultas)
        VALUES ('$nama', '$admin', '$isFakultas')");
        return $result;
    }

    function edit_fakultas($id_fakultas, $nama_fakultas, $admin_fakultas)
    {
        $result = $this->db->query("UPDATE tbl_fakultas SET nama_fakultas = '$nama_fakultas', admin_fakultas = '$admin_fakultas' WHERE id = '$id_fakultas'");
        return $result;
    }

    function add_anggota($id, $nama)
    {
        $result = $this->db->query("INSERT INTO tbl_keanggotaan (nama, id_lainnya) VALUES ('$nama', '$id')");
        return $result;
    }

    function add_anggota_asrama($id, $id_mhs)
    {
        $result = $this->db->query("UPDATE tbl_mahasiswa SET lainnya = '$id' WHERE id = '$id_mhs'");
        return $result;
    }
}
