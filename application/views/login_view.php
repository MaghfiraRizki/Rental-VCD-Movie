<!doctype html>
<html>
<head>
<link href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?=base_url('assets/bootstrap/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?=base_url('assets/dist/css/AdminLTE.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?=base_url('assets/plugins/iCheck/square/blue.css');?>" rel="stylesheet" type="text/css" />
</head>

<body class="login-page">
<div class="login-box">
      <div class="login-logo">
        <a href="<?=base_url();?>"><b>Rental</b> DVD</a>
      </div><!-- /.login-logo -->
      
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
          <div class="form-group has-feedback"> <section class="login">
    
     <?php
	 // Cetak session
	if($this->session->flashdata('sukses')) {
		echo '<p class="warning" style="margin: 10px 20px;">'.$this->session->flashdata('sukses').'</p>';
	}
	// Cetak error
	echo validation_errors('<p class="warning" style="margin: 10px 20px;">','</p>');
	?>
    
    <form action="<?php echo base_url('login') ?>" method="post">
      <p>
        <label for="username"></label>
        <input type="text" name="username" class="form-control" id="username" placeholder="Username">
        
      </p>
      <p>
        <label for="password"></label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
      </p>
         
      <p>
       <div class="row">
              <div class="col-xs-12">
                  <button type="submit" name="submit" id="submit" value="Login" class="btn btn-primary btn-block btn-flat">Sign In</button>
              </div><!-- /.col -->
          </div>
      </p>
    </form>
    </section>
    </div></div></div>
</body>
</html>
