                <!-- Begin Page Content -->
                <div class="container-fluid">

                  <!-- Page Heading -->
                  <h1 class="h3 mb-2 text-gray-800 font-weight-bold card-body"><?= strtoupper($sub_title); ?></h1>
                  <div class="card">
                    <div class="card-body">
                      <div class="row">

                        <!-- Users Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                          <a style="text-decoration: none;" href="<?= base_url('admin/users') ?>" class="card border-left-primary shadow h-100 py-2 cardlinks">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Users</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $this->db->get('user')->num_rows(); ?></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                              </div>
                            </div>
                          </a>
                        </div>

                        <!-- Items Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                          <a style="text-decoration: none;" href="<?= base_url('user/items') ?>" class="card border-left-success shadow h-100 py-2 cardlinks">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Items</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $this->db->get('barang')->num_rows(); ?></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-box-open fa-2x text-gray-300"></i>
                                </div>
                              </div>
                            </div>
                          </a>
                        </div>

                        <!-- Item Category Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                          <a style="text-decoration: none;" href="<?= base_url('user/itemcategory') ?>" class="card border-left-info shadow h-100 py-2 cardlinks">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Item Category
                                  </div>
                                  <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $this->db->get('kategoribarang')->num_rows(); ?></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-layer-group fa-2x text-gray-300"></i>
                                </div>
                              </div>
                            </div>
                          </a>
                        </div>

                        <!-- Room Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                          <a style="text-decoration: none;" class="card border-left-warning shadow h-100 py-2 cardlinks" href="<?= base_url('user/room'); ?>">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Room</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $this->db->get('ruangan')->num_rows(); ?></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-store fa-2x text-gray-300"></i>
                                </div>
                              </div>
                            </div>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->