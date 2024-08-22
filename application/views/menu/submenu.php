                <!-- Begin Page Content -->
                <div class="container-fluid">

                  <!-- Page Heading -->
                  <h1 class="h3 mb-2 text-gray-800 font-weight-bold card-body"><?= strtoupper($sub_title); ?></h1>
                  <div class="card">
                    <div class=card-body>
                      <div class="row">
                        <div class="col-lg">
                          <?php if (validation_errors()) : ?>
                            <div class="alert alert-danger" role="alert">
                              <?= validation_errors(); ?>
                            </div>
                          <?php endif; ?>

                          <?= $this->session->flashdata('message'); ?>
                          <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubmenuModal">Add New Submenu</a>

                          <!-- Searchbar -->
                          <div class="row mb-2">
                            <div class="col-md-8">
                              <form class="d-flex" action="<?= base_url('menu/submenu'); ?>" method="post">
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" placeholder="Search submenu title" name="keyword_sm" autocomplete="off" autofocus>
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
                                <th scope="col">Title</th>
                                <th scope="col" class="htable">Url</th>
                                <th scope="col" class="htable">Icon</th>
                                <th scope="col">Menu</th>
                                <th scope="col" class="htable">Status</th>
                                <th scope="col">Action</th>

                              </tr>
                            </thead>
                            <tbody>
                              <?php if (empty($subMenu)) : ?>
                                <tr>
                                  <td colspan="7">
                                    <div class="alert alert-danger text-center" role="alert">
                                      Data not found.
                                    </div>
                                  </td>
                                </tr>
                              <?php endif; ?>
                              <?php foreach ($subMenu as $sm) : ?>
                                <tr>
                                  <th scope="row"><?= ++$start; ?></th>
                                  <td>
                                    <?php if ($sm['is_active'] == 1) : ?>
                                      <?= '<i class="fas fa-xs fa-circle text-success stats-icon""></i> '; ?>
                                    <?php else : ?>
                                      <?= '<i class="fas fa-xs fa-circle text-secondary stats-icon"></i> '; ?>
                                    <?php endif; ?>
                                    <?= $sm['title']; ?>
                                  </td>
                                  <td class="htable"><?= $sm['url']; ?></td>
                                  <td class="htable"><?= $sm['icon']; ?></td>
                                  <td><?= strtoupper($sm['menu']); ?></td>
                                  <td class="htable">
                                    <?php if ($sm['is_active'] == 1) : ?>
                                      <?= '<i class="fas fa-xs fa-circle text-success"></i> Active'; ?>
                                    <?php else : ?>
                                      <?= '<i class="fas fa-xs fa-circle text-secondary"></i> Not active'; ?>
                                    <?php endif; ?>
                                  </td>


                                  <td>
                                    <a href="<?= base_url('menu/edit_submenu'); ?>" data-toggle="modal" data-target="#viewSubMenuModal<?= $sm['id']; ?>"><i class="fas fa-fw fa-eye details-icon"></i></a>

                                    <!-- View Submenu Modal -->
                                    <div class="modal fade" id="viewSubMenuModal<?= $sm['id']; ?>" tabindex="-1" aria-labelledby="viewSubMenuModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="viewSubMenuModalLabel">Submenu Detail</h5>
                                            <button type="button" class="btn-sm btn-primary" data-dismiss="modal" aria-label="Close"><i class="fas fa-fw fa-times"></i></button>
                                          </div>
                                          <form action="<?= base_url('menu/edit_submenu'); ?>" method="post">
                                            <div class="modal-body">
                                              <div class="mb-3">
                                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $sm['id']; ?>">
                                                <label for="title" class="form-label">Title
                                                </label>
                                                <input type="text" readonly class="form-control" id="title" name="title" value="<?= $sm['title']; ?>">
                                              </div>
                                              <div class="mb-3">
                                                <label for="url" class="form-label">Url
                                                </label>
                                                <input type="text" readonly class="form-control" id="url" name="url" value="<?= $sm['url']; ?>">
                                              </div>
                                              <div class="mb-3">
                                                <label for="icon" class="form-label">Icon
                                                </label>
                                                <input type="text" readonly class="form-control" id="icon" name="icon" value="<?= $sm['icon']; ?>">
                                              </div>
                                              <div class="mb-3">
                                                <label for="menu" class="form-label">Menu</label>
                                                <input type="text" readonly class="form-control" id="menu" name="menu" value="<?= $sm['menu']; ?>">
                                              </div>
                                              <div class="form-group">
                                                <label for="is_active" class="form-label">Status
                                                </label>
                                                <?php if ($sm['is_active'] == 1) : ?>
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

                                    <!-- End of View Submenu Modal -->


                                    <a href="<?= base_url('menu/edit_submenu'); ?>" data-toggle="modal" data-target="#editSubmenuModal<?= $sm['id']; ?>"><i class="fas fa-fw fa-edit"></i></a>

                                    <!--Edit Submenu Modal -->
                                    <div class="modal fade" id="editSubmenuModal<?= $sm['id']; ?>" tabindex="-1" aria-labelledby="editSubmenuModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="editSubmenuModalLabel">Edit Submenu</h5>
                                            <button type="button" class="btn-sm btn-primary" data-dismiss="modal" aria-label="Close"><i class="fas fa-fw fa-times"></i></button>
                                          </div>
                                          <form action="<?= base_url('menu/edit_submenu'); ?>" method="post">
                                            <div class="modal-body">
                                              <div class="mb-3">
                                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $sm['id']; ?>">
                                                <label for="title" class="form-label">Title
                                                </label>
                                                <input type="text" required class="form-control" id="title" name="title" value="<?= $sm['title']; ?>">
                                              </div>
                                              <div class="form-group">
                                                <label for="menu_id" class="form-label">Menu
                                                </label>
                                                <select name="menu_id" id="menu_id" class="form-control">
                                                  <?php foreach ($menu as $m) : ?>
                                                    <?php if ($m['id'] == $sm['menu_id']) : ?>
                                                      <option selected value="<?= $sm['menu_id']; ?>"><?= strtoupper($m['menu']); ?></option>
                                                    <?php else : ?>
                                                      <option value="<?= $sm['menu_id']; ?>"><?= strtoupper($m['menu']); ?></option>
                                                    <?php endif; ?>
                                                  <?php endforeach; ?>
                                                </select>
                                              </div>
                                              <div class="mb-3">
                                                <label for="url" class="form-label">Url
                                                </label>
                                                <input required type="text" class="form-control" id="url" name="url" value="<?= $sm['url']; ?>">
                                              </div>
                                              <div class="mb-3">
                                                <label for="icon" class="form-label">Icon
                                                </label>
                                                <input required type="text" class="form-control" id="icon" name="icon" value="<?= $sm['icon']; ?>">
                                              </div>
                                              <div class="form-group">
                                                <div class="form-check">
                                                  <?php if ($sm['is_active'] == 1) : ?>
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
                                              <button type="submit" class="btn btn-primary">Edit Submenu</button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- End of Edit Modal -->


                                    

                                    <a href="" data-toggle="modal" data-target="#deleteSubmenuModal<?= $sm['id']; ?>"><i class="fas fa-fw fa-trash-alt"></i></a>
                                    <!--Delete Modal -->
                                    <div class="modal fade" id="deleteSubmenuModal<?= $sm['id']; ?>" tabindex="-1" aria-labelledby="deleteSubmenuModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="deleteSubmenuModalLabel">Confirmation</h5>
                                            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" aria-label="Close"><i class="fas fa-fw fa-times"></i></button>
                                          </div>
                                          <form action="<?= base_url('menu/delete_submenu/'); ?><?= $sm['id']; ?>" method="delete">
                                            <div class="modal-body">
                                              <div class="mb-3">
                                                <p>Apakah ingin menghapus data?</p>
                                                <input type="hidden" name="id" value="<?= $sm['id']; ?>">
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

                <!-- Modal -->
                <div class="modal fade" id="newSubmenuModal" tabindex="-1" aria-labelledby="newSubmenuModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="newSubmenuModalLabel">Add New Submenu</h5>
                        <button type="button" class="btn-sm btn-primary" data-dismiss="modal" aria-label="Close"><i class="fas fa-fw fa-times"></i></button>
                      </div>
                      <form action="<?= base_url('menu/addSubMenu'); ?>" method="post">
                        <div class="modal-body">
                          <div class="mb-3">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title" required>
                          </div>
                          <div class="form-group">
                            <select name="menu_id" id="menu_id" class="form-control">
                              <option value="">Select menu</option>
                              <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="mb-3">
                            <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url" required>
                          </div>
                          <div class="mb-3">
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon" required>
                          </div>
                          <div class="form-group">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked="checked">
                              <label class="form-check-label" for="is_active">Active</label>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Add Submenu</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>