<?php

class M_Dashboard_Adm_Fakultas extends CI_Model
{
    function jadwal_bertugas()
    {
        $id_admin = $this->session->userdata('idadmin');
        $result = $this->db->query(
            "SELECT f.nama_fakultas, p.is_misa, p.id_kegiatan, p.is_fakultas,
            CASE WHEN p.is_misa = 1 
                    THEN (SELECT M.nama_ibadah FROM tbl_misa M WHERE M.id = p.id_kegiatan  AND M.tanggal_ibadah > CURRENT_DATE())
                    ELSE (SELECT JL.nama_ibadah FROM tbl_jadwal_lainnya JL WHERE JL.id = p.id_kegiatan AND JL.tanggal_ibadah > CURRENT_DATE())
                END as Ibadah,
                
             CASE WHEN p.is_misa = 1 
                    THEN (SELECT M.tanggal_ibadah FROM tbl_misa M WHERE M.id = p.id_kegiatan  AND M.tanggal_ibadah > CURRENT_DATE())
                    ELSE (SELECT JL.tanggal_ibadah FROM tbl_jadwal_lainnya JL WHERE JL.id = p.id_kegiatan AND JL.tanggal_ibadah > CURRENT_DATE())
                END as Tanggal_Ibadah
               
            from tbl_fakultas f
            inner join tbl_petugas_misa p on p.id_petugas = f.id
            where f.admin_fakultas = '$id_admin' AND p.is_fakultas = 1
        "
        );
        return $result;
    }

    function get_fakultas()
    {
        $id_admin = $this->session->userdata('idadmin');
        // $this->db->where('admin_fakultas', $id_admin);
        // $this->db->select('*'); // or specify the columns you want to select, e.g., 'column1, column2'

        // $query = $this->db->get('tbl_fakultas'); // specify the table name here
        // $result = $query->result();

        // return $result;

        $result = $this->db->query("SELECT*FROM tbl_fakultas WHERE admin_fakultas = '$id_admin'");
        return $result;
    }
}
