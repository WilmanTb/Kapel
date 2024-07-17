<?php
class M_Petugas_Lainnya extends CI_Model
{
    function get_all_data()
    {
        $result = $this->db->query("SELECT 
        p.*,
        CASE 
            WHEN p.is_misa = 0 THEN m.nama_ibadah
        END AS nama_ibadah,
        CASE 
            WHEN p.is_misa = 0 THEN m.tanggal_ibadah
        END AS tanggal_ibadah,
        CASE 
            WHEN p.is_misa = 0 THEN m.waktu_ibadah
        END AS waktu_ibadah,
        CASE 
            WHEN p.is_fakultas = 1 THEN f.nama_fakultas
            ELSE y.name
        END AS nama_fakultas
    FROM 
        tbl_petugas_misa p
    LEFT JOIN 
        tbl_jadwal_lainnya m ON p.id_kegiatan = m.id AND p.is_misa = 0 AND m.tanggal_ibadah > CURDATE()
    LEFT JOIN
        tbl_fakultas f ON p.id_petugas = f.id AND p.is_fakultas = 1
    LEFT JOIN
        tbl_lainnya y ON p.id_petugas = y.id AND p.is_fakultas = 0
    WHERE 
        (m.tanggal_ibadah > CURDATE())
     ");
        return $result;
    }

    function get_all_jadwal_misa()
    {
        $query_misa = $this->db->query("SELECT * FROM tbl_jadwal_lainnya WHERE tanggal_ibadah > CURDATE()");
        $result_misa = $query_misa->result_array();
        return $result_misa;
    }

    function get_all_fakultas()
    {
        $query = $this->db->query("SELECT * FROM tbl_fakultas");
        return $query;
    }

    function get_all_lainnya()
    {
        $query = $this->db->query("SELECT * FROM tbl_lainnya");
        return $query;
    }

    function set_petugas($ibadah, $petugas, $is_fakultas, $is_misa)
    {
        $result = $this->db->query("INSERT INTO tbl_petugas_misa (id_kegiatan, id_petugas, is_fakultas, is_misa)
        VALUES ('$ibadah', '$petugas', '$is_fakultas', '$is_misa')");
        
        if($result)
        {
            $update = $this->db->query("UPDATE tbl_jadwal_lainnya SET is_set = '1' WHERE id = '$ibadah'");
            return $update;
        }
    }

    function edit_petugas($id, $petugas, $is_fakultas, $is_misa)
    {
        $result = $this->db->query("UPDATE tbl_petugas_misa SET id_petugas = '$petugas', is_fakultas = '$is_fakultas', is_misa = '$is_misa' WHERE id = '$id'");
        return $result;
    }

    function delete_petugas($id, $id_kegiatan)
    {
        $update = $this->db->query("UPDATE tbl_jadwal_lainnya SET is_set = '0' WHERE id = '$id_kegiatan'");

        if($update)
        {
            $delete = $this->db->query("DELETE FROM tbl_petugas_misa WHERE id = '$id'");
            return $delete;
        }
    }
}