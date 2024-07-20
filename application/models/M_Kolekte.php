<?php

class M_Kolekte extends CI_Model
{
    function get_all_data()
    {
        $result = $this->db->query("SELECT 
        p.*,
        CASE 
            WHEN p.is_misa = 1 THEN m.nama_ibadah
            ELSE k.nama_ibadah
        END AS nama_ibadah,
        CASE 
            WHEN p.is_misa = 1 THEN m.tanggal_ibadah
            ELSE k.tanggal_ibadah
        END AS tanggal_ibadah
    FROM 
        tbl_kolekte p
    LEFT JOIN 
        tbl_misa m ON p.id_kegiatan = m.id AND p.is_misa = 1 AND m.tanggal_ibadah <= CURDATE()
    LEFT JOIN 
        tbl_jadwal_lainnya k ON p.id_kegiatan = k.id AND p.is_misa = 0 AND k.tanggal_ibadah <= CURDATE()
    WHERE 
        (m.tanggal_ibadah <= CURDATE())
        OR
        (k.tanggal_ibadah <= CURDATE())
     ");
        return $result;
    }

    function get_all_jadwal()
    {
        $query1 = $this->db->query("SELECT*FROM tbl_misa WHERE tanggal_ibadah <= CURDATE()");
        $misa = $query1->result_array();

        $query2 = $this->db->query("SELECT*FROM tbl_jadwal_lainnya WHERE tanggal_ibadah <= CURDATE()");
        $lainnya = $query2->result_array();

        $result = array_merge($misa, $lainnya);
        return $result;
    }

    function add_kolekte($id_kegiatan, $jlh_kolekte, $nama_ibadah)
    {
        $is_misa = "";
        $query = $this->db->query("SELECT*FROM tbl_misa WHERE id = '$id_kegiatan' AND nama_ibadah LIKE '%$nama_ibadah%'");
        $misa = $query->result_array();
        if($misa != null)
        {
            $is_misa = "1";
        } else {
            $is_misa = "0";
        }

        $result = $this->db->query("INSERT INTO tbl_kolekte (id_kegiatan, jlh_kolekte, is_misa)
                  VALUES ('$id_kegiatan', '$jlh_kolekte', '$is_misa')");

        return $result;   
    }

    function edit_kolekte($id_kegiatan, $jlh_kolekte)
    {
        $result = $this->db->query("UPDATE tbl_kolekte SET jlh_kolekte = '$jlh_kolekte' WHERE id = '$id_kegiatan'");
        return $result;
    }

    function delete_kolekte($id)
    {
        $result = $this->db->query("DELETE FROM tbl_kolekte WHERE id = '$id'");
        return $result;
    }

    function sum_kolekte()
    {
        $result = $this->db->query("SELECT SUM(jlh_kolekte) AS total_kolekte FROM tbl_kolekte;");
        return $result->row()->total_kolekte;
    }
}
