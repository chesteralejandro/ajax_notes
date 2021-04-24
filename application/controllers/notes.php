<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notes extends CI_Controller {

	public function index()
	{
		$this->load->view('notes/index');
	}

	public function display_notes() {
		$data['notes'] = $this->note->get_all_notes();
		$this->load->view('partials/note_partial', $data);
	}

	public function process_note() {
		$response = $this->note->validate_note($this->input->post());
		if($response == "valid_inputs") {
			$data['id'] = $this->note->add_note($this->input->post());
			$data['notes'] = $this->note->get_all_notes();
			$this->load->view('partials/note_partial', $data);
		} else {
			echo validation_errors();
		}
	}

	public function process_delete() {
		$response = $this->note->validate_delete($this->input->post());
		if($response == "valid_inputs") {
			$this->note->delete_note($this->input->post());
			// $data['notes'] = $this->note->get_all_notes();
			// $this->load->view('partials/note_partial', $data);
			redirect('/');
		} else {
			echo validation_errors();
		}
	}

	public function process_edit() {
		$this->note->edit_note($this->input->post());
		// $data['notes'] = $this->note->get_all_notes();
		// $this->load->view('partials/note_partial', $data);
		redirect('/');
	}
}
