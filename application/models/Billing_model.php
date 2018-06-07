<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Billing_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

/*
  here is a model that selects the useful fields mobile_number and amount_to_bill from the databases
  this is done so as to optimise load/response time by avoiding redundant data
*/
    public function bill_customers()
    {
      $query       = $this->db->query("SELECT mobile_number, amount_to_bill from bill_customer");
      return $query->result();  //here the query result is converted to an object
    }

}
