                <!-- Begin Page Content -->
                <div class="container-fluid">

                  <!-- Page Heading -->
                  <h1 class="h3 mb-2 text-gray-800 font-weight-bold card-body"><?= strtoupper($sub_title); ?></h1>

                  <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg">
                          <?= form_error('name', '<div class="text-danger mb-2">', '</div>'); ?>
                          <?= form_error('email', '<div class="text-danger mb-2">', '</div>'); ?>
                          <?= form_error('password1', '<div class="text-danger mb-2">', '</div>'); ?>
                          <?= $this->session->flashdata('message'); ?>
                          <a href="<?= base_url('admin/adduser'); ?>" class="btn btn-primary mb-3">Add New User</a>

                          <!-- Searchbar -->
                          <div class="row mb-2">
                            <div class="col-md-8">
                              <form class="d-flex" action="<?= base_url('admin/users'); ?>" method="post">
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" placeholder="Search users name or email" name="keyword_user" autocomplete="off" autofocus>
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
                                <th scope="col" class="htable">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col" class="xtable">Role</th>
                                <th scope="col" class="htable">Date Created</th>
                                <th scope="col" class="xtable">Status</th>
                                <th scope="col" class="atable">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if (empty($users)) : ?>
                                <tr>
                                  <td colspan="7">
                                    <div class="alert alert-danger text-center" role="alert">
                                      Data not found.
                                    </div>
                                  </td>
                                </tr>
                              <?php endif; ?>
                              <?php foreach ($users as $u) : ?>
                                <tr>
                                  <th scope="row"><?= ++$start; ?></th>
                                  <td class="htable"><?= $u['name']; ?></td>
                                  <td><?php if ($u['is_active'] == 1) : ?>
                                      <?= '<i class="fas fa-xs fa-circle text-success stats-icon""></i> '; ?>
                                    <?php else : ?>
                                      <?= '<i class="fas fa-xs fa-circle text-secondary stats-icon"></i> '; ?>
                                      <?php endif; ?><?= $u['email']; ?></td>
                                  <td class="xtable">
                                    <?php if ($u['role_id'] == 1) : ?>
                                      <?= 'ADMIN'; ?>
                                    <?php else : ?>
                                      <?= 'USER'; ?>
                                    <?php endif; ?>
                                  </td>
                                  <td class="htable"><?= date('d F Y', $u['date_created']); ?></td>
                                  <td class="xtable"> <?php if ($u['is_active'] == 1) : ?>
                                      <?= '<i class="fas fa-xs fa-circle text-success"></i> Active'; ?>
                                    <?php else : ?>
                                      <?= '<i class="fas fa-xs fa-circle text-secondary"></i> Not active'; ?>
                                    <?php endif; ?></td>
                                  <td>
                                    <a href="<?= base_url('admin/edit_user'); ?>" data-toggle="modal" data-target="#viewUserModal<?= $u['id']; ?>"><i class="fas fa-fw fa-eye details-icon"></i></a>
                                    <a href="<?= base_url('admin/edit_user'); ?>" data-toggle="modal" data-target="#editUserModal<?= $u['id']; ?>"><i class="fas fa-fw fa-edit"></i></a>
                                    <a href="" data-toggle="modal" data-target="#deleteUserModal<?= $u['id']; ?>"><i class="fas fa-fw fa-trash-alt"></i></a>
                                  </td>
                                </tr>
                                <!--Delete Modal -->
                                <div class="modal fade" id="deleteUserModal<?= $u['id']; ?>" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="deleteUserModalLabel">Confirmation</h5>
                                        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" aria-label="Close"><i class="fas fa-fw fa-times"></i></button>
                                      </div>
                                      <form action="<?= base_url('admin/delete_user/'); ?><?= $u['id']; ?>" method="delete">
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <p>Apakah ingin menghapus data?</p>
                                            <input type="hidden" name="id" value="<?= $u['id']; ?>">
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
                                <!-- Edit Users Modal -->
                                <div class="modal fade" id="editUserModal<?= $u['id']; ?>" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="editUserModalLabel">Edit user</h5>
                                        <button type="button" class="btn-sm btn-primary" data-dismiss="modal" aria-label="Close"><i class="fas fa-fw fa-times"></i></button>
                                      </div>
                                      <form action="<?= base_url('admin/edit_user'); ?>" method="post">
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $u['id']; ?>">
                                            <label for="name" class="form-label">Name
                                            </label>
                                            <input type="text" required class="form-control" id="name" name="name" value="<?= $u['name']; ?>">
                                          </div>
                                          <div class="mb-3">
                                            <label for="email" class="form-label">Email
                                            </label>
                                            <input type="text" required class="form-control" id="email" name="email" value="<?= $u['email']; ?>">
                                            <input type="hidden" class="form-control" id="image" name="image" value="<?= $u['image']; ?>">
                                            <input type="hidden" class="form-control" id="password" name="password" value="<?= $u['password']; ?>">
                                          </div>
                                          <div class="mb-3">
                                            <label for="role_id" class="form-label">Role
                                            </label>
                                            <select name="role_id" id="role_id" class="form-control">
                                              <?php foreach ($roles as $r) : ?>
                                                <?php if ($u['role_id'] == $r['id']) : ?>
                                                  <option value="<?= $r['id'] ?>" selected><?= $r['role']; ?></option>
                                                <?php else : ?>
                                                  <option value="<?= $r['id'] ?>"><?= $r['role']; ?></option>
                                                <?php endif; ?>
                                              <?php endforeach; ?>
                                            </select>
                                          </div>
                                          <div class="mb-3">
                                            <label for="date_created" class="form-label">Date created</label>
                                            <input type="text" readonly class="form-control" id="date_created" name="date_created" value="<?= date('d F Y', $u['date_created']); ?>">
                                          </div>
                                          <div class="form-group">
                                            <label for="is_active" class="form-label">Status
                                            </label>
                                            <div class="form-check">
                                              <?php if ($u['is_active'] == 1) : ?>
                                                <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked="checked">
                                              <?php else : ?>
                                                <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active">
                                              <?php endif; ?>
                                              <label class="form-check-label" for="is_active">Active</label>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Edit user</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <!-- End of Edit Users Modal -->
                                <!-- View Users Modal -->
                                <div class="modal fade" id="viewUserModal<?= $u['id']; ?>" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="viewUserModalLabel">User Detail</h5>
                                        <button type="button" class="btn-sm btn-primary" data-dismiss="modal" aria-label="Close"><i class="fas fa-fw fa-times"></i></button>
                                      </div>
                                      <form action="<?= base_url('admin/edit_user'); ?>" method="post">
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $u['id']; ?>">
                                            <label for="name" class="form-label">Name
                                            </label>
                                            <input type="text" readonly class="form-control" id="name" name="name" value="<?= $u['name']; ?>">
                                          </div>
                                          <div class="mb-3">
                                            <label for="email" class="form-label">Email
                                            </label>
                                            <input type="text" readonly class="form-control" id="email" name="email" value="<?= $u['email']; ?>">
                                            <input type="hidden" class="form-control" id="image" name="image" value="<?= $u['image']; ?>">
                                            <input type="hidden" class="form-control" id="password" name="password" value="<?= $u['password']; ?>">
                                          </div>
                                          <div class="mb-3">
                                            <label for="role_id" class="form-label">Role
                                            </label>
                                            <?php if ($u['role_id'] == 1) : ?>
                                              <input type="text" readonly class="form-control" id="role_id" name="role_id" value="<?= 'ADMIN'; ?>">
                                            <?php else : ?>
                                              <input type="text" readonly class="form-control" id="role_id" name="role_id" value="<?= 'USER'; ?>">
                                            <?php endif; ?>
                                          </div>
                                          <div class="mb-3">
                                            <label for="date_created" class="form-label">Date created</label>
                                            <input type="text" readonly class="form-control" id="date_created" name="date_created" value="<?= date('d F Y', $u['date_created']); ?>">
                                          </div>
                                          <div class="form-group">
                                            <label for="is_active" class="form-label">Status
                                            </label>
                                            <?php if ($u['is_active'] == 1) : ?>
                                              <input type="text" readonly class="form-control" id="is_active" name="is_active" value="<?= 'Active'; ?>">
                                            <?php else : ?>
                                              <input type="text" readonly class="form-control" id="is_active" name="is_active" value="<?= 'Not Active'; ?>">
                                            <?php endif; ?>
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

                <!-- Modal -->
                <div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="newUserModalLabel">Add New User</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="<?= base_url('admin/users'); ?>" method="post">
                        <div class="modal-body">
                          <div class="mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Username">
                          </div>
                          <div class="mb-3">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                          </div>
                          <div class="mb-3">
                            <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                          </div>
                          <div class="mb-3">
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Retype Password">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Add User</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>