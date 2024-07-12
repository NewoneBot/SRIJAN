<?php
ini_set('display_errors', 1);
Class Action {

    private $db;

    public function __construct() {
        include 'config.php'; 
        $this->db = $dbh;
    }

   

    public function delete_staff() {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM users WHERE id = $id");
        if($delete) {
                return 1; 
        } 
    }

    public function delete_batch() {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM batch WHERE batch_code = $id");
        $update_users = $this->db->query("UPDATE users SET batch_id = 0 WHERE batch_id = $id");
        if($delete && $update_users) {
                return 1; 
        } 
    }

}
?>