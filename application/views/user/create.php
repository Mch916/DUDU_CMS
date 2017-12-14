<div class="container-fluid" style="margin-top:3%;">
  <?php if($userCreated = $this->session->flashdata('user_created')): ?>
  <?php echo '<p class="alert alert-success" id="">'.$userCreated.'</p>'; ?>
  <?php endif; ?>
  <?php echo validation_errors(); ?>
  <?php echo form_open(site_url('users/create')); ?>
  <div class="row">
    <div class="col-md-4">
      <h2 class="">Create an user</h2>
        <div class="form-group">
          <label for="">Username</label>
          <input type="text" name="usernameCreate" class="form-control" required autofocus autocomplete="off"
          placeholder="Enter your username">
        </div>
        <div class="form-group">
          <label for="">Password</label>
          <input type="password" name="passwordCreate" class="form-control" required autofocus autocomplete="off"
          placeholder="Enter password">
        </div>
        <div class="form-group">
          <label for="">Confirm Password</label>
          <input type="password" name="passwordConfirm" class="form-control" required autofocus autocomplete="off"
          placeholder="Re-enter password">
        </div>
        <button class="btn btn-primary" type="submit">Create</button>
    </div>
  </div>
  <?php echo form_close(); ?>
</div>
