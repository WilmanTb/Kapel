<?php

class M_Master_Data_Lainnya extends CI_Model
{
    function get_all_mahasiswa($id)
    {
        $data = $this->get_id_fakultas($id);

        $lainnya = explode("_", $data);

        $id_lainnya = $lainnya[0];
        $nama_lainnya = $lainnya[1];
        
        if (strpos(strtolower($nama_lainnya), "asrama") !== false) {
            $result = $this->db->query("SELECT M.*, F.name as nama_lainnya
                    FROM tbl_mahasiswa M
                    INNER JOIN tbl_lainnya F ON F.id = M.lainnya
                    WHERE M.lainnya = '$id_lainnya'");
            return $result;
        }

        $result = $this->db->query("SELECT M.*, F.name as nama_lainnya
        FROM tbl_keanggotaan M INNER JOIN tbl_lainnya F ON F.id = M.id_lainnya WHERE M.id_lainnya = '$id_lainnya'");
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

    public function delete_prodi($id_prodi)
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
        $query = $this->db->query("SELECT f.id as id_lainnya, f.name as nama_lainnya FROM tbl_lainnya f WHERE f.admin = '$id'");
        $nama_lainnya = $query->row()->nama_lainnya;
        $id_fakultas = $query->row()->id_lainnya;

        $result = $id_fakultas . "_" . $nama_lainnya;

        return $result;
    }

    function add_anggota_mhs($id,$id_mhs)
    {
        $result = $this->db->query("UPDATE tbl_mahasiswa SET lainnya = '$id' WHERE id = '$id_mhs'");
        return $result;
    }

    function add_anggota($id, $nama_anggota,$info)
    {
        $result = $this->db->query("INSERT INTO tbl_keanggotaan (nama, id_lainnya) VALUES ('$nama_anggota', '$id')");
        return $result;
    }

    function edit_anggota($id_anggota, $nama_anggota)
    {
        $result = $this->db->query("UPDATE tbl_keanggotaan SET nama = '$nama_anggota' WHERE id = '$id_anggota'");
        return $result;
    }

    function delete_anggota($id, $id_anggota, $nama_anggota)
    {
        $query = $this->db->query("SELECT*FROM tbl_keanggotaan WHERE id = '$id_anggota' AND nama = '$nama_anggota'");
        $result = $query->row();

        if ($result) {
            $newQ = $this->db->query("DELETE FROM tbl_keanggotaan WHERE id = '$id_anggota' AND nama = '$nama_anggota'");
            return $newQ;
        } else {
            return $this->delete_anggota_asrama($id, $id_anggota);
        }
        // return $result;
    }

    function delete_anggota_asrama($id, $id_mhs)
    {
        $result = $this->db->query("UPDATE tbl_mahasiswa SET lainnya = NULL WHERE id = '$id_mhs' AND lainnya = '$id' ");
        return $result;
    }
}