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
    
    public function test()
    {
        echo 'already ran'; die;

        // Load database
        $this->load->database();
        
        // Load the Faker library
        require_once FCPATH.'application/third_party/Faker-master/src/autoload.php';
        
        // Instantiate Faker, so we can use it
        $faker = Faker\Factory::create();
        
        // Create 3000 fake purchases
        for ($i=0; $i < 3000; $i++) {
            // Create fake date
            $date = $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d');
            // Create a fake price
            $price = $faker->randomFloat(2,1,150);
            
            // Create a fake description
            $description = ucfirst($faker->words(2, true));
            
            // Create a fake category
            $category_id = $faker->numberBetween(1,6);
            
            // Create the data array
            $data = array(
                'date' => $date,
                'price' => $price,
                'description' => $description,
                'category_id' => $category_id
            );
            // Insert fake purchase into database
            $this->db->insert('purchases', $data);
        }
        
        echo 'Done';
    }
}