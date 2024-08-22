    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800 font-weight-bold card-body"><?= strtoupper($sub_title); ?></h1>

      <form action="<?= base_url('admin/adduser'); ?>" method="post">
        <?= $this->session->flashdata('message'); ?>
        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <label for="name" class="form-label ml-1">Username</label>
              <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name'); ?>">
              <?= form_error('name', '<div class="text-danger ml-2">', '</div>'); ?>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label ml-1">Email</label>
              <input type="text" class="form-control" id="email" name="email" value="<?= set_value('email'); ?>">
              <?= form_error('email', '<div class="text-danger ml-2">', '</div>'); ?>
            </div>
            <div class="mb-3">
              <label for="password1" class="form-label ml-1">Password</label>
              <input type="password" class="form-control" id="password1" name="password1">
              <?= form_error('password1', '<div class="text-danger ml-2">', '</div>'); ?>
            </div>
            <div class="mb-3">
              <label for="password2" class="form-label ml-1">Password Confirmation</label>
              <input type="password" class="form-control" id="password2" name="password2">
            </div>
            <div class="mb-3" style="float: right;">
              <a href="<?= base_url('admin/users'); ?>" class="btn btn-danger">Back</a>
              <button type="submit" class="btn btn-primary">Add</button>
            </div>
          </div>
        </div>
      </form>
    </div>

    </div>