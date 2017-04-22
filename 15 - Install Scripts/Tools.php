<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends CI_Controller {
    
    protected function _installSettings()
    {
        // Load database forge
        $this->load->dbforge();
        
        // Add id field
        $this->dbforge->add_field('id');
        
        // Add key and value fields
        $fields = array (
            'key' => array (
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true
            ),
            'value' => array (
                'type' => 'VARCHAR',
                'constraint' => 255
            )
        );
        $this->dbforge->add_field($fields);
        
        // Create settings table if not exists
        $success = $this->dbforge->create_table('settings', true);
        
        // If table create successfully, insert data
        if ($success) {
            // Load database
            $this->load->database();
            // Insert data
            $data = array (
                'key' => 'favorite',
                'value' => 'Settings'
            );
            return $this->db->insert('settings', $data);
        } else {
            // Problem
            return false;
        }
    }
    
    public function install($module)
    {
        if (is_cli()) {
            switch ($module) {
                case 'settings':
                    $result = $this->_installSettings();
                    if ($result) {
                        echo 'Settings module installed'.PHP_EOL;
                    } else {
                        echo 'Problem installing Settings module'.PHP_EOL;
                    }
                    break;
                default:
                    echo 'No such module'.PHP_EOL;
            }
        } else {
            exit('No direct script access allowed');
        }
    }
}