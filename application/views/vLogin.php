<div class="login-box">
 <div class="login-logo"><b>Login</b></div>
 <!-- /.login-logo -->
 <div class="login-box-body">
   <p class="login-box-msg">Sign in to start your session</p>
   <?php if(isset($invalid_login)):?> <div class="alert alert-danger"> <?php echo $invalid_login; ?> </div> <?php endif; ?>

   <?php echo form_open('login/validlogin'); ?>
     <div class="form-group has-feedback">
       <input type="text" name="useremail" class="form-control" placeholder="Email">
       <span class="glyphicon glyphicon-user form-control-feedback"></span>
     </div>
     <div class="form-group has-feedback">
       <input type="password" name="userpass" class="form-control" placeholder="Password">
       <span class="glyphicon glyphicon-lock form-control-feedback"></span>
     </div>
      
     <div class="row">
       <div class="col-xs-8">
         <div class="checkbox icheck">
           <label>
             
           </label>
         </div>
       </div>
       <!-- /.col -->
       <div class="col-xs-4">
         <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
       </div>
       <!-- /.col -->
     </div>
   <?php echo form_close(''); ?>


 </div>
 <!-- /.login-box-body -->
</div>
<!-- /.login-box -->