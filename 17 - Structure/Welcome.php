<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	    // Check if the user is logged in
            $logged_in = $this->session->userdata('logged_in');

            // If logged in, redirect to the app
            if ($logged_in == TRUE) {
                redirect('settings/index');
            } else {
                // Load the login form
                $this->load->view('welcome_message');
            }            
	}
        
        public function login()
        {
            // Check if this is an ajax request
            if ($this->input->is_ajax_request()) {
                // Get post data and decode it
                $post = json_decode($this->input->raw_input_stream);
                // Check email and password
                if ($post->inputEmail == 'jdoe@example.com' && $post->inputPassword == 'youknowme') {
                    // Add user login info to session
                    $this->session->set_userdata('logged_in', true);
                    $message = "good";
                } else {
                    $message = "bad";
                }
                // Return message as JSON
                $this->output
                     ->set_content_type('application/json')
                     ->set_output(json_encode($message));
            } else {
                exit('No direct script access allowed');
            }
        }
        
        public function logout()
        {
            // Log out the user
            $this->session->unset_userdata('logged_in');
            
            // Redirect back to the login form
            redirect('welcome/index');
        }
}
