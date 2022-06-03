<section class="page-header-area my-course-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="page-title">Thông tin tài khoản</h1>
                <ul>
                    <li><a href="<?php echo site_url('home/my_courses'); ?>">Tất cả khóa học</a></li>
                    <li><a href="<?php echo site_url('home/my_wishlist'); ?>">Wishlist</a></li>
                    <li><a href="<?php echo site_url('home/purchase_history'); ?>">Đã mua</a></li>
                    <li class="active"><a href="">Thông tin cá nhân</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="user-dashboard-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="user-dashboard-box">
                    <div class="user-dashboard-sidebar">
                        <div class="user-box">
                            <img src="<?php
                                        if ($user_details['image'] != null) {
                                            echo base_url() . 'uploads/user_image/' . $this->session->userdata('user_id') . '.jpg';
                                        } else {
                                            echo base_url() . 'uploads/user_image/placeholder1.png';
                                        }
                                        ?>" alt="" class="img-fluid">
                            <div class="name"><?php echo $user_details['first_name'] . ' ' . $user_details['last_name']; ?></div>
                        </div>
                        <div class="user-dashboard-menu">
                            <ul>
                                <li><a href="<?php echo site_url('home/profile/user_profile'); ?>">Thông tin</a></li>
                                <li class="active"><a href="<?php echo site_url('home/profile/user_credentials'); ?>">Tài khoản</a></li>
                                <li><a href="<?php echo site_url('home/profile/user_photo'); ?>">Ảnh đại diện</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="user-dashboard-content">
                        <div class="content-title-box">
                            <div class="title">Tài khoản</div>
                        </div>
                        <form action="<?php echo site_url('home/update_profile/update_credentials'); ?>" method="post">
                            <div class="content-box">
                                <div class="email-group">
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="<?php echo get_phrase('email'); ?>" value="<?php echo $user_details['email']; ?>">
                                    </div>
                                </div>
                                <div class="password-group">
                                    <div class="form-group">
                                        <label for="password">Mật khẩu:</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Mật khẩu hiện tại">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="new_password" placeholder="Mật khẩu mới">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Nhập lại mật khẩu mới">
                                    </div>
                                </div>
                            </div>
                            <div class="content-update-box">
                                <button type="submit" class="btn">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>