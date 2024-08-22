<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800 font-weight-bold card-body"><?= strtoupper($sub_title); ?></h1>

  <form action="<?= base_url('user/additemcategory'); ?>" method="post">
    <?= $this->session->flashdata('message'); ?>
    <div class="card">
      <div class="card-body">
        <div class="mb-3">
          <label for="code" class="form-label ml-1">Item Code</label>
          <input type="text" class="form-control" id="code" name="code">
          <?= form_error('code', '<div class="text-danger ml-2">', '</div>'); ?>
        </div>
        <div class="mb-3">
          <label for="name" class="form-label ml-1">Item Name</label>
          <input type="text" class="form-control" id="name" name="name">
          <?= form_error('name', '<div class="text-danger ml-2">', '</div>'); ?>
        </div>

        <div class="mb-3" style="float: right;">
          <a href="<?= base_url('user/itemcategory'); ?>" class="btn btn-danger">Back</a>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </div>
    </div>
  </form>
</div>

</div>