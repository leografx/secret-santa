<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Participant_model extends CI_Model {
    function insert($data) {
        $this->load->database();
        $this->db->insert('participants', $data);
    }

    function getParticipants() {
        $this->load->database();
        return $this->db->get('participants')->result();
    }

    function delete($id) {
        $this->load->database();
        $this->db->delete('participants',["id" => $id]);
    }
}
/* End of file Participant_model.php */