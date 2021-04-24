<?php
    class Note extends CI_Model {
        public function get_all_notes() {
            return $this->db->query("SELECT * FROM notes")->result_array();
        }

        public function add_note($post) {
            $note_title = $this->security->xss_clean($post['note_title']);
            $query = "INSERT INTO notes(title, created_at, updated_at) VALUES(?, ?, ?)";
            $values = array($note_title, date("Y-m-d H:i:s"), date("Y-m-d H:i:s"));
            $this->db->query($query, $values);
            return $this->db->insert_id();
        }

        public function delete_note($post) {
            $id = $this->security->xss_clean($post['id']);
            $this->db->delete('notes', array('id' => $id));
        }

        public function edit_note($post) {
            $description = $this->security->xss_clean($post['description']);
            $id = $this->security->xss_clean($post['id']);
            $query = "UPDATE notes SET description = ?, updated_at = ? WHERE id = ?;";
            $values = array($description, date('Y-m-d H:i:s'), $id);
            $this->db->query($query, $values);
        }

        /* ===============VALIDATION METHODS============= */

        public function validate_note($post) {
            $this->form_validation->set_rules('note_title', 'note title', 'required');
            if($this->form_validation->run() === FALSE) {
                return validation_errors();
            } else {
                return "valid_inputs";
            }
        }

        public function validate_delete($post) {
            $this->form_validation->set_rules('id', 'id', 'required');
            if($this->form_validation->run() === FALSE) {
                return validation_errors();
            } else {
                return "valid_inputs";
            }
        }
    }