                <!-- Begin Page Content -->
                <div class="container-fluid">

                  <!-- Page Heading -->
                  <h1 class="h3 mb-2 text-gray-800 font-weight-bold card-body"><?= strtoupper($sub_title); ?></h1>
                  <div class=card>
                    <div class=card-body>
                      <div class="row">
                        <div class="col-lg-6">
                          <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

                          <?= $this->session->flashdata('message'); ?>
                          <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a>

                          <!-- Searchbar -->
                          <div class="row mb-2">
                            <div class="col-md-8">
                              <form class="d-flex" action="<?= base_url('menu'); ?>" method="post">
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" placeholder="Search menu name" name="keyword_menu" autocomplete="off" autofocus>
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
                                <th scope="col">Menu</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if (empty($menu)) : ?>
                                <tr>
                                  <td colspan="3">
                                    <div class="alert alert-danger text-center" role="alert">
                                      Data not found.
                                    </div>
                                  </td>
                                </tr>
                              <?php endif; ?>
                              <?php foreach ($menu as $m) : ?>
                                <tr>
                                  <th scope="row"><?= ++$start; ?></th>
                                  <td><?= strtoupper($m['menu']); ?></td>
                                  <td>
                                    <a href="" data-toggle="modal" data-target="#editMenuModal<?= $m['id']; ?>"><i class="fas fa-fw fa-edit"></i></a>

                                    <!-- Edit Menu -->
                                    <div class="modal fade" id="editMenuModal<?= $m['id']; ?>" tabindex="-1" aria-labelledby="editMenuModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="editMenuModalLabel">Edit Menu</h5>
                                            <button type="button" class="btn-sm btn-primary" data-dismiss="modal" aria-label="Close"><i class="fas fa-fw fa-times"></i></button>
                                          </div>
                                          <form action="<?= base_url('menu/edit_menu'); ?>" method="post">
                                            <div class="modal-body">
                                              <div class="mb-3">
                                                <label for="menu" class="form-label">Menu</label>
                                                <input type="text" class="form-control" id="menu" name="menu" value="<?= strtoupper($m['menu']); ?>" required>
                                                <input type="hidden" name="id" value="<?= $m['id']; ?>">
                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary">Edit Menu</button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>




                                    <a href="" data-toggle="modal" data-target="#deleteMenuModal<?= $m['id']; ?>"><i class="fas fa-fw fa-trash-alt"></i></a>
                                    <!--Delete Modal -->
                                    <div class="modal fade" id="deleteMenuModal<?= $m['id']; ?>" tabindex="-1" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="deleteMenuModalLabel">Confirmation</h5>
                                            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" aria-label="Close"><i class="fas fa-fw fa-times"></i></button>
                                          </div>
                                          <form action="<?= base_url('menu/delete/'); ?><?= $m['id']; ?>" method="delete">
                                            <div class="modal-body">
                                              <div class="mb-3">
                                                <p>Apakah ingin menghapus data?</p>
                                                <input type="hidden" name="id" value="<?= $m['id']; ?>">
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
                                  </td>
                                </tr>
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

                <!--Add Menu Modal -->
                <div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
                        <button type="button" class="btn-sm btn-primary" data-dismiss="modal" aria-label="Close"><i class="fas fa-fw fa-times"></i></button>
                      </div>
                      <form action="<?= base_url('menu/addmenu'); ?>" method="post">
                        <div class="modal-body">
                          <div class="mb-3">
                            <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name" required autocomplete="off">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Add Menu</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>