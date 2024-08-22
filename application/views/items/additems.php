<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800 font-weight-bold card-body"><?= strtoupper($sub_title); ?></h1>

  <form action="<?= base_url('user/additems'); ?>" method="post">
    <?= $this->session->flashdata('message'); ?>


    <div class="card">
      <div class="card-body">
        <div class="mb-3">
          <label for="item_id" class="form-label ml-1">Item Code</label>
          <select name="item_id" id="item_id" class="form-control">
            <option value="">Select Item Category</option>
            <?php foreach ($itemCategory as $ic) : ?>
              <option value="<?= $ic['kodebarang']; ?>"><?= $ic['kodebarang']; ?> - <?= $ic['namabarang']; ?></option>
            <?php endforeach; ?>
          </select>
          <?= form_error('item_id', '<div class="text-danger ml-2">', '</div>'); ?>
        </div>
        <div class="mb-3">
          <label for="date_received" class="form-label ml-1">Date Received</label>
          <input type="date" class="form-control" id="date_received" name="date_received">
          <?= form_error('date_received', '<div class="text-danger ml-2">', '</div>'); ?>
        </div>
        <div class="mb-3">
          <label for="brand" class="form-label ml-1">Brand</label>
          <input type="text" class="form-control" id="brand" name="brand">
          <?= form_error('brand', '<div class="text-danger ml-2">', '</div>'); ?>
        </div>
        <div class="mb-3">
          <label for="nup" class="form-label ml-1">NUP</label>
          <input type="text" class="form-control" id="nup" name="nup">
          <?= form_error('nup', '<div class="text-danger ml-2">', '</div>'); ?>
        </div>
        <div class="mb-3">
          <label for="room_id" class="form-label ml-1">Room Code</label>
          <select name="room_id" id="room_id" class="form-control">
            <option value="">Select Room Code</option>
            <?php foreach ($room as $r) : ?>
              <option value="<?= $r['koderuangan']; ?>"><?= $r['koderuangan']; ?> - <?= $r['uraianruangan']; ?></option>
            <?php endforeach; ?>
          </select>
          <?= form_error('room_id', '<div class="text-danger ml-2">', '</div>'); ?>
        </div>
        <div class="mb-3">
          <label for="item_detail" class="form-label ml-1">Item Details</label>
          <input type="text" class="form-control" id="item_detail" name="item_detail">
          <?= form_error('item_detail', '<div class="text-danger ml-2">', '</div>'); ?>
        </div>
        <div class="mb-3">
          <label for="nfctag" class="form-label ml-1">NFC Tag</label>
          <input type="text" class="form-control" id="nfctag" name="nfctag">
          <?= form_error('nfctag', '<div class="text-danger ml-2">', '</div>'); ?>
        </div>
        <div class="mb-3" style="float: right;">
          <a href="<?= base_url('user/items'); ?>" class="btn btn-danger">Back</a>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </div>
    </div>
  </form>
</div>

</div>