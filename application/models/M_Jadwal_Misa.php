<?php
class M_Jadwal_Misa extends CI_Model
{
    function get_all_misa()
    {
        $result = $this->db->query("SELECT*FROM tbl_misa ORDER BY tanggal_ibadah ASC");
        return $result;
    }

    function add_misa($nama, $tanggal, $waktu, $keterangan)
    {
        // Insert into tbl_misa
        $insert_query = "INSERT INTO tbl_misa (nama_ibadah, tanggal_ibadah, waktu_ibadah, keterangan)
                        VALUES ('$nama', '$tanggal', '$waktu', '$keterangan')";
        $this->db->query($insert_query);

        // Get the last inserted ID
        $last_insert_id = $this->db->insert_id(); // Assuming $this->db is your database connection object

        // Insert into tbl_role_petugas using the retrieved ID
        $insert_role_query = "INSERT INTO tbl_role_petugas (id_ibadah)
                            VALUES ('$last_insert_id')";
        $result = $this->db->query($insert_role_query);

        return $result;
    }

    function edit_misa($id, $nama, $tangal, $waktu, $keterangan)
    {
        $result = $this->db->query("UPDATE tbl_misa SET nama_ibadah = '$nama', tanggal_ibadah = '$tangal', waktu_ibadah = '$waktu', keterangan = '$keterangan' WHERE id = '$id'");
        return $result;
    }

    function delete_misa($id)
    {
        $query = $this->db->query("DELETE FROM tbl_misa WHERE id = '$id'");
        $query = $this->db->query("DELETE FROM tbl_role_petugas WHERE id_ibadah = '$id'");
        return $result;
    }
}