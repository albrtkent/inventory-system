                <!-- Begin Page Content -->
                <div class="container-fluid">
                  <h1 class="h3 mb-2 text-gray-800 font-weight-bold card-body"><?= strtoupper($sub_title); ?></h1>
                  <div class="card">
                    <!-- Page Heading -->
                    <div class="row ml-1 mt-3">
                      <div class="col-lg-5">
                        <?= $this->session->flashdata('message'); ?>
                      </div>
                    </div>
                    <div class="card-body mb-3 col-lg-8">
                      <div class="row g-0">
                        <div class="col-md-4">
                          <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                            <h5 class="card-title"><?= $user['name']; ?></h5>
                            <p class="card-text"><?= $user['email']; ?></p>
                            <p class="card-text"><small class="text-muted">Account created at <?= date('d F Y', $user['date_created']); ?></small></p>
                            <a href="<?= base_url('user/edit') ?>">
                              <button class="btn btn-primary">Edit Profile</button></a>
                            <a href="<?= base_url('user/changepassword') ?>">
                              <button class="btn btn-warning"> <i class="fas fa-key fa-fw"></i></button></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->