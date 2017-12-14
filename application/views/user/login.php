<div class="container-fluid" style="margin-top:80px;">
  <?php if($login_error = $this->session->flashdata('login_error')): ?>
  <?php echo '<p class="alert alert-success" id="">'.$login_error.'</p>'; ?>
  <?php endif; ?>
  <?php echo validation_errors(); ?>
  <?php echo form_open(site_url('users/login')); ?>
  <div class="row">
    <div class="col-md-4 col-md-offset-4 well">
      <h2 class="text-center">Login</h2>
        <div class="form-group">
          <label for="">Username</label>
          <input type="text" name="user_name" class="form-control" required autofocus autocomplete="off"
          placeholder="Enter your username">
        </div>
        <div class="form-group">
          <label for="">Password</label>
          <input type="password" name="password" class="form-control" required autofocus autocomplete="off"
          placeholder="Enter password">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>
  </div>
  <?php echo form_close(); ?>
</div>
