<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaction_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertDonor($data) {

        $this->db->insert('transaction', $data);
    }

    function getDonor() {
        $query = $this->db->get('transaction');
        return $query->result();
    }

    function getDonorById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('transaction');
        return $query->row();
    }

    function updateDonor($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('transaction', $data);
    }

    function deleteDonor($id) {
        $this->db->where('id', $id);
        $this->db->delete('transaction');
    }

    function getBloodBank() {
        $query = $this->db->get('bankb');
        return $query->result();
    }

    function getBloodBankById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('bankb');
        return $query->row();
    }

    function updateBloodBank($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('bankb', $data);
    }

}
