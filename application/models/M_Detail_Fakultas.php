<?php

class M_Detail_Fakultas extends CI_Model
{
    function get_detail_fakultas($id)
    {
        $result = $this->db->query("SELECT M.*, F.nama_fakultas, P.nama as nama_prodi 
        FROM tbl_mahasiswa M INNER JOIN tbl_fakultas F ON F.id = M.id_fakultas 
        INNER JOIN tbl_prodi P ON P.id = M.program_studi WHERE M.id_fakultas = '$id'");
        return $result;
    }

    function get_all_prodi($id)
    {
        $result = $this->db->query("SELECT*FROM tbl_prodi WHERE id_fakultas = '$id'");
        return $result;
    }
    
    function add_mahasiswa($id, $nama, $prodi)
    {
        $result = $this->db->query("INSERT INTO tbl_mahasiswa(nama, id_fakultas, program_studi) VALUES ('$nama', '$id', '$prodi')");
        return $result;
    }

    function add_prodi($id, $nama)
    {
        $result = $this->db->query("INSERT INTO tbl_prodi(nama, id_fakultas) VALUES ('$nama', '$id')");
        return $result;
    }

    function edit_mahasiswa($id, $nama, $prodi)
    {
        $result = $this->db->query("UPDATE tbl_mahasiswa SET nama = '$nama', program_studi = '$prodi' WHERE id = '$id'");
        return $result;
    }

    function edit_prodi($id, $nama)
    {
        $result = $this->db->query("UPDATE tbl_prodi SET nama = '$nama' WHERE id = '$id'");
        return $result;
    }

    public function delete_mahasiswa($id)
    {
        $result = $this->db->query("DELETE FROM tbl_mahasiswa WHERE id = '$id'");
        return $result;
    }

    public function delete_prodi($id)
    {
        $result = $this->db->query("DELETE FROM tbl_prodi WHERE id = '$id'");
        return $result;
    }
}

