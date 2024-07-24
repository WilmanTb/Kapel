<?php

class M_Petugas_Misa extends CI_Model
{
    function get_jadwal_misa($id_admin)
    {
        $id_fakultas = $this->get_id_fakultas($id_admin);

        $result = $this->db->query("SELECT p.* ,
        CASE WHEN p.is_misa = 1 
            THEN (SELECT M.nama_ibadah FROM tbl_misa M WHERE M.id = p.id_kegiatan  AND M.tanggal_ibadah > CURRENT_DATE())
            -- ELSE (SELECT JL.nama_ibadah FROM tbl_jadwal_lainnya JL WHERE JL.id = p.id_kegiatan AND JL.tanggal_ibadah > CURRENT_DATE())
        END as Ibadah,
    
        CASE WHEN p.is_misa = 1 
            THEN (SELECT M.tanggal_ibadah FROM tbl_misa M WHERE M.id = p.id_kegiatan  AND M.tanggal_ibadah > CURRENT_DATE())
            -- ELSE (SELECT JL.tanggal_ibadah FROM tbl_jadwal_lainnya JL WHERE JL.id = p.id_kegiatan AND JL.tanggal_ibadah > CURRENT_DATE())
        END as Tanggal_Ibadah,

        CASE WHEN p.is_misa = 1 
            THEN (SELECT M.waktu_ibadah FROM tbl_misa M WHERE M.id = p.id_kegiatan  AND M.tanggal_ibadah > CURRENT_DATE())
            -- ELSE (SELECT JL.waktu_ibadah FROM tbl_jadwal_lainnya JL WHERE JL.id = p.id_kegiatan AND JL.tanggal_ibadah > CURRENT_DATE())
        END as Waktu_Ibadah,

        CASE WHEN p.is_misa = 1 
            THEN (SELECT M.keterangan FROM tbl_misa M WHERE M.id = p.id_kegiatan  AND M.tanggal_ibadah > CURRENT_DATE())
            -- ELSE (SELECT JL.keterangan FROM tbl_jadwal_lainnya JL WHERE JL.id = p.id_kegiatan AND JL.tanggal_ibadah > CURRENT_DATE())
        END as Keterangan
        
        FROM tbl_petugas_misa p
        WHERE p.id_petugas = '$id_fakultas' AND p.is_fakultas = 1");

        if ($result)
        {
            return $result;
        }

    }

    function get_petugas_misa($id_admin)
    {
        $id_fakultas = $this->get_id_fakultas($id_admin);

        $result = $this->db->query("SELECT p.* ,
        CASE WHEN p.is_misa = 1 
            THEN (SELECT M.nama_ibadah FROM tbl_misa M WHERE M.id = p.id_kegiatan  AND M.tanggal_ibadah > CURRENT_DATE())
            -- ELSE (SELECT JL.nama_ibadah FROM tbl_jadwal_lainnya JL WHERE JL.id = p.id_kegiatan AND JL.tanggal_ibadah > CURRENT_DATE())
        END as Ibadah,
    
        CASE WHEN p.is_misa = 1 
            THEN (SELECT M.tanggal_ibadah FROM tbl_misa M WHERE M.id = p.id_kegiatan  AND M.tanggal_ibadah > CURRENT_DATE())
            -- ELSE (SELECT JL.tanggal_ibadah FROM tbl_jadwal_lainnya JL WHERE JL.id = p.id_kegiatan AND JL.tanggal_ibadah > CURRENT_DATE())
        END as Tanggal_Ibadah,

        CASE WHEN p.is_misa = 1 
            THEN (SELECT M.waktu_ibadah FROM tbl_misa M WHERE M.id = p.id_kegiatan  AND M.tanggal_ibadah > CURRENT_DATE())
            -- ELSE (SELECT JL.waktu_ibadah FROM tbl_jadwal_lainnya JL WHERE JL.id = p.id_kegiatan AND JL.tanggal_ibadah > CURRENT_DATE())
        END as Waktu_Ibadah,

        CASE WHEN p.is_misa = 1 
            THEN (SELECT M.keterangan FROM tbl_misa M WHERE M.id = p.id_kegiatan  AND M.tanggal_ibadah > CURRENT_DATE())
            -- ELSE (SELECT JL.keterangan FROM tbl_jadwal_lainnya JL WHERE JL.id = p.id_kegiatan AND JL.tanggal_ibadah > CURRENT_DATE())
        END as Keterangan,
        
        CASE WHEN p.is_misa = 1 
            THEN (SELECT RP.id FROM tbl_misa M LEFT JOIN tbl_role_petugas RP On RP.id_ibadah = M.id WHERE M.id = p.id_kegiatan  AND M.tanggal_ibadah > CURRENT_DATE())
            ELSE ''
        END as Role,

        CASE WHEN p.is_misa = 1 
            THEN (SELECT MHS.nama FROM tbl_misa M LEFT JOIN tbl_role_petugas RP On RP.id_ibadah = M.id LEFT JOIN tbl_mahasiswa MHS ON RP.bacaan = MHS.id WHERE M.id = p.id_kegiatan  AND M.tanggal_ibadah > CURRENT_DATE())
            ELSE ''
        END as Bacaan,

        CASE WHEN p.is_misa = 1 
            THEN (SELECT MHS.nama FROM tbl_misa M LEFT JOIN tbl_role_petugas RP On RP.id_ibadah = M.id LEFT JOIN tbl_mahasiswa MHS ON RP.mazmur = MHS.id WHERE M.id = p.id_kegiatan  AND M.tanggal_ibadah > CURRENT_DATE())
            ELSE ''
        END as Mazmur,

        CASE WHEN p.is_misa = 1 
            THEN (SELECT MHS.nama FROM tbl_misa M LEFT JOIN tbl_role_petugas RP On RP.id_ibadah = M.id LEFT JOIN tbl_mahasiswa MHS ON RP.doa_umat = MHS.id WHERE M.id = p.id_kegiatan  AND M.tanggal_ibadah > CURRENT_DATE())
            ELSE ''
        END as Doa,

        CASE WHEN p.is_misa = 1 
         THEN (
             SELECT GROUP_CONCAT(MHS.nama SEPARATOR ', ')
             FROM tbl_misa M
             LEFT JOIN tbl_role_petugas RP On RP.id_ibadah = M.id
             LEFT JOIN tbl_mahasiswa MHS 
             ON FIND_IN_SET(MHS.id, RP.persembahan)
             WHERE M.id = p.id_kegiatan AND M.tanggal_ibadah > CURRENT_DATE()
         )
         ELSE ''
    END as Persembahan,

        CASE WHEN p.is_misa = 1 
            THEN (SELECT MHS.nama FROM tbl_misa M LEFT JOIN tbl_role_petugas RP On RP.id_ibadah = M.id LEFT JOIN tbl_mahasiswa MHS ON RP.dirigen = MHS.id WHERE M.id = p.id_kegiatan  AND M.tanggal_ibadah > CURRENT_DATE())
            ELSE ''
        END as Dirigen,

        CASE WHEN p.is_misa = 1 
            THEN (SELECT MHS.nama FROM tbl_misa M LEFT JOIN tbl_role_petugas RP On RP.id_ibadah = M.id LEFT JOIN tbl_mahasiswa MHS ON RP.organis = MHS.id WHERE M.id = p.id_kegiatan  AND M.tanggal_ibadah > CURRENT_DATE())
            ELSE ''
        END as Organis,

        CASE WHEN p.is_misa = 1 
         THEN (
             SELECT GROUP_CONCAT(MHS.nama SEPARATOR ', ')
             FROM tbl_misa M
             LEFT JOIN tbl_role_petugas RP On RP.id_ibadah = M.id
             LEFT JOIN tbl_mahasiswa MHS 
             ON FIND_IN_SET(MHS.id, RP.misdinar)
             WHERE M.id = p.id_kegiatan AND M.tanggal_ibadah > CURRENT_DATE()
         )
         ELSE ''
    END as Misdinar
        
        
        FROM tbl_petugas_misa p
        WHERE p.id_petugas = '$id_fakultas' AND p.is_fakultas = 1");

        return $result;
    }


    function get_all_mahasiswa($id)
    {
        $id_fakultas = $this->get_id_fakultas($id);
        $query = $this->db->query("SELECT f.*, p.nama as nama_prodi FROM tbl_mahasiswa f
        INNER JOIN tbl_prodi p ON f.program_studi = p.id WHERE f.id_fakultas = '$id_fakultas'");

        return $query;
    }

    public function update_task($id_mhs, $tugas) {
        // Example of updating a record in the database
        $this->db->where('id', $id_mhs);
        $this->db->update('petugas_misa', array('tugas' => $tugas));
    }


    public function insert_task($id_mhs, $tugas, $id_kegiatan) {
        // Prepare the data for insertion
        $this->db->where('id', $id_kegiatan);
        $this->db->update('tbl_role_petugas', array($tugas => $id_mhs));
    }

    public function update_persembahan($persembahan, $id_ibadah)
    {
        $this->db->select('persembahan');
        $this->db->from('tbl_role_petugas');
        $this->db->where('id', $id_ibadah);
        $query = $this->db->get();
        $result = $query->row();
        
        // Check if there is an existing value
        if ($result && $result->persembahan) {
            $existing_value = $result->persembahan;
            $persembahan = $existing_value . ',' . $persembahan;
        }
        
        // Update the value
        $this->db->set('persembahan', $persembahan);
        $this->db->where('id', $id_ibadah);
        $this->db->update('tbl_role_petugas');
    }

    public function update_misdinar($misdinar, $id_ibadah)
    {
        $this->db->select('misdinar');
        $this->db->from('tbl_role_petugas');
        $this->db->where('id', $id_ibadah);
        $query = $this->db->get();
        $result = $query->row();
        
        // Check if there is an existing value
        if ($result && $result->misdinar) {
            $existing_value = $result->misdinar;
            $misdinar = $existing_value . ',' . $misdinar;
        }
        
        // Update the value
        $this->db->set('misdinar', $misdinar);
        $this->db->where('id', $id_ibadah);
        $this->db->update('tbl_role_petugas');
    }



    function get_id_fakultas($id)
    {
        $query = $this->db->query("SELECT f.id as id_fakultas FROM tbl_fakultas f WHERE f.admin_fakultas = '$id'");
        $id_fakultas = $query->row()->id_fakultas;

        return $id_fakultas;
    }
}
