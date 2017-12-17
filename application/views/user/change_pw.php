<div class="container-fluid" style="margin-top:3%;">
  <?php if($pwChange = $this->session->flashdata('changePW')): ?>
  <?php echo '<p class="alert alert-success" id="">'.$pwChange.'</p>'; ?>
  <?php endif; ?>
  <?php if($pwError = $this->session->flashdata('pw_error')): ?>
  <?php echo '<p class="alert alert-success" id="">'.$pwError.'</p>'; ?>
  <?php endif; ?>
  <?php echo validation_errors(); ?>
  <?php echo form_open(site_url('users/change_pw')); ?>
  <div class="row">
    <div class="col-md-4">
      <h2 class="">Change password</h2>
        <div class="form-group">
          <label for="">Current password</label>
          <input type="password" name="currentPW" class="form-control" autocomplete="off"
          placeholder="Enter your current password">
        </div>
        <div class="form-group">
          <label for="">New password</label>
          <input type="password" name="newPW" class="form-control" autocomplete="off"
          placeholder="Enter a new password">
        </div>
        <div class="form-group">
          <label for="">Confirm new password</label>
          <input type="password" name="newPWConfirm" class="form-control" autocomplete="off"
          placeholder="Re-enter the new password">
        </div>
        <button class="btn btn-primary" type="submit">Submit change</button>
    </div>
  </div>
  <?php echo form_close(); ?>
</div>
