<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = array(
			'title'     => 'Trackless Crypto',
			'content'   => 'home/index',
			'extra'     => 'home/js/js_index',
		);
		$this->load->view('layout/wrapper', $data);
	}
	public function mailproses()
	{
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('company', 'company', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('failed', validation_errors());
			redirect(base_url("auth"));
			return;
		}

		$input = $this->input;
		$email = $this->security->xss_clean($input->post("email"));
		$company = $this->security->xss_clean($input->post("company"));
		$instagram = $this->security->xss_clean($input->post("instagram"));
		$twitter = $this->security->xss_clean($input->post("twitter"));
		$facebook = $this->security->xss_clean($input->post("facebook"));
		$linkedin = $this->security->xss_clean($input->post("linkedin"));

		if ($instagram == '') {
			$ms_insta = '';
		} else {
			$ms_insta = "Instagram : " . $instagram . "<br>";
		}

		if ($twitter == '') {
			$ms_twitt = '';
		} else {
			$ms_twitt = "Twitter : " . $twitter . "<br>";
		}

		if ($facebook == '') {
			$ms_fb = '';
		} else {
			$ms_fb = "Facebook : " . $facebook . "<br>";
		}

		if ($linkedin == '') {
			$ms_linkin = '';
		} else {
			$ms_linkin = "Linkedin : " . $linkedin . "<br>";
		}

		$message = "
			Detail Information:<br><br>
			Email : " . $email . "<br>
			Company : " . $company . "<br>" .
			$ms_insta .
			$ms_twitt .
			$ms_fb .
			$ms_linkin;

		sendmail($this->phpmailer_lib->load(), $email, $message);
		$this->session->set_flashdata("success", "successfully sent!");
		redirect('auth');
	}
}