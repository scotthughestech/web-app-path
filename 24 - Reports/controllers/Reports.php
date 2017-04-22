<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends MY_Controller {
    public function index()
    {
        // Create data array
        $data = array();
        
        // Get our modules for the navbar
        $modules = $this->_getModules();
        $data['modules'] = $modules;
        
        // Add styles to data array
        $styles = array (
            '//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css'
        );
        $data['styles'] = $styles;
        
        // Add scripts to data array
        $scripts = array (
            '//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',
            '//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js',
            base_url('js/reports.js')
        );
        $data['scripts'] = $scripts;
        
        // Load view files
        $this->load->view('page/header', $data);
        $this->load->view('reports', $data);
        $this->load->view('page/footer', $data);
    }
    
    public function fetch()
    {
        // Check if this is an ajax request
        if ($this->input->is_ajax_request()) {
            // Load up the database
            $this->load->database();
            
            // Query the database
            $results = $this->db
                    ->select('date')
                    ->select_sum('price')
                    ->group_by('date')
                    ->get('purchases')
                    ->result();
            
            if ($results == false) {
                $results = 'problem';
            }
            
            // Return message as JSON
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($results));
        } else {
            exit('No direct script access allowed');
        }
    }
    
    public function fetchd()
    {
        // Check if this is an ajax request
        if ($this->input->is_ajax_request()) {
            
            // Get post data and decode it
            $post = json_decode($this->input->raw_input_stream);
            
            // Validate from and to
            $from = $post->from;
            $to = $post->to;
            
            if ($this->_validateDate($from) && $this->_validateDate($to)) {
                // Load up the database
                $this->load->database();
                // Query the database
                $results = $this->db
                        ->select('date')
                        ->select_sum('price')
                        ->where('date >=', $from)
                        ->where('date <=', $to)
                        ->group_by('date')
                        ->get('purchases')
                        ->result();
                
                if ($results == false) {
                    $results = 'problem';
                }                        
            } else {
                $results = 'problem';
            }
            
            // Return as json
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($results));
        } else {
            exit('No direct script access allowed');
        }
    }
}