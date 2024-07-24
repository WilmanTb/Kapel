<?php

class M_Master_Data_Fakultas extends CI_Model
{
    function get_all_mahasiswa($id)
    {
        $id_fakultas = $this->get_id_fakultas($id);

        $result = $this->db->query("SELECT M.*, F.nama_fakultas, P.nama as nama_prodi 
        FROM tbl_mahasiswa M INNER JOIN tbl_fakultas F ON F.id = M.id_fakultas 
        INNER JOIN tbl_prodi P ON P.id = M.program_studi WHERE M.id_fakultas = '$id_fakultas'");
        return $result;
    }

    function get_all_prodi($id)
    {
        $id_fakultas = $this->get_id_fakultas($id);

        $result = $this->db->query("SELECT * FROM tbl_prodi WHERE id_fakultas = '$id_fakultas'");
        return $result;
    }

    function add_prodi($id_admin, $nama_prodi)
    {
        $id_fakultas = $this->get_id_fakultas($id_admin);

        $result = $this->db->query("INSERT INTO tbl_prodi (nama, id_fakultas) VALUES ('$nama_prodi', '$id_fakultas')");
        return $result;
    }

    function add_mahasiswa($id_admin, $nama_mhs, $id_prodi)
    {
        $id_fakultas = $this->get_id_fakultas($id_admin);

        $result = $this->db->query("INSERT INTO tbl_mahasiswa (nama, id_fakultas, program_studi) 
        VALUES ('$nama_mhs', '$id_fakultas', '$id_prodi')");

        return $result;
    }

    function edit_prodi($id_admin, $id_prodi, $nama_prodi)
    {
        $id_fakultas = $this->get_id_fakultas($id_admin);

        $result = $this->db->query("UPDATE tbl_prodi SET nama = '$nama_prodi' WHERE id = '$id_prodi' AND id_fakultas = '$id_fakultas'");
        return $result;
    }

    function edit_mahasiswa($id_mahasiswa, $nama, $id_prodi)
    {
        $result = $this->db->query("UPDATE tbl_mahasiswa SET nama = '$nama', program_studi = '$id_prodi' WHERE id = '$id_mahasiswa'");
        return $result;
    }

    function delete_prodi($id_prodi)
    {
        $result = $this->db->query("DELETE FROM tbl_prodi WHERE id = '$id_prodi'");
        return $result;
    }

    function delete_mahasiswa($id_mhs)
    {
        $result = $this->db->query("DELETE FROM tbl_mahasiswa WHERE id = '$id_mhs'");
        return $result;
    }

    function get_id_fakultas($id)
    {
        $query = $this->db->query("SELECT f.id as id_fakultas FROM tbl_fakultas f WHERE f.admin_fakultas = '$id'");
        $id_fakultas = $query->row()->id_fakultas;

        return $id_fakultas;
    }
}
