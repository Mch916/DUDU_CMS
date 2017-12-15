<div class="container-fluid" style="margin-top:3%;">
  <?php if($userEdit = $this->session->flashdata('user_edited')): ?>
  <?php echo '<p class="alert alert-success" id="">'.$userEdit.'</p>'; ?>
  <?php endif; ?>
  <?php echo validation_errors(); ?>
  <?php echo form_open(site_url('users/edit')); ?>
  <div class="row">
    <div class="col-md-4">
      <h2 class="">Edit user</h2>
        <div class="form-group">
          <label for="">Choose user to edit</label>
          <select class="form-control" name="chooseUser" id="chooseUserSelect">
            <option value="" disabled selected>Select your option</option>
            <?php foreach ($users as $user) : ?>
              <option value="<?php echo $user['user_id']?>"><?php echo $user['userName']?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="">Change username</label>
          <input type="text" name="usernameEdit" class="form-control" autocomplete="off"
          placeholder="Enter username to change or just leave it blank" id="username">
        </div>
        <div class="form-group">
          <label for="">Change password</label>
          <input type="password" name="passwordEdit" class="form-control" autocomplete="off"
          placeholder="Enter password or just leave it blank">
        </div>
        <div class="form-group">
          <label>Delete</label>
          <input type="checkbox" name="delete" value="1">
        </div>
        <button class="btn btn-primary" type="submit">Submit change</button>
    </div>
  </div>
  <?php echo form_close(); ?>
</div>

<script>
    document.getElementById('chooseUserSelect').onchange = function () {
      console.log('select box changed');
        var selectedNum = this.selectedIndex;
        if (selectedNum != 0) {
            document.getElementById('username').value = this.options[selectedNum].text;
        }
    };
</script>
