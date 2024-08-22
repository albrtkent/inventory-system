                <!-- Begin Page Content -->
                <div class="container-fluid">

                  <!-- Page Heading -->
                  <h1 class="h3 mb-2 text-gray-800 font-weight-bold card-body"><?= strtoupper($sub_title); ?></h1>

                  <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg">

                          <?= $this->session->flashdata('message'); ?>
                          <a href="<?= base_url('guest/export_items'); ?>" class="btn btn-success mb-3" style="float: right;">Export</a>


                          <!-- Searchbar -->
                          <div class="row mb-2">
                            <div class="col-md-8">
                              <form class="d-flex" action="<?= base_url('guest/items'); ?>" method="post">
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" placeholder="Search item data" name="keyword_item" autocomplete="off" autofocus>
                                  <div class="input-group-append">
                                    <input class="btn btn-success" type="submit" name="submit" value="&#x1F50D;">
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                          <h5>Result : <?= $total_rows; ?></h5>

                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Item Category</th>
                                <th scope="col" class="htable">Date Received</th>
                                <th scope="col" class="htable">Brand</th>
                                <th scope="col" class="htable">NUP</th>
                                <th scope="col" class="htable">Room</th>
                                <th scope="col">Item Detail</th>
                                <th scope="col" class="htable">NFC Tag</th>
                                <th scope="col" class="details-icon">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if (empty($itemData)) : ?>
                                <tr>
                                  <td colspan="10">
                                    <div class="alert alert-danger text-center" role="alert">
                                      Data not found.
                                    </div>
                                  </td>
                                </tr>
                              <?php endif; ?>
                              <?php foreach ($itemData as $i) : ?>
                                <?php $date = date('Y-m-d', strtotime($i['tanggalperoleh'])); ?>
                                <tr>
                                  <th scope="row"><?= ++$start; ?></th>
                                  <td><?= $i['kodebarang']; ?> - <?= $i['namabarang']; ?></td>
                                  <td class="htable"><?= $date; ?></td>
                                  <td class="htable"><?= $i['merk']; ?></td>
                                  <td class="htable"><?= $i['nup']; ?></td>
                                  <td class="htable"><?= $i['koderuangan']; ?> - <?= $i['uraianruangan']; ?></td>
                                  <td><?= $i['keterangan']; ?></td>
                                  <td class="htable"><?= $i['nfctag']; ?></td>
                                  <td>
                                    <a href="<?= base_url('guest/edititem'); ?>" data-toggle="modal" data-target="#viewItemModal<?= $i['idbarang']; ?>"><i class="fas fa-fw fa-eye details-icon"></i></a>
                                  </td>
                                </tr>

                              
                                <!-- View Item Modal -->
                                <div class="modal fade" id="viewItemModal<?= $i['idbarang']; ?>" tabindex="-1" aria-labelledby="viewItemModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="viewItemModalLabel">Item Detail</h5>
                                        <button type="button" class="btn-sm btn-primary" data-dismiss="modal" aria-label="Close"><i class="fas fa-fw fa-times"></i></button>
                                      </div>
                                      <form action="<?= base_url('user/edititem'); ?>" method="post">
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $i['idbarang']; ?>">
                                            <label for="code" class="form-label">Item Code
                                            </label>
                                            <input type="text" readonly class="form-control" id="code" name="code" value="<?= $i['kodebarang']; ?> - <?= $i['namabarang']; ?>">
                                          </div>
                                          <div class="mb-3">
                                            <label for="date_received" class="form-label">Date Received
                                            </label>
                                            <input type="text" readonly class="form-control" id="date_received" name="date_received" value="<?= $date; ?>">
                                          </div>
                                          <div class="mb-3">
                                            <label for="brand" class="form-label">Brand</label>
                                            <input type="text" readonly class="form-control" id="brand" name="brand" value="<?= $i['merk']; ?>">
                                          </div>
                                          <div class="form-group">
                                            <label for="nup" class="form-label">NUP</label>
                                            <input type="text" readonly class="form-control" id="nup" name="nup" value="<?= $i['nup']; ?>">
                                          </div>
                                          <div class="form-group">
                                            <label for="roomcode" class="form-label">Room</label>
                                            <input type="text" readonly class="form-control" id="roomcode" name="roomcode" value="<?= $i['koderuangan']; ?> - <?= $i['uraianruangan'] ?>">
                                          </div>
                                          <div class="form-group">
                                            <label for="item_detail" class="form-label">Item Detail</label>
                                            <input type="text" readonly class="form-control" id="item_detail" name="item_detail" value="<?= $i['keterangan']; ?>">
                                          </div>
                                          <div class="mb-3">
                                            <label for="nfctag" class="form-label">NFC Tag</label>
                                            <input type="text" class="form-control" id="nfctag" name="nfctag" value="<?= $i['nfctag']; ?>" readonly>
                                          </div>
                                        </div>
                                        <div class="modal-footer">

                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <!-- End of View Users Modal -->
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <?= $this->pagination->create_links(); ?>
                    </div>
                  </div>
                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->