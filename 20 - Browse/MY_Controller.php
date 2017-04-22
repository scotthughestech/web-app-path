<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    
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
            'href' => 'add/index'
        );
        
        // Add Browse to array
        $modules[] = array(
            'name' => 'Browse',
            'href' => 'browse/index'
        );
        
        // Add Settings to array
        $modules[] = array(
            'name' => 'Settings',
            'href' => 'settings/form'
        );
        
        // Return modules
        return $modules;
    }
    
    

}