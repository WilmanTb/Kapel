<?php
class M_Petugas extends CI_Model
{
    function get_all_data()
    {
        $result = $this->db->query("SELECT 
        p.*,
        CASE 
            WHEN p.is_misa = 1 THEN m.nama_ibadah
            ELSE l.nama_ibadah
        END AS nama_ibadah,
        CASE 
            WHEN p.is_misa = 1 THEN m.tanggal_ibadah
            ELSE l.tanggal_ibadah
        END AS tanggal_ibadah,
        CASE 
            WHEN p.is_misa = 1 THEN m.waktu_ibadah
            ELSE l.waktu_ibadah
        END AS waktu_ibadah,
        CASE 
            WHEN p.is_fakultas = 1 THEN f.nama_fakultas
            ELSE y.name
        END AS nama_fakultas
    FROM 
        tbl_petugas_misa p
    LEFT JOIN 
        tbl_misa m ON p.id_kegiatan = m.id AND p.is_misa = 1 AND m.tanggal_ibadah > CURDATE()
    LEFT JOIN 
        tbl_jadwal_lainnya l ON p.id_kegiatan = l.id AND p.is_misa = 0 AND l.tanggal_ibadah > CURDATE()
    LEFT JOIN
        tbl_fakultas f ON p.id_petugas = f.id AND p.is_fakultas = 1
    LEFT JOIN
        tbl_lainnya y ON p.id_petugas = y.id AND p.is_fakultas = 0
    WHERE 
        (m.tanggal_ibadah > CURDATE())
        OR (l.tanggal_ibadah > CURDATE())
     ");
        return $result;
    }
}