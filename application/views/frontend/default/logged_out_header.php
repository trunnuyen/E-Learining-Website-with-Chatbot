<section class="menu-area">
  <div class="container-xl">
    <div class="row">
      <div class="col">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

          <ul class="mobile-header-buttons">
            <li><a class="mobile-nav-trigger" href="#mobile-primary-nav">Menu<span></span></a></li>
            <li><a class="mobile-search-trigger" href="#mobile-search">Search<span></span></a></li>
          </ul>

          <a href="<?php echo site_url(''); ?>" class="navbar-brand" href="#"><img src="<?php echo base_url() . 'uploads/system/Cheems.jpg'; ?>" alt="" height="35"></a>

          <?php include 'menu.php'; ?>

          <form class="inline-form" action="<?php echo site_url('home/search'); ?>" method="get" style="width: 60%;">
            <div class="input-group search-box mobile-search">
              <input type="text" name='query' class="form-control" placeholder="Bạn muốn tìm khóa học nào">
              <div class="input-group-append">
                <button class="btn" type="submit"><i class="fas fa-search" style="color: #04AA6D;"></i></button>
              </div>
            </div>
          </form>

          <div class="cart-box menu-icon-box" id="cart_items">
            <?php include 'cart_items.php'; ?>
          </div>

          <span class="signin-box-move-desktop-helper"></span>
          <div class="sign-in-box btn-group">

            <a href="<?php echo site_url('home/login'); ?>" class="btn btn-sign-in">Đăng nhập</a>

            <a href="<?php echo site_url('home/sign_up'); ?>" class="btn btn-sign-up" style="background-color: #52ec73; border-color: #04AA6D;">Đăng ký</a>

          </div> <!--  sign-in-box end -->
        </nav>
      </div>
    </div>
  </div>
</section>