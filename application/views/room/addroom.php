<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800 font-weight-bold card-body"><?= strtoupper($sub_title); ?></h1>

  <form action="<?= base_url('user/addroom'); ?>" method="post">
    <?= $this->session->flashdata('message'); ?>
    <div class="card">
      <div class="card-body">
        <div class="mb-3">
          <label for="roomcode" class="form-label ml-1">Room Code</label>
          <input type="text" class="form-control" id="roomcode" name="roomcode">
          <?= form_error('roomcode', '<div class="text-danger ml-2">', '</div>'); ?>
        </div>
        <div class="mb-3">
          <label for="roomname" class="form-label ml-1">Room Name</label>
          <input type="text" class="form-control" id="roomname" name="roomname">
          <?= form_error('roomname', '<div class="text-danger ml-2">', '</div>'); ?>
        </div>
        <div class="mb-3" hidden>
          <label for="nfctag" class="form-label ml-1">NFC Tag</label>
          <input type="text" class="form-control" id="nfctag" name="nfctag">
          <?= form_error('nfctag', '<div class="text-danger ml-2">', '</div>'); ?>
        </div>
        <div class="mb-3" style="float: right;">
          <a href="<?= base_url('user/room'); ?>" class="btn btn-danger">Back</a>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </div>
    </div>
  </form>
</div>

</div>