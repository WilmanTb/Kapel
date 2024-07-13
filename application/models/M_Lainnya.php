<?php

class M_Lainnya extends CI_Model
{
    public function get_all_lainnya()
    {
        $result = $this->db->query("SELECT L.*, P.pengguna_nama as nama_admin FROM tbl_lainnya L 
        INNER JOIN tbl_pengguna P ON P.pengguna_id = L.admin ORDER BY L.id ASC");
        return $result;
    }

    public function add_lainnya($nama, $admin)
    {
        $result = $this->db->query("INSERT INTO tbl_lainnya (name, admin) VALUES ('$nama', '$admin')");
        return $result;
    }

    public function edit_lainnya($id, $nama, $admin)
    {
        $result = $this->db->query("UPDATE tbl_lainnya SET name = '$nama', admin = '$admin' WHERE id = '$id'");
        return $result;
    }

    public function delete_lainnya($id)
    {
        $result = $this->db->query("DELETE FROM tbl_lainnya WHERE id = '$id'");
        return $result;
    }
}