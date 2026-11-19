<?php
class MasterModel {
    protected $conn;

    public function __construct($conn = null) {
        if ($conn instanceof PDO) {
            $this->conn = $conn;
        } else {
            global $conn;
            $this->conn = $conn;
        }
    }
}