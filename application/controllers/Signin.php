<?php
/**
 * Author: Priya V
 * Date: 27/05/2021
 */

class Signin extends CI_Controller
{

    public function index()
    {
        $this->load->view('viewsignin');
    }

    public function checkUser()
    {
        $data['uEmail'] = $this->input->post('email',true);
        $data['uPassword'] = $this->input->post('password',true);
        if(!empty($data['uEmail']) && !empty($data['uPassword'])){
            $data['uPassword'] = hash('md5', $data['uPassword']);
                $user =  $this->modSignup->checkUserByPassword($data);
                if(count($user) == 1){
                    $userData['uFullName'] = $user[0]['uFullName'];
                    $userData['uDate'] = $user[0]['uDate'];
                    $userData['uEmail'] = $user[0]['uEmail'];
                    $userData['uId'] = $user[0]['uId'];
                    $this->session->set_userdata($userData);
                    if($this->session->set_userdata('uId')){
                        redirect('home');
                    }
                    else{
                        $this->session->set_flashdata('error','We can not login right now.');
                        redirect('signin');

                    }

                }
                else if(count($user) == 0){
                    $this->session->set_flashdata('error','Invalid Email or Password.');
                     redirect('signin');

                }
        }
        else{
            $this->session->set_flashdata('error','Please check required fields and try again.');
            redirect('signin');

        }
    }

}

?>