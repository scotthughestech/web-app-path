<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {
    
    public function __construct()
    {
        // Run the parent's constructor
        parent::__construct();
        
        // Check if the user is logged in
        $logged_in = $this->session->userdata('logged_in');
        
        // If not logged in, redirect to login form
        if ($logged_in == FALSE) {
            redirect('welcome/index');
        }
    }
    
    protected function _getModules()
    {
        // Make modules array
        $modules = array();
        
        // Add Module to array
        $modules[] = array(
            'name' => 'Add',
            'href' => 'app/add'
        );
        
        // Add Settings to array
        $modules[] = array(
            'name' => 'Settings',
            'href' => 'app/settings'
        );
        
        // Return modules
        return $modules;
    }
    
    public function index()
    {
        // Create the data array
        $data = array();
        
        // Get modules
        $modules = $this->_getModules();
        
        // Add modules to data array
        $data['modules'] = $modules;
        
        // Create the scripts array
        $scripts = array();
        
        // Add script to the scripts array
        $scripts[] = base_url('js/add.js');
        
        // Add scripts array to data array
        $data['scripts'] = $scripts;

        // Load the header
        $this->load->view('page/header', $data);
        
        // Load the page view
        $this->load->view('add', $data);
        
        // Load the footer
        $this->load->view('page/footer', $data);
    }
    
    public function settings()
    {
        // Create the data array
        $data = array();
        
        // Get modules
        $modules = $this->_getModules();
        
        // Add modules to data array
        $data['modules'] = $modules;
        
        // Create the scripts array
        $scripts = array();
        
        // Add script to the scripts array
        $scripts[] = base_url('js/settings.js');
        
        // Add scripts array to data array
        $data['scripts'] = $scripts;

        // Load the header
        $this->load->view('page/header', $data);
        
        // Load the page view
        $this->load->view('settings', $data);
        
        // Load the footer
        $this->load->view('page/footer', $data);
    }
    
    protected function _validateSettings($post)
    {
        // Fetch favorite module from the post data
        $favorite = $post->favorite;
        
        // Fetch modules so we can compare
        $modules = $this->_getModules();
        
        // Pull module name into another array
        $names = array();
        foreach ($modules as $module) {
            $names[] = $module['name'];
        }
        
        // Return true if favorite is a module
        return in_array($favorite, $names);
            
    }
    
    public function savesettings()
    {
        // Check if this is an ajax request
        if ($this->input->is_ajax_request()) {
            
            // Get post data and decode it
            $post = json_decode($this->input->raw_input_stream);
            
            // Log post data
            log_message('error', print_r($post, true));
            
            // Validate settings
            $valid = $this->_validateSettings($post);
                        
            // If valid, save to DB
            if ($valid) {
                $message = 'good';
            } else {
                $message = 'bad';
            }
            
            // Return message as JSON
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($message));
        } else {
            exit('No direct script access allowed');
        }
    }

}