        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="transition: 0.4s;">

          <!-- Sidebar - Brand -->
          <div class="sidebar-brand d-flex align-items-center justify-content-center">
            <div class="sidebar-brand-icon">
              <i class="fas fa-truck-loading"></i>
            </div>
            <div class="sidebar-brand-text mx-3">INVENTORY SYTEM</div>
          </div>

          <!-- Divider -->
          <hr class="sidebar-divider">

          <!-- QUERY MENU -->
          <?php
          $role_id = $this->session->userdata('role_id');
          $queryMenu = "SELECT `user_menu`.`id`, `menu`
                            FROM `user_menu` JOIN `user_access_menu`
                            ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                            WHERE `user_access_menu`.`role_id` = 18
                            ORDER BY `user_access_menu`.`menu_id` ASC
                        ";
          $menu = $this->db->query($queryMenu)->result_array();
          ?>

          <!--Looping Menu -->
          <?php foreach ($menu as $m) : ?>
            <div class="sidebar-heading">

              <button style="text-align:left; color:white;" class="btn btn-block btn-toggle menutitle" data-toggle="collapse" data-target="#collapse<?= $m['menu']; ?>" aria-expanded="true">
                <span><?= strtoupper($m['menu']); ?></span>
              </button>
            </div>


            <!-- Siapkan Sub-Menu Sesuai Menu -->
            <?php
            $menuId = $m['id'];
            $querySubMenu = "SELECT *
                                    FROM `user_sub_menu` JOIN `user_menu`
                                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                                    WHERE `user_sub_menu`.`menu_id` = $menuId
                                    AND `user_sub_menu`.`is_active` = 1
                                ";
            $subMenu = $this->db->query($querySubMenu)->result_array();
            ?>

            <?php foreach ($subMenu as $sm) : ?>
              <div class="collapse show" id="collapse<?= $m['menu']; ?>">
                <div class="collapse-inner py-2">
                  <?php if ($title == $sm['title']) : ?>
                    <li class="nav-item active mb-0">
                    <?php else : ?>
                    <li class="nav-item mb-0">
                    <?php endif; ?>
                    <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                      <i class="<?= $sm['icon']; ?>"></i>
                      <span><?= $sm['title']; ?></span></a>
                    </li>
                </div>
              </div>
            <?php endforeach; ?>

            <!-- Divider -->
            <hr class="sidebar-divider mt-3">

          <?php endforeach; ?>

          <!-- Nav Item - Logout -->
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
              <i class="fas fa-sign-out-alt fa-fw"></i>
              <span>Logout</span></a>
          </li>
          <!-- Divider -->
          <hr class="sidebar-divider">
          <!-- Sidebar Toggler (Sidebar) -->
          <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
          </div>

        </ul>
        <!-- End of Sidebar -->