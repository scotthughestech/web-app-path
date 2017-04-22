<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {
    public function index()
    {
        // Load database
        $this->load->database();
        
        // Get row
        $row = $this->db->get_where('settings', array ('key' => 'favorite'))->row();
        
        // Get favorite
        $favorite = $row->value;
        
        // Get modules
        $modules = $this->_getModules();
        
        // Loop over them to find the favorite
        foreach ($modules as $module) {
            if ($module['name'] == $favorite) {
                $url = $module['href'];
                break;
            }
        }
        
        // Redirect to favorite
        redirect($url);
    }
    
    public function form()
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
                // Load database
                $this->load->database();
                // Set favorite
                $this->db->set('value', $post->favorite);
                $this->db->where('key', 'favorite');
                // Update the table
                $result = $this->db->update('settings');
                // If good result, set message to good
                if ($result) {
                    // Set message to good
                    $message = 'good';
                } else {
                    $message = 'bad';
                }
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
    
    public function getsettings()
    {
        // Check if this is an ajax request
        if ($this->input->is_ajax_request()) {
            // Load database
            $this->load->database();
            // Fetch settings from DB
            $results = $this->db->get('settings')->result();
            // Process results
            $settings = array();
            foreach ($results as $result) {
                $key = $result->key;
                $value = $result->value;
                $settings[$key] = $value;
            }
            // Return message as JSON
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($settings));            
        } else {
            exit('No direct script access allowed');
        }
    }
}