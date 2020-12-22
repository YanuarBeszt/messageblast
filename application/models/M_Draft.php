<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_Draft extends CI_Model
{
    private $_table = "message";

    public function getAllData($id)
    {
        $this->db->where('type', $id);
        return $this->db->get($this->_table)->result();
    }

    public function storeDataDraft($subject, $message,$type) 
    {
        $data = array(
            'type' => $type,
            'subject' => $subject,
            'message' => $message,
            'created_date' => date("Y-m-d H:i:s"),
            'created_by' => $this->session->userdata("user_logged")->id,
            'last_updated_date' => date("Y-m-d H:i:s"),
            'last_updated_by' => $this->session->userdata("user_logged")->id,
            'is_deleted' => 'n',
        );
        $query = $this->db->insert($this->_table, $data);
        
        return $query;

    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ['id' => $id])->row();
    }

    public function updateData($data, $id)
    {
        $query = $this->db->update($this->_table, $data, array('id' => $id));
        return $query;
    }

}
