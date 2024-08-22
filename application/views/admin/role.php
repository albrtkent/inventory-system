                <!-- Begin Page Content -->
                <div class="container-fluid">

                  <!-- Page Heading -->
                  <h1 class="h3 mb-2 text-gray-800 font-weight-bold card-body"><?= strtoupper($sub_title); ?></h1>

                  <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-6">
                          <?= form_error('role', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

                          <?= $this->session->flashdata('message'); ?>
                          <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal">Add New Role</a>

                          <!-- Searchbar -->
                          <div class="row mb-2">
                            <div class="col-md-8">
                              <form class="d-flex" action="<?= base_url('admin/role'); ?>" method="post">
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" placeholder="Search role" name="keyword" autocomplete="off" autofocus>
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
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if (empty($role)) : ?>
                                <tr>
                                  <td colspan="3">
                                    <div class="alert alert-danger text-center" role="alert">
                                      Data not found.
                                    </div>
                                  </td>
                                </tr>
                              <?php endif; ?>
                              <?php foreach ($role as $r) : ?>
                                <tr>
                                  <th scope="row"><?= ++$start; ?></th>
                                  <td><?= $r['role']; ?></td>
                                  <td>
                                    <a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>"><i class="fas fa-fw fa-cogs"></i></a>
                                    <a href="" data-toggle="modal" data-target="#editRoleModal<?= $r['id']; ?>"><i class="fas fa-fw fa-edit"></i></a>
                                    <!--Edit Modal -->
                                    <div class="modal fade" id="editRoleModal<?= $r['id']; ?>" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="editRoleModalLabel">Edit Role</h5>
                                            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" aria-label="Close"><i class="fas fa-fw fa-times"></i></button>
                                          </div>
                                          <form action="<?= base_url('admin/edit_role'); ?>" method="post">
                                            <div class="modal-body">
                                              <div class="mb-3">
                                                <input type="text" class="form-control" id="role" name="role" value="<?= $r['role']; ?>" required>
                                                <input type="hidden" name="id" value="<?= $r['id']; ?>">
                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                    <a href="" data-toggle="modal" data-target="#deleteRoleModal<?= $r['id']; ?>"><i class="fas fa-fw fa-trash-alt"></i></a>
                                    <!--Delete Modal -->
                                    <div class="modal fade" id="deleteRoleModal<?= $r['id']; ?>" tabindex="-1" aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="deleteRoleModalLabel">Confirmation</h5>
                                            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" aria-label="Close"><i class="fas fa-fw fa-times"></i></button>
                                          </div>
                                          <form action="<?= base_url('admin/delete_role/'); ?><?= $r['id']; ?>" method="delete">
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

                <!--Add Modal -->
                <div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
                        <button type="button" class="btn-sm btn-primary" data-dismiss="modal" aria-label="Close"><i class="fas fa-fw fa-times"></i></button>
                      </div>
                      <form action="<?= base_url('admin/add_role'); ?>" method="post">
                        <div class="modal-body">
                          <div class="mb-3">
                            <input type="text" required class="form-control" id="role" name="role" placeholder="Role name">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Add Role</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>