
                <!-- Begin Page Content -->
                <div class="container-fluid">

                  <!-- Page Heading -->
                  <h1 class="h3 mb-2 text-gray-800 font-weight-bold card-body"><?= strtoupper($sub_title); ?></h1>
                  <div class="card">
                    <div class="card-body">
                      <div class="col-lg">
                        <?= $this->session->flashdata('message'); ?>

                        <a href="<?= base_url('guest/export_itemcategory'); ?>" class="btn btn-success mb-3" style="float: right;">Export</a>

                        <!-- Searchbar -->
                        <div class="row mb-2">
                          <div class="col-md-8">
                            <form class="d-flex" action="<?= base_url('guest/itemcategory'); ?>" method="post">
                              <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search item category" name="keyword_ic" autocomplete="off" autofocus>
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
                            <th scope="col" class="htable">Item Code</th>
                            <th scope="col">Item Name</th>
                            <th scope="col" class="details-icon">Action</th>
                          </thead>
                          <tbody>
                            <?php if (empty($itemcategory)) : ?>
                              <tr>
                                <td colspan="7">
                                  <div class="alert alert-danger text-center" role="alert">
                                    Data not found.
                                  </div>
                                </td>
                              </tr>
                            <?php endif; ?>
                            <?php foreach ($itemcategory as $ic) : ?>
                              <tr>
                                <th scope="row"><?= ++$start; ?></th>
                                <td class="htable" hidden><?= $ic['id']; ?></td>
                                <td class="htable"><?= $ic['kodebarang']; ?></td>
                                <td><?= $ic['namabarang']; ?></td>
                                <td>
                                  <a href="<?= base_url('user/edititemcategory'); ?>" data-toggle="modal" data-target="#viewItemCategoryModal<?= $ic['id']; ?>"><i class="fas fa-fw fa-eye details-icon"></i></a>
                                 
                                </td>
                              </tr>
                           
                              <!-- View Item Modal -->
                              <div class="modal fade" id="viewItemCategoryModal<?= $ic['id']; ?>" tabindex="-1" aria-labelledby="viewItemCategoryModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="viewItemCategoryModalLabel">Item Category Detail</h5>
                                      <button type="button" class="btn-sm btn-primary" data-dismiss="modal" aria-label="Close"><i class="fas fa-fw fa-times"></i></button>
                                    </div>
                                    <form action="<?= base_url('user/edititemcategory'); ?>" method="post">
                                      <div class="modal-body">
                                        <div class="mb-3">
                                          <input type="hidden" class="form-control" id="id" name="id" value="<?= $ic['id']; ?>">
                                          <label for="code" class="form-label">Item Code
                                          </label>
                                          <input type="text" readonly class="form-control" id="code" name="code" value="<?= $ic['kodebarang']; ?>">
                                        </div>
                                        <div class="mb-3">
                                          <label for="name" class="form-label">Item Name
                                          </label>
                                          <input type="text" readonly class="form-control" id="name" name="name" value="<?= $ic['namabarang']; ?>">
                                        </div>
                                      </div>
                                      <div class="modal-footer">

                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                              <!-- End of View Item Category Modal -->
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