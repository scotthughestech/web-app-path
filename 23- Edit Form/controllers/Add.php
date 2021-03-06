<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends MY_Controller {
    
    public function index()
    {
        // Create the data array
        $data = array();
        
        // Get categories
        $categories = $this->_getCategories();
        $data['categories'] = $categories;
        
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
    
    public function test()
    {
        die('Delete the die statement if you want to run this function.');

        // Load the database
        $this->load->database();
        
        // Set up your categories
        $categories = array(
            'Business',
            'Home',
            'Personal',
            'Food',
            'Entertainment',
            'Other'
        );
        
        // Insert them into the database
        foreach ($categories as $category) {
            $this->db->insert('categories', array('name' => $category));
        }
        
        // Done
        echo 'Done';
    }
    
    
    
    public function save()
    {
        // Check if this is an ajax request
        if ($this->input->is_ajax_request()) {
            
            // Get post data and decode it
            $post = json_decode($this->input->raw_input_stream);
            
            // Validate post data
            $valid = $this->_validate($post);
            
            if ($valid) {
                // Set up data array
                $data = array (
                    'date' => $post->date,
                    'price' => $post->price,
                    'description' => $post->description,
                    'category_id' => $post->category_id
                );
                
                // Insert into database here
                $this->load->database();
                $inserted = $this->db->insert('purchases', $data);
                
                // Set message to success
                if ($inserted) {
                    $message = 'Success';
                } else {
                    $message = 'Database problem';
                }
            } else {
                $message = 'Invalid data';
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