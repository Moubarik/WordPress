<?php 

/*
Plugin Name: Contact us
Plugin URI: 
Description: plugin de formulaire de contact.
Author: Abdel Moubarik  
Author URI: 
Version: 0.1
*/

function contact_form_plugin()
{
    $content='';
    $content.='
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
<!--Section description-->
<p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
    a matter of hours to help you.</p>
    <form method="post" action="">
    <div class="form-row">
      <div class="form-group col-md-6">
        <input name="full_name" type="text" class="form-control" placeholder="Full name *" required>

      </div>
      <div class="form-group col-md-6">
        <input name="email" type="email" class="form-control" placeholder="Email Address *"required>
      </div>
    </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-12">
        <input name="subject" type="text" class="form-control" placeholder="Subject *"required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-12">
          <textarea name="text" class="form-control" rows="3"required></textarea>
      </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12 text-center">
           <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send Message</button>
        </div>
     </div>

  </form>
    ';
    
    return $content;
}
add_shortcode('contact_form','contact_form_plugin');

function contact_form_send(){
  if(isset($_POST['submit'])){
    $name=$_POST['full_name'];
    $email=$_POST['email'];
    $subject=$_POST['subject'];
    $text=$_POST['text'];

    $to ="moubarik20@gmail.com";
    $subject="message from contact";
    $message= $name . '- ' . $email . '-' . $subject . '-'.$text;
    wp_mail($to,$subject,$message);

    echo "<script>alert('message send seccessfulyy')</script>";

  }
}
add_action("wp_head","contact_form_send");

?>