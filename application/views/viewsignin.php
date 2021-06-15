<?php
/**
 * Author: Priya V
 * Date:27/05/2021
 */

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Signup in codeigniter</title>
  </head>
  <body>
      <div class="container">
          <div class="row">
              <div class="col-md-6">
                <h1>Signin</h1>

                <!-- It checks the flashdata -->
                <?php 
                // 'error' is the key, that we set in controller
                if($this->session->flashdata('error')){
                  echo $this->session->flashdata('error');

                } 
                ?>

                <!--signin is a controller and checkUser is a method inside that -->
                <?php echo form_open('signin/checkUser',''); ?>
                    
                    <div class="form-group">
                    <label>Enter your email :</label>
                        <?php
                            $email = array('name'=>"email",'class'=>'form_control'); 
                            echo form_input($email); ?>
                    </div>
                    <div class="form-group">
                    <label>Enter your password :</label>
                        <?php
                            $password = array('name'=>"password",'class'=>'form_control'); 
                            echo form_password($password); ?>
                    </div>   
                <div class="form-group">
                        <?php
                            echo form_submit('Signin','Signin','class="btn btn-primary"');
                        ?>
                </div>                 
                <?php echo form_close(); ?>
                

              </div>
          </div>
      </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  </body>
</html>