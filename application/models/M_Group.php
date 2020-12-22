<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_Group extends CI_Model
{
    private $_table = "group";

    public function getAllData()
    {
        $this->db->where('is_deleted', "n");
        return $this->db->get($this->_table)->result();
    }

    public function storeDataGroup($name, $selectedContact)
    {
        $data = array(
            'name' => $name,
            'created_date' => date("Y-m-d H:i:s"),
            'created_by' => $this->session->userdata("user_logged")->id,
            'last_updated_date' => date("Y-m-d H:i:s"),
            'last_updated_by' => $this->session->userdata("user_logged")->id,
            'is_deleted' => 'n',
        );
        $query = $this->db->insert($this->_table, $data);
        $id = $this->db->insert_id();
        $choosed = array();
        foreach ($selectedContact as $key => $val) {
            $choosed[] = array(
                'group_id' => $id,
                'contact_id' => $_POST['selectedContact'][$key]
            );
        }
        $this->db->insert_batch('contact_group', $choosed);

        return $query;
    }

    public function updateDataGroup($id, $name, $selectedContact)
    {
        $data = array(
            'name' => $name,
            'last_updated_date' => date("Y-m-d H:i:s"),
            'last_updated_by' => $this->session->userdata("user_logged")->id,
        );
        $this->db->update($this->_table, $data, array('id' => $id));

        $this->db->where("group_id", $id);
        $this->db->delete("contact_group");
        $choosed = array();
        foreach ($selectedContact as $key => $val) {
            $choosed[] = array(
                'group_id' => $id,
                'contact_id' => $_POST['selectedContact'][$key]
            );
        }
        $query = $this->db->insert_batch('contact_group', $choosed);

        return $query;
    }

    public function deleteDataGroup($id)
    {
        $data = array(
            'is_deleted' => "y",
            'last_updated_date' => date("Y-m-d H:i:s"),
            'last_updated_by' => $this->session->userdata("user_logged")->id,
        );
        $query = $this->db->update($this->_table, $data, array('id' => $id));
        return $query;
    }

    public function getDataByIdGroup($id)
    {
        $this->db->select("*, b.name as groupname");
        $this->db->from("contact_group a");
        $this->db->join("group b", "b.id = a.group_id");
        $this->db->join("contact c", "c.id = a.contact_id");
        $this->db->where("a.group_id", $id);
        return $this->db->get();
    }
}
