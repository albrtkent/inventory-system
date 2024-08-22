                <!-- Begin Page Content -->
                <div class="container-fluid">

                  <!-- Page Heading -->
                  <h1 class="h3 mb-2 text-gray-800 font-weight-bold card-body"><?= strtoupper($sub_title); ?></h1>
                  <div class="card">
                    <div class="card-body">
                      <div class="col-lg">
                        <?php if (validation_errors()) : ?>
                          <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                          </div>
                        <?php endif; ?>
                        <?= $this->session->flashdata('message'); ?>
                        <a href="<?= base_url('user/addroom'); ?>" class="btn btn-primary mb-3">Add New Room</a>
                        <a href="<?= base_url('user/export_room'); ?>" class="btn btn-success mb-3" style="float: right;">Export</a>

                        <!-- Searchbar -->
                        <div class="row mb-2">
                          <div class="col-md-8">
                            <form class="d-flex" action="<?= base_url('user/room'); ?>" method="post">
                              <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search room" name="keyword_room" autocomplete="off" autofocus>
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
                            <th scope="col">#</th>
                            <th scope="col">Room Code</th>
                            <th scope="col">Name</th>
                            <th scope="col" hidden>NFC Tag</th>
                            <th scope="col">Action</th>
                          </thead>
                          <tbody>
                            <?php if (empty($room)) : ?>
                              <tr>
                                <td colspan="7">
                                  <div class="alert alert-danger text-center" role="alert">
                                    Data not found.
                                  </div>
                                </td>
                              </tr>
                            <?php endif; ?>
                            <?php foreach ($room as $r) : ?>
                              <tr>
                                <th scope="row"><?= ++$start; ?></th>
                                <td><?= $r['koderuangan']; ?></td>
                                <td><?= $r['uraianruangan']; ?></td>
                                <td hidden><?= $r['nfctagruangan']; ?></td>
                                <td>
                                  <a href="<?= base_url('user/editroom'); ?>" data-toggle="modal" data-target="#viewRoomModal<?= $r['id']; ?>"><i class="fas fa-fw fa-eye details-icon"></i></a>
                                  <a href="<?= base_url('user/editroom'); ?>" data-toggle="modal" data-target="#editRoomModal<?= $r['id']; ?>"><i class="fas fa-fw fa-edit"></i></a>
                                  <a href="" data-toggle="modal" data-target="#deleteRoomModal<?= $r['id']; ?>"><i class="fas fa-fw fa-trash-alt"></i></a>
                                </td>
                              </tr>
                              
                              <!--Delete Modal -->
                              <div class="modal fade" id="deleteRoomModal<?= $r['id']; ?>" tabindex="-1" aria-labelledby="deleteRoomModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="deleteRoomModalLabel">Confirmation</h5>
                                      <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" aria-label="Close"><i class="fas fa-fw fa-times"></i></button>
                                    </div>
                                    <form action="<?= base_url('user/deleteroom/'); ?><?= $r['id']; ?>" method="delete">
                                      <div class="modal-body">
                                        <div class="mb-3">
                                          <p>Apakah ingin menghapus data?</p>
                                          <input type="hidden" name="id" value="<?= $r['id']; ?>">
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Hapus</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                              <!-- Edit Modal -->
                              <div class="modal fade" id="editRoomModal<?= $r['id']; ?>" tabindex="-1" aria-labelledby="editRoomModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="editRoomModalLabel">Edit Room</h5>
                                      <button type="button" class="btn-sm btn-primary" data-dismiss="modal" aria-label="Close"><i class="fas fa-fw fa-times"></i></button>
                                    </div>
                                    <form action="<?= base_url('user/editroom'); ?>" method="post">
                                      <div class="modal-body">
                                        <div class="mb-3">
                                          <input type="hidden" name="id" value="<?= $r['id']; ?>">
                                          <label for="roomcode" class="form-label">Room Code</label>
                                          <input type="text" class="form-control" id="roomcode" name="roomcode" value="<?= $r['koderuangan']; ?>">
                                        </div>
                                        <div class="mb-3">
                                          <label for="roomname" class="form-label">Room Name</label>
                                          <input type="text" class="form-control" id="roomname" name="roomname" value="<?= $r['uraianruangan']; ?>" required>
                                        </div>
                                        <div class="mb-3" hidden>
                                          <label for="nfctag" class="form-label">NFC Tag</label>
                                          <input type="text" class="form-control" id="nfctag" name="nfctag" value="<?= $r['nfctagruangan']; ?>" readonly>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Edit Room</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                              <!-- End of Edit Modal -->
                              <!-- View Modal -->
                              <div class="modal fade" id="viewRoomModal<?= $r['id']; ?>" tabindex="-1" aria-labelledby="viewRoomModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="viewRoomModalLabel">Room Detail</h5>
                                      <button type="button" class="btn-sm btn-primary" data-dismiss="modal" aria-label="Close"><i class="fas fa-fw fa-times"></i></button>
                                    </div>
                                    <form action="<?= base_url('user/editroom'); ?>" method="post">
                                      <div class="modal-body">
                                        <div class="mb-3">
                                          <input type="hidden" class="form-control" id="id" name="id" value="<?= $r['id']; ?>">
                                          <label for="code" class="form-label">Room Code
                                          </label>
                                          <input type="text" readonly class="form-control" id="roomcode" name="roomcode" value="<?= $r['koderuangan']; ?>">
                                        </div>
                                        <div class="mb-3">
                                          <label for="roomname" class="form-label">Room Name
                                          </label>
                                          <input type="text" readonly class="form-control" id="roomname" name="roomname" value="<?= $r['uraianruangan']; ?>">
                                        </div>
                                        <div class="mb-3" hidden>
                                          <label for="roomname" class="form-label">NFC Tag
                                          </label>
                                          <input type="text" readonly class="form-control" id="nfctag" name="nfctag" value="<?= $r['nfctagruangan']; ?>">
                                        </div>
                                      </div>
                                      <div class="modal-footer">

                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                              <!-- End of View Room Modal -->

                            <?php endforeach; ?>
                          </tbody>
                        </table>
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