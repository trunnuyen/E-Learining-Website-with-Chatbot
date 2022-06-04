<section class="home-banner-area" style="background-image: url(<?php echo base_url('uploads/system/banner2.jpg'); ?>); background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;
    padding: 170px 0 130px;
    color: #fff;">
    <div class=" container-lg">
        <div class="row">
            <div class="col">
                <div class="home-banner-wrap">
                    <h2>Nơi có những khóa học lập trình chất lượng nhất</h2>
                    <p>Với các khóa học lập trình Online chúng tôi đảm bảo cung cấp đầy đủ kiến thức cho các bạn học viên để tự tin đi làm</p>
                    <form class="" action="<?php echo site_url('home/search'); ?>" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="query" placeholder="Bạn muốn tìm khóa học nào">
                            <div class="input-group-append">
                                <button class="btn" type="submit"><i class="fas fa-search" style="color: #04AA6D;"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section class=" home-fact-area" style="background-color: #52ec73;
    background: -webkit-linear-gradient(-45deg,#52ec73,#286e1a);
    background: -moz-linear-gradient(-45deg,#52ec73 0,#286e1a 100%);
    background: -ms-linear-gradient(-45deg,#52ec73 0,#286e1a 100%);
    background: -o-linear-gradient(-45deg,#52ec73 0,#286e1a 100%);
    background: linear-gradient(-45deg,#52ec73,#286e1a);
    color: #fff;
    padding: 15px 0;
    margin-bottom: 50px;">
    <div class="container-lg">
        <div class="row">
            <?php $courses = $this->crud_model->get_courses(); ?>
            <div class="col-md-4 d-flex">
                <div class="home-fact-box mr-md-auto ml-auto mr-auto">
                    <i class="fas fa-laptop-code float-left "></i>
                    <div class="text-box">
                        <a href="<?php echo site_url('home/courses'); ?>" style="color: #fff;">
                            <h4><?php
                                $status_wise_courses = $this->crud_model->get_status_wise_courses();
                                $number_of_courses = $status_wise_courses['active']->num_rows();
                                echo $number_of_courses . ' ' . "Khóa học"; ?></h4>
                        </a>
                        <p>Chọn khóa học phù hợp với bạn</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-flex">
                <div class="home-fact-box mr-md-auto ml-auto mr-auto">
                    <i class="fa fa-users float-left"></i>
                    <div class="text-box">
                        <a href="#teachers" style="color: #fff;">
                            <h4>Những giảng viên hàng đầu</h4>
                            <p>Đội ngũ giảng viên giàu kinh nghiệm và tận tâm</p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-flex">
                <div class="home-fact-box mr-md-auto ml-auto mr-auto">
                    <i class="fa fa-star float-left"></i>
                    <div class="text-box">
                        <a href="#review" style="color: #fff;">
                            <h4>Chất lượng đào tạo top đầu</h4>
                            <p>Đảm bạo việc làm cho các học viên</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="course-carousel-area">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <h2 class="course-carousel-title" style="padding-left: 1rem; font-size: 2rem">Top khóa học hàng đầu</h2>
                <div class="course-carousel">
                    <?php $top_courses = $this->crud_model->get_top_courses()->result_array();
                    $cart_items = $this->session->userdata('cart_items');
                    foreach ($top_courses as $top_course) : ?>
                        <div class="course-box-wrap">
                            <a href="<?php echo site_url('home/course/' . slugify($top_course['title']) . '/' . $top_course['id']); ?>" class="has-popover">
                                <div class="course-box">
                                    <!-- <div class="course-badge position best-seller">Best seller</div> -->
                                    <div class="course-image">
                                        <img src="<?php echo $this->crud_model->get_course_thumbnail_url($top_course['id']); ?>" alt="" class="img-fluid">
                                    </div>
                                    <div class="course-details">
                                        <h5 class="title"><?php echo $top_course['title']; ?></h5>
                                        <p class="instructors"><?php echo $top_course['short_description']; ?></p>
                                        <div class="rating">
                                            <?php
                                            for ($i = 1; $i < 6; $i++) : ?>                                               
                                                    <i class="fas fa-star filled"></i>                               
                                            <?php endfor; ?>
                                            <span class="d-inline-block average-rating"><?php echo $average_ceil_rating; ?></span>
                                        </div>
                                        <?php if ($top_course['is_free_course'] == 1) : ?>
                                            <p class="price text-right">Miễn phí</p>
                                        <?php else : ?>
                                            <?php if ($top_course['discount_flag'] == 1) : ?>
                                                <p class="price text-right"><small><?php echo currency($top_course['price']); ?></small><?php echo currency($top_course['discounted_price']); ?></p>
                                            <?php else : ?>
                                                <p class="price text-right"><?php echo currency($top_course['price']); ?></p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>

                            <div class="webui-popover-content">
                                <div class="course-popover-content">
                                    <?php if ($top_course['last_modified'] == "") : ?>
                                        <div class="last-updated"><?php echo "Ngày đăng tải:" . ' ' . date('D, d-M-Y', $top_course['date_added']); ?></div>
                                    <?php else : ?>
                                        <div class="last-updated"><?php echo "Cập nhật:" . ' ' . date('D, d-M-Y', $top_course['last_modified']); ?></div>
                                    <?php endif; ?>

                                    <div class="course-title">
                                        <a href="<?php echo site_url('home/course/' . slugify($top_course['title']) . '/' . $top_course['id']); ?>"><?php echo $top_course['title']; ?></a>
                                    </div>
                                    <div class="course-meta">
                                        <span class=""><i class="fas fa-play-circle"></i>
                                            28 videos
                                        </span>
                                        <span class=""><i class="far fa-clock"></i>
                                            30 tiếng
                                        </span>

                                    </div>
                                    <div class="course-subtitle"><?php echo $top_course['short_description']; ?></div>
                                    <div class="what-will-learn">
                                        <ul>
                                            <?php
                                            $outcomes = json_decode($top_course['outcomes']);
                                            foreach ($outcomes as $outcome) : ?>
                                                <li><?php echo $outcome; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="popover-btns">
                                        <?php if (is_purchased($top_course['id'])) : ?>
                                            <div class="purchased">
                                                <a href="<?php echo site_url('home/my_courses'); ?>">Đã đăng ký</a>
                                            </div>
                                        <?php else : ?>
                                            <?php if ($top_course['is_free_course'] == 1) :
                                                if ($this->session->userdata('user_login') != 1) {
                                                    $url = "#";
                                                } else {
                                                    $url = site_url('home/get_enrolled_to_free_course/' . $top_course['id']);
                                                } ?>
                                                <a href="<?php echo $url; ?>" class="btn add-to-cart-btn big-cart-button" onclick="handleEnrolledButton()">Tham gia</a>
                                            <?php else : ?>
                                                <button type="button" class="btn add-to-cart-btn <?php if (in_array($top_course['id'], $cart_items)) echo 'addedToCart'; ?> big-cart-button-<?php echo $top_course['id']; ?>" id="<?php echo $top_course['id']; ?>" onclick="handleCartItems(this)">
                                                    <?php
                                                    if (in_array($top_course['id'], $cart_items))
                                                        echo 'Đã thêm vào giỏ hàng';
                                                    else
                                                        echo get_phrase('Thêm vào giỏ hàng');
                                                    ?>
                                                </button>
                                                <button type="button" class="wishlist-btn <?php if ($this->crud_model->is_added_to_wishlist($top_course['id'])) echo 'active'; ?>" title="Danh sách mong muốn" onclick="handleWishList(this)" id="<?php echo $top_course['id']; ?>"><i class="fas fa-heart"></i></button>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="course-carousel-area">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <h2 class="course-carousel-title" style="padding-left: 1rem; font-size: 2rem">Top 10 khóa học mới nhất</h2>
                <div class="course-carousel">
                    <?php
                    $latest_courses = $this->crud_model->get_latest_10_course();
                    foreach ($latest_courses as $latest_course) : ?>
                        <div class="course-box-wrap">
                            <a href="<?php echo site_url('home/course/' . slugify($latest_course['title']) . '/' . $latest_course['id']); ?>">
                                <div class="course-box">
                                    <div class="course-image">
                                        <img src="<?php echo $this->crud_model->get_course_thumbnail_url($latest_course['id']); ?>" alt="" class="img-fluid">
                                    </div>
                                    <div class="course-details">
                                        <h5 class="title"><?php echo $latest_course['title']; ?></h5>                                      
                                        <div class="rating">
                                            <?php                               
                                            for ($i = 1; $i < 6; $i++) : ?>                                               
                                                    <i class="fas fa-star filled"></i>                                               
                                            <?php endfor; ?>
                                            <span class="d-inline-block average-rating"><?php echo $average_ceil_rating; ?></span>
                                        </div>
                                        <?php if ($latest_course['is_free_course'] == 1) : ?>
                                            <p class="price text-right">Miễn phí</p>
                                        <?php else : ?>
                                            <?php if ($latest_course['discount_flag'] == 1) : ?>
                                                <p class="price text-right"><small><?php echo currency($latest_course['price']); ?></small><?php echo currency($latest_course['discounted_price']); ?></p>
                                            <?php else : ?>
                                                <p class="price text-right"><?php echo currency($latest_course['price']); ?></p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="course-carousel-area">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <h2 class="course-carousel-title" style="padding-left: 1rem; font-size: 2rem">Khóa học đang giảm giá</h2>
                <div class="course-carousel">
                    <?php
                    $latest_courses = $this->crud_model->get_sales_course();
                    foreach ($latest_courses as $latest_course) : ?>
                        <div class="course-box-wrap">
                            <a href="<?php echo site_url('home/course/' . slugify($latest_course['title']) . '/' . $latest_course['id']); ?>">
                                <div class="course-box">
                                    <div class="course-image">
                                        <img src="<?php echo $this->crud_model->get_course_thumbnail_url($latest_course['id']); ?>" alt="" class="img-fluid">
                                    </div>
                                    <div class="course-details">
                                        <h5 class="title"><?php echo $latest_course['title']; ?></h5>                                      
                                        <div class="rating">
                                            <?php                                   
                                            for ($i = 1; $i < 6; $i++) : ?>                                             
                                                    <i class="fas fa-star filled"></i>                                             
                                            <?php endfor; ?>
                                            <span class="d-inline-block average-rating"><?php echo $average_ceil_rating; ?></span>
                                        </div>
                                        <?php if ($latest_course['is_free_course'] == 1) : ?>
                                            <p class="price text-right">Miễn phí</p>
                                        <?php else : ?>
                                            <?php if ($latest_course['discount_flag'] == 1) : ?>
                                                <p class="price text-right"><small><?php echo currency($latest_course['price']); ?></small><?php echo currency($latest_course['discounted_price']); ?></p>
                                            <?php else : ?>
                                                <p class="price text-right"><?php echo currency($latest_course['price']); ?></p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about">

    <div class="image">
        <img src="assets/frontend/default/img/about-img.jpg" alt="">
    </div>

    <div class="content">
        <h3 class="about-title">Tại sao bạn nên chọn chúng tôi</h3>
        <p>NT Elearning đã được nhiều tổ chức có uy tín trong và ngoài nước đánh giá cao và lựa chọn làm đối tác lâu dài bởi chất lượng sản phẩm và phong cách làm việc chuyên nghiệp của đội ngũ nhân viên. Với hơn 1000 khách hàng hài lòng về chúng tôi, NT Elearning tự tin mang lại thành quả tốt đẹp cho đối tác của mình. Với chuyên môn và kinh nghiệm đang có, NT Elearning mong mỏi và tự tin trở thành sự lựa chọn của Quý khách hàng.</p>
        <div class="icons-container">
            <div class="icons">
                <img src="assets/frontend/default/img/about-icon-1.png" alt="">
                <h3><?php
                    $status_wise_courses = $this->crud_model->get_status_wise_courses();
                    $number_of_courses = $status_wise_courses['active']->num_rows();
                    echo $number_of_courses; ?></h3>
                <span>Khóa học</span>
            </div>
            <div class="icons">
                <img src="assets/frontend/default/img/about-icon-2.png" alt="">
                <h3>1200+</h3>
                <span>students</span>
            </div>
            <div class="icons">
                <img src="assets/frontend/default/img/about-icon-3.png" alt="">
                <h3>10+</h3>
                <span>Giải thưởng</span>
            </div>
        </div>
    </div>

</section>

<!-- about section ends -->

<!-- teachers section starts  -->

<section class="teachers" id="teachers">

    <h1 class="heading">Những chuyên gia hàng đầu của chúng tôi</h1>

    <div class="swiper teachers-slider" style="padding-left: 2rem;">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="assets/frontend/default/img/teacher-jw.png" alt="">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>
                </div>
                <div class="content">
                    <h3>John Wick</h3>
                    <span><i class="fa fa-check" style="color:#52ec73;"></i> Senior Web Developer</span>
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="assets/frontend/default/img/teacher-2.png" alt="">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>
                </div>
                <div class="content">
                    <h3>john deo</h3>
                    <span><i class="fa fa-check" style="color:#52ec73;"></i> expert tutor</span>
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="assets/frontend/default/img/teacher-3.png" alt="">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>
                </div>
                <div class="content">
                    <h3>Diana Leona</h3>
                    <span><i class="fa fa-check" style="color:#52ec73;"></i> Java Senior Developer</span>
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="assets/frontend/default/img/teacher-4.png" alt="">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>
                </div>
                <div class="content">
                    <h3>john deo</h3>
                    <span><i class="fa fa-check" style="color:#52ec73;"></i> expert tutor</span>
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="assets/frontend/default/img/teacher-5.png" alt="">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>
                </div>
                <div class="content">
                    <h3>john deo</h3>
                    <span><i class="fa fa-check" style="color:#52ec73;"></i> expert tutor</span>
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="assets/frontend/default/img/teacher-6.png" alt="">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>
                </div>
                <div class="content">
                    <h3>john deo</h3>
                    <span><i class="fa fa-check" style="color:#52ec73;"></i> expert tutor</span>
                </div>
            </div>

        </div>

    </div>

</section>

<!-- teachers section ends -->

<!-- students reviews section starts  -->

<section class="reviews" id="review">

    <h1 class="heading"> Cảm nhận của học viên</h1>

    <div class="swiper reviews-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim animi atque numquam harum libero nemo, eligendi laboriosam beatae quo iure corrupti, neque rerum possimus non nisi quia! Cumque, tempora sit.</p>
                <img src="assets/frontend/default/img/pic-1.png" alt="">
                <h3>john deo</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>

            <div class="swiper-slide slide">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim animi atque numquam harum libero nemo, eligendi laboriosam beatae quo iure corrupti, neque rerum possimus non nisi quia! Cumque, tempora sit.</p>
                <img src="assets/frontend/default/img/pic-2.png" alt="">
                <h3>john deo</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>

            <div class="swiper-slide slide">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim animi atque numquam harum libero nemo, eligendi laboriosam beatae quo iure corrupti, neque rerum possimus non nisi quia! Cumque, tempora sit.</p>
                <img src="assets/frontend/default/img/pic-3.png" alt="">
                <h3>john deo</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>

            <div class="swiper-slide slide">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim animi atque numquam harum libero nemo, eligendi laboriosam beatae quo iure corrupti, neque rerum possimus non nisi quia! Cumque, tempora sit.</p>
                <img src="assets/frontend/default/img/pic-4.png" alt="">
                <h3>john deo</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>

            <div class="swiper-slide slide">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim animi atque numquam harum libero nemo, eligendi laboriosam beatae quo iure corrupti, neque rerum possimus non nisi quia! Cumque, tempora sit.</p>
                <img src="assets/frontend/default/img/pic-5.png" alt="">
                <h3>john deo</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>

            <div class="swiper-slide slide">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim animi atque numquam harum libero nemo, eligendi laboriosam beatae quo iure corrupti, neque rerum possimus non nisi quia! Cumque, tempora sit.</p>
                <img src="assets/frontend/default/img/pic-6.png" alt="">
                <h3>john deo</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>

        </div>

    </div>

</section>

<style>
    .about {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        gap: 3rem;
        margin-top: 5rem;
    }

    .about .image {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 40rem;
        flex: 1 1 40rem;
        padding-left: 2rem;
    }

    .about .image img {
        width: 100%;
    }

    .about .content {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 40rem;
        flex: 1 1 40rem;
    }

    .about .content .about-title {
        font-size: 2rem;
        text-transform: capitalize;
        color: #444;
    }

    .about .content p {
        font-size: 1rem;
        line-height: 2;
        color: #777;
        padding: 1rem 0;
    }

    .about .content .icons-container {
        margin-top: 1rem;
        display: -ms-grid;
        display: grid;
        -ms-grid-columns: (minmax(10rem, 1fr))[auto-fit];
        grid-template-columns: repeat(auto-fit, minmax(10rem, 1fr));
        gap: 2rem;
        padding-right: 3rem;
    }

    .about .content .icons-container .icons {
        text-align: center;
        border: 0.1rem solid #0eb582;
        background: #f0fdfa;
        padding: 3rem 2rem;
    }

    .about .content .icons-container .icons img {
        height: 3rem;
        margin-bottom: .3rem;
    }

    .about .content .icons-container .icons h3 {
        padding: .5rem 0;
        font-size: 2rem;
        text-transform: capitalize;
        color: #444;
    }

    .about .content .icons-container .icons span {
        font-size: 1.5rem;
        line-height: 2;
        color: #777;
    }

    .teachers {
        margin-top: 5rem;
    }


    .teachers .heading {
        font-size: 2rem;
        text-transform: capitalize;
        color: #444;
        padding: 3rem 2rem;
    }

    .teachers .slide {
        text-align: center;
    }

    .teachers .slide:hover .image img {
        background: #52ec73;
    }

    .teachers .slide:hover .image .share {
        bottom: 0;
    }

    .teachers .slide .image {
        position: relative;
        overflow: hidden;
    }

    .teachers .slide .image img {

        display: -ms-grid;
        display: grid;
        -ms-grid-columns: (minmax(10rem, 1fr))[auto-fit];
        grid-template-columns: repeat(auto-fit, minmax(10rem, 1fr));
        gap: 2rem;
        padding-right: 3rem;
        padding-left: 3rem;
    }

    .teachers .slide .image .share {
        position: absolute;
        bottom: -10rem;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.8);
        padding: 2rem;
    }

    .teachers .slide .image .share a {
        font-size: 1rem;
        margin: 0 1rem;
        color: #fff;
    }

    .teachers .slide .image .share a:hover {
        color: #0eb582;
    }

    .teachers .slide .content {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        padding-top: 1rem;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }

    .teachers .slide .content h3 {
        font-size: 1.5rem;
        text-transform: capitalize;
        color: #444;
        padding-left: 1rem;
    }

    .teachers .slide .content span {
        font-size: 1rem;
        line-height: 2;
        color: #777;
        padding-right: 1rem;
    }

    .reviews {
        margin-top: 5rem;
    }

    .reviews .heading {
        font-size: 2rem;
        text-transform: capitalize;
        color: #444;
        padding: 3rem 2rem;
    }

    .reviews .slide {
        text-align: center;
        padding: 3rem, 2rem;
        padding-left: 2rem;
        padding-right: 2rem;
        padding-bottom: 2rem;
    }

    .reviews .slide p {
        font-size: 1rem;
        line-height: 2;
        color: #777;
        position: relative;
        background: #f0fdfa;
        border: 0.1rem solid #0eb582;
        margin-bottom: 3rem;
        padding: 2rem;
    }

    .reviews .slide p::before {
        content: '';
        position: absolute;
        bottom: -1.2rem;
        left: 50%;
        -webkit-transform: translateX(-50%) rotate(45deg);
        transform: translateX(-50%) rotate(45deg);
        background: #f0fdfa;
        border-bottom: 0.1rem solid #0eb582;
        border-right: 0.1rem solid #0eb582;
        height: 2rem;
        width: 2rem;
    }

    .reviews .slide img {
        height: 7rem;
        width: 7rem;
        border-radius: 50%;
    }

    .reviews .slide h3 {
        font-size: 1.5rem;
        text-transform: capitalize;
        color: #444;
        padding: .5rem 0;
    }

    .reviews .slide .stars {
        font-size: 1.2rem;
        color: #0eb582;
    }
</style>

<script type="text/javascript">
    function handleWishList(elem) {

        $.ajax({
            url: '<?php echo site_url('home/handleWishList'); ?>',
            type: 'POST',
            data: {
                course_id: elem.id
            },
            success: function(response) {
                if (!response) {
                    window.location.replace("<?php echo site_url('login'); ?>");
                } else {
                    if ($(elem).hasClass('active')) {
                        $(elem).removeClass('active')
                    } else {
                        $(elem).addClass('active')
                    }
                    $('#wishlist_items').html(response);
                }
            }
        });
    }

    function handleCartItems(elem) {
        url1 = '<?php echo site_url('home/handleCartItems'); ?>';
        url2 = '<?php echo site_url('home/refreshWishList'); ?>';
        $.ajax({
            url: url1,
            type: 'POST',
            data: {
                course_id: elem.id
            },
            success: function(response) {
                $('#cart_items').html(response);
                if ($(elem).hasClass('addedToCart')) {
                    $('.big-cart-button-' + elem.id).removeClass('addedToCart')
                    $('.big-cart-button-' + elem.id).text("Thêm vào giỏ hàng");
                } else {
                    $('.big-cart-button-' + elem.id).addClass('addedToCart')
                    $('.big-cart-button-' + elem.id).text("Đã thêm vào giỏ hàng");
                }
                $.ajax({
                    url: url2,
                    type: 'POST',
                    success: function(response) {
                        $('#wishlist_items').html(response);
                    }
                });
            }
        });
    }

    function handleEnrolledButton() {
        $.ajax({
            url: '<?php echo site_url('home/isLoggedIn'); ?>',
            success: function(response) {
                if (!response) {
                    window.location.replace("<?php echo site_url('login'); ?>");
                }
            }
        });
    }

    var swiper = new Swiper(".teachers-slider", {
        loop: true,
        grabCursor: true,
        spaceBetween: 20,
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            991: {
                slidesPerView: 3,
            },
        },
    });

    var swiper = new Swiper(".reviews-slider", {
        loop: true,
        grabCursor: true,
        spaceBetween: 20,
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            991: {
                slidesPerView: 3,
            },
        },
    });
</script>