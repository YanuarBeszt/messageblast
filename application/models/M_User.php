<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_User extends CI_Model
{
    private $_table = "user";

    public function getAllData()
    {
        // $this->db->where('is_deleted', "n");
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ['id' => $id])->row();
    }

    public function storeDataUser($name, $username, $password, $phone, $email)
    {
        $data = array(
            'name' => $name,
            'username' => $username,
            'password' => $password,
            'phone' => $phone,
            'email' => $email,
            'created_date' => date("Y-m-d H:i:s"),
            'created_by' => $this->session->userdata("user_logged")->id,
            'last_updated_date' => date("Y-m-d H:i:s"),
            'last_updated_by' => $this->session->userdata("user_logged")->id,
            'is_deleted' => 'n',
        );
        $query = $this->db->insert($this->_table, $data);
        return $query;
    }

    public function updateDataUser($data, $id)
    {
        $query= $this->db->update($this->_table, $data, array('id' => $id));
        return $query;
    }

    public function deleteDataUser($id)
    {
        $data = array('is_deleted'=>'y');
        
        $this->db->where('id', $id);
        $query = $this->db->update($this->_table, $data);
        return $query;
    }
}
