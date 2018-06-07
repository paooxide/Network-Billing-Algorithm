<?php
defined('BASEPATH') or exit('No direct script access allowed');
require('application/libraries/REST_Controller.php');

class Billing_controller extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Billing_model');
    }

    /*
    Function to debit a specific customer
    */
    function debit_customer($amount, $mobile_number){
      /*
      in here is an algorithm that debits the specific bill_customer
       the comment contains the the pseudo code
      */

      /*
          $result = remove $amount from $mobile;

          if($result == true){
            return true;
          }
          else {
            return false;
          }

      */
      return true;
    }
    public function index_get()
    {
        $bills                  = $this->Billing_model->bill_customers(); // Get thhe mobile numbers and amount to be billed from database

        if ($bills != null) { // check if the database result is not null
          $i                    = 0; $j = 0;
          $debitted_lines       = array();
          $not_debitted         = array();
          foreach ($bills as $bill) {
            //run the function that willl debit a customer , usually an api call to the Telco/Payment
            $result             = $this->debit_customer($bill->amount_to_bill,$bill->mobile_number);
            if($result == true){ // check if the debit was successfull
              $debitted_lines[] = $bill->mobile_number; // add the successful lines to an array
              $i++; // count the successfull lines
            }else {
              $not_debitted[]   = $bill->mobile_number;  //add the failed lines to an array
              $j++; // count the failed lines
            }

          }
          /*

            return the JSON REST response of the transactions
            data shows the mobile numbers that have been $debitted_lines
            extra shows the number of success and number of failures

          */
            $data['success']    = true;
            $data['message']    = 'Transaction successful';
            $data['data']       = array(
                                'Lines successful' => $debitted_lines,
                                'Lines not successful' => $not_debitted
                              );
            $data['extra']      = array(
                                'number of successful lines' => $i++,
                                'number of failed lines' => $j++
                              );
            $this->response($data , REST_Controller::HTTP_OK);
        }else {
          $data['success']      = false;
          $data['message']      = 'No mobile lines to debit';
          $data['data']         = null;
          $data['extra']        = null;
          $this->response($data, REST_Controller::HTTP_OK);
        }



    }

}
