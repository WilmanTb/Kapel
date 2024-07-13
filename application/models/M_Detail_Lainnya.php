<?php

class M_Detail_Lainnya extends CI_Model
{

    function get_detail_lainnya($id)
    {
        $query = $this->db->query("SELECT L.name as nama FROM tbl_lainnya L WHERE L.id = '$id'");
        $result_query = $query->row();

        if (strtolower($result_query->nama) == "asrama") {
            return $this->get_detail_asrama($id);
        } else {
            $result = $this->db->query("SELECT M.*, F.name as nama_keanggotaan
                    FROM tbl_keanggotaan M INNER JOIN tbl_lainnya F ON F.id = M.id_lainnya 
                    WHERE M.id_lainnya = '$id'");
            return $result;
        }
    }

    function get_detail_asrama($id)
    {
        $result = $this->db->query("SELECT M.*, F.name as nama_keanggotaan
        FROM tbl_mahasiswa M INNER JOIN tbl_lainnya F ON F.id = M.lainnya
        WHERE M.lainnya = '$id'");
        return $result;
    }

    function add_anggota($id, $nama, $id_mhs)
    {
        $query = $this->db->query("SELECT L.name as nama FROM tbl_lainnya L WHERE L.id = '$id'");
        $result_query = $query->row();

        if (strtolower($result_query->nama) == "asrama") {
            return $this->add_anggota_mhs($id, $id_mhs);
        } else {
            $result = $this->db->query("INSERT INTO tbl_keanggotaan (nama, id_lainnya) VALUES ('$nama', '$id')");
            return $result;
        }
    }

    function add_anggota_mhs($id, $id_mhs)
    {
        $result = $this->db->query("UPDATE tbl_mahasiswa SET lainnya = '$id' WHERE id = '$id_mhs'");
        return $result;
    }

    function edit_anggota($id, $id_anggota, $nama)
    {
        $result = $this->db->query("UPDATE tbl_keanggotaan SET nama = '$nama' WHERE id = '$id_anggota' AND id_lainnya = '$id'");
        return $result;
    }

    function delete_anggota($id, $id_anggota, $nama_anggota)
    {
        $query = $this->db->query("SELECT*FROM tbl_keanggotaan WHERE id = '$id_anggota' AND nama = '$nama_anggota'");
        $result = $query->row();

        if($result && $result->num_row > 0)
        {
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
