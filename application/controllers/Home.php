<?php
/**
 * Author: Priya V
 * Date:30/05/2021
 */

 class Home extends CI_Controller
 {
     public function index()
     {
         
         if($this->session->userdata('uId')){
            echo 'welcome Home';
         }
         else{
            $this->session->set_flashdata('error','You have to login now.');
            redirect('signin');

         }
     }

     public function logout()
     {
         $this->session->set_userdata(array('uId'=>''));
         redirect('signin');
     }

 }

 ?>