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
    
    protected function _installAdd()
    {
        // Load database
        $this->load->database();
        
        // Create categories table
        $sql = 'CREATE TABLE IF NOT EXISTS categories
    (
        id INT(9) NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
    );';
        $success = $this->db->query($sql);
        if ($success) {
            // Create purchases table
            $sql = 'CREATE TABLE IF NOT EXISTS purchases
    (
        id INT(9) NOT NULL AUTO_INCREMENT,
        date DATE NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        description VARCHAR(255) NOT NULL,
        category_id INT(9) NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (category_id) REFERENCES categories (id)
    );';
            return $this->db->query($sql);
        } else {
            // Problems
            return false;
        }
    }
    
    protected function _feedback($result, $module)
    {
        if ($result) {
            echo $module . ' module installed'.PHP_EOL;
        } else {
            echo 'Problem installing ' . $module . ' module'.PHP_EOL;
        }
    }
    
    public function install($module)
    {
        if (is_cli()) {
            switch ($module) {
                case 'settings':
                    $result = $this->_installSettings();
                    $this->_feedback($result, 'Settings');
                    break;
                case 'add':
                    $result = $this->_installAdd();
                    $this->_feedback($result, 'Add');
                    break;
                default:
                    echo 'No such module'.PHP_EOL;
            }
        } else {
            exit('No direct script access allowed');
        }
    }
}