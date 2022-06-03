<?php
$social_links = json_decode($user_details['social_links'], true);
?>
<section class="page-header-area my-course-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="page-title">Thông tin người dùng</h1>
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
                            if($user_details['image'] != null){
                                echo base_url() . 'uploads/user_image/'.$this->session->userdata('user_id').'.jpg' ; }
                            else{
                                echo base_url() . 'uploads/user_image/placeholder1.png';
                            }
                            ?>" alt="" class="img-fluid">
                            
                            <div class="name">
                                <div class="name"><?php echo $user_details['first_name'] . ' ' . $user_details['last_name']; ?></div>
                            </div>
                        </div>
                        <div class="user-dashboard-menu">
                            <ul>
                                <li class="active"><a href="<?php echo site_url('home/profile/user_profile'); ?>">Thông tin</a></li>
                                <li><a href="<?php echo site_url('home/profile/user_credentials'); ?>">Tài khoản</a></li>
                                <li><a href="<?php echo site_url('home/profile/user_photo'); ?>">Ảnh đại diện</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="user-dashboard-content">
                        <div class="content-title-box">
                            <div class="title">Thông tin</div>
                        </div>
                        <form action="<?php echo site_url('home/update_profile/update_basics'); ?>" method="post">
                            <div class="content-box">
                                <div class="basic-group">
                                    <div class="form-group">
                                        <label for="FristName">Tên:</label>
                                        <input type="text" class="form-control" name="first_name" id="FristName" placeholder="Tên" value="<?php echo $user_details['first_name']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="LasstName">Họ:</label>
                                        <input type="text" class="form-control" name="last_name" placeholder="Họ" value="<?php echo $user_details['last_name']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="Biography">Bio:</label>
                                        <textarea class="form-control author-biography-editor" name="biography" id="Biography"><?php echo $user_details['biography']; ?></textarea>
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