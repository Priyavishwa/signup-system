<?php
/**
 * Author: Priya V
 * Date:20/05/2021
 */

 class Signup extends CI_Controller
 {

     public function index()
     {
        // echo 'working';
        $this->load->view('viewsignup');
     }

     public function newUser()
     {
        $data['uFullName'] = $this->input->post('fullName',true);
        $data['uEmail'] = $this->input->post('email',true);
        $data['uPassword'] = $this->input->post('password',true);
        $data['uDate'] = date('y-m-d h:i:sa');
        //var_dump($data);
        if(
           !empty($data['uFullName']) && !empty($data['uEmail']) 
           && !empty($data['uPassword'])
        ){
           // 'checkUser' is a method inside model 'modSignup' 
           //sending the associative array $data from controller to model
           $checkUser = $this->modSignup->checkUser($data);
           if($checkUser->num_rows()>0)
           {
               $this->session->set_flashdata('error','This email:<strong>'.$data['uEmail'].'</strong>is already exists.');
               redirect('signup');
            }
            else{
               //converting password to md5 (algorithm) type
               $data['uPassword'] = hash('md5',$data['uPassword']);

               //generate random link after filling form 
               $data['uLink'] = random_string('alnum',20);

               //sending 'data' to 'addNewUser' method
               $added = $this->modSignup->addNewUser($data);
               if($added){
                  if($this->sendEmail($data)){
                     $this->session->set_flashdata('error','Please check your inbox or junk folder and activate your account.');
                     redirect('signup');

                  }else{
                     $this->session->set_flashdata('error','We can not send you an email right now.');
                     redirect('signup');
                  }
                  
               }
               else{
                  $this->session->set_flashdata('error','Something went wrong please try again.');
                  redirect('signup');
               }

            }
         }
        


         else {
            //sending flash data
           $this->session->set_flashdata('error','Please check required fields and try again.');

           //redirecting to signup
           redirect('signup');
         }
     }

     public function confirm($link)
     {
        if(!empty($link)){
            $checkLink = $this->modSignup->checkLink($link);
            if($checkLink->num_rows()==1){
               $actiret = $this->modSignup->activateTheLink($link);
               if($actiret){
                  $this->session->set_flashdata('error','We have successfully activated your account.');
                  redirect('signup');

               }
               else{
                  $this->session->set_flashdata('error','We can not activate your account, please try again.');
                  redirect('signup');

               }
            }else{
               $this->session->set_flashdata('error','The link is expired.');
               redirect('signup');
            }
        }
        else{
         $this->session->set_flashdata('error','Please provide a link.');
         redirect('signup');
        }
     }

     public function sendEmail($data)
     {
        $config = array(
           'useragent'=>'CodeIgniter',
           'protocol'=>'mail',
           'mailpath'=>'/usr/sbin/sendmail',
           'smtp_host'=>'localhost',
           'smtp_user'=>'kumpriya1010@gmail.com',
           'smtp_pass'=>'9930805719',
           'smtp_port'=>25,
           'smtp_timeout'=>55,
           'wordwrap'=>TRUE,
           'wrapchars'=>76,
           'mailtype'=>'html',
           'charset'=>'utf-8',
           'validate'=>FALSE,
           'priority'=>3,
           'crlf'=>"\r\n",
           'newline'=>"\r\n",
           'bcc_batch_mode'=>FALSE,
           'bcc_batch_size'=>200,

        );

        $message = "<strong>".$data['uFullName']."</strong>". anchor('signup/confirm/'.$data['uLink'],'Activate your email','');

        $this->load->library('email',$config);
        $this->email->set_newline("\r\n");
        $this->email->from('kumpriya1010@gmail.com','Priya');
        $this->email->to($data['uEmail']);
        $this->email->subject('Account activation');
        $this->email->message($message);
        $this->email->set_mailtype('html');
        if($this->email->send())
        {
           return true;

        }
        else{
           return false;

        }

     }


 }

?>