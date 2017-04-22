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
    
    protected function _getCategories()
    {
        // Load the database
        $this->load->database();
        
        // Fetch categories
        $categories = $this->db->get('categories')->result();
        
        // Return array of objects
        return $categories;
    }
    
    protected function _validateDate($date)
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }
    
    protected function _validate($post)
    {
        // Validate the data
        $valid = true;
        if (!$this->_validateDate($post->date)) {
            $valid = false;
        }
        if (!is_numeric($post->price)) {
            $valid = false;
        }
        if (empty($post->description)) {
            $valid = false;
        }
        $categories = $this->_getCategories();
        $categoryIds = array();
        foreach ($categories as $category) {
            $categoryIds[] = $category->id;
        }
        if (!in_array($post->category_id, $categoryIds)) {
            $valid = false;
        }
        return $valid;
    }
}