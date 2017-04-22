<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Browse extends MY_Controller {
    public function index()
    {
        // Create the data array
        $data = array();
        
        // Get modules
        $modules = $this->_getModules();
        
        // Add modules to data array
        $data['modules'] = $modules;
        
        // Add style to data array
        $styles = array();
        $styles[] = 'https://cdn.datatables.net/v/bs/dt-1.10.13/datatables.min.css';
        $data['styles'] = $styles;
        
        // Create the scripts array
        $scripts = array();
        
        // Add script to the scripts array
        $scripts[] = 'https://cdn.datatables.net/v/bs/dt-1.10.13/datatables.min.js';
        $scripts[] = base_url('js/browse.js');
        
        // Add scripts array to data array
        $data['scripts'] = $scripts;

        // Load the header
        $this->load->view('page/header', $data);
        
        // Load the page view
        $this->load->view('browse', $data);
        
        // Load the footer
        $this->load->view('page/footer', $data);
    }
    
    public function fetch()
    {
        // Check if this is an ajax request
        if ($this->input->is_ajax_request()) {
            // Load the database
            $this->load->database();
            
            // Get the purchases
            $this->db->select('purchases.id, purchases.date, purchases.price, purchases.description, categories.name');
            $this->db->from('purchases');
            $this->db->join('categories', 'purchases.category_id = categories.id');
            $purchases = $this->db->get()->result();
            
            // Return message as JSON
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($purchases));
        } else {
            exit('No direct script access allowed');
        }        
    }
}