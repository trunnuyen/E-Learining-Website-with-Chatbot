<?php
$course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
$instructor_details = $this->user_model->get_all_user($course_details['user_id'])->row_array();
?>
<section class="course-header-area" style="background:green;">
  <div class="container">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="course-header-wrap">
          <h1 class="title"><?php echo $course_details['title']; ?></h1>
          <p class="subtitle"><?php echo $course_details['short_description']; ?></p>
          <div class="rating-row">
            <span class="course-badge best-seller"><?php echo ucfirst($course_details['level']); ?></span>
            <?php
            for ($i = 1; $i < 6; $i++) : ?>             
                <i class="fas fa-star filled" style="color: #f5c85b;"></i>
            <?php endfor; ?>
            <span class="d-inline-block average-rating"><?php echo $average_ceil_rating; ?></span><span>(2k Lượt đánh giá)</span>
            <span class="enrolled-num">
              <?php
              $number_of_enrolments = $this->crud_model->enrol_history($course_details['id'])->num_rows();
              echo $number_of_enrolments . ' ' . "Lượt đăng ký";
              ?>
            </span>
          </div>
          <div class="created-row">
            <span class="created-by">
              Người đăng:
              <a href="<?php echo site_url('home/instructor_page/' . $course_details['user_id']); ?>"><?php echo $instructor_details['first_name'] . ' ' . $instructor_details['last_name']; ?></a>
            </span>
            <?php if ($course_details['last_modified'] > 0) : ?>
              <span class="last-updated-date"><?php echo 'Câp nhật:' . ' ' . date('D, d-M-Y', $course_details['last_modified']); ?></span>
            <?php else : ?>
              <span class="last-updated-date"><?php echo 'Ngày đăng:' . ' ' . date('D, d-M-Y', $course_details['date_added']); ?></span>
            <?php endif; ?>
            <span class="comment">
              <a href="#student_reviews" ><i class="fas fa-comment"></i></a>
            </span>
          </div>
        </div>
      </div>
      <div class="col-lg-4">

      </div>
    </div>
  </div>
</section>


<section class="course-content-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">

        <div class="what-you-get-box">
          <div class="what-you-get-title">Khóa học này giúp bạn</div>
          <ul class="what-you-get__items">
            <?php foreach (json_decode($course_details['outcomes']) as $outcome) : ?>
              <?php if ($outcome != "") : ?>
                <li><?php echo $outcome; ?></li>
              <?php endif; ?>
            <?php endforeach; ?>
          </ul>
        </div>
        <br>

        <div class="requirements-box">
          <div class="requirements-title">Yêu cầu trước khi tham gia</div>
          <div class="requirements-content">
            <ul class="requirements__list">
              <?php foreach (json_decode($course_details['requirements']) as $requirement) : ?>
                <?php if ($requirement != "") : ?>
                  <li><?php echo $requirement; ?></li>
                <?php endif; ?>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <div class="description-box view-more-parent">
          <div class="view-more" onclick="viewMore(this,'hide')">+ Xem thêm</div>
          <div class="description-title">Mô tả khóa học</div>
          <div class="description-content-wrap">
            <div class="description-content">
              <?php echo $course_details['description']; ?>
            </div>
          </div>
        </div>


        <div class="compare-box view-more-parent">
          <div class="view-more" onclick="viewMore(this)">+ Xem thêm</div>
          <div class="compare-title">Khóa học liên quan</div>
          <div class="compare-courses-wrap">
            <?php
            $other_realted_courses = $this->crud_model->get_courses($course_details['category_id'], $course_details['sub_category_id'])->result_array();
            foreach ($other_realted_courses as $other_realted_course) :
              if ($other_realted_course['id'] != $course_details['id'] && $other_realted_course['status'] == 'active') : ?>
                <div class="course-comparism-item-container this-course">
                  <div class="course-comparism-item clearfix">
                    <div class="item-image float-left">
                      <a href="<?php echo site_url('home/course/' . slugify($other_realted_course['title']) . '/' . $other_realted_course['id']); ?>"><img src="<?php $this->crud_model->get_course_thumbnail_url($other_realted_course['id']); ?>" alt="" class="img-fluid"></a>
                      <div class="item-duration"><b><?php echo $this->crud_model->get_total_duration_of_lesson_by_course_id($other_realted_course['id']); ?></b></div>
                    </div>
                    <div class="item-title float-left">
                      <div class="title"><a href="<?php echo site_url('home/course/' . slugify($other_realted_course['title']) . '/' . $other_realted_course['id']); ?>"><?php echo $other_realted_course['title']; ?></a></div>
                      <?php if ($other_realted_course['last_modified'] > 0) : ?>
                        <div class="updated-time"><?php echo 'Cập nhật:' . ' ' . date('D, d-M-Y', $other_realted_course['last_modified']); ?></div>
                      <?php else : ?>
                        <div class="updated-time"><?php echo 'Cập nhật:' . ' ' . date('D, d-M-Y', $other_realted_course['date_added']); ?></div>
                      <?php endif; ?>
                    </div>
                    <div class="item-details float-left">
                      <span class="item-rating">
                        <i class="fas fa-star"></i>
                        <?php
                        $total_rating =  $this->crud_model->get_ratings('course', $other_realted_course['id'], true)->row()->rating;
                        $number_of_ratings = $this->crud_model->get_ratings('course', $other_realted_course['id'])->num_rows();
                        if ($number_of_ratings > 0) {
                          $average_ceil_rating = ceil($total_rating / $number_of_ratings);
                        } else {
                          $average_ceil_rating = 0;
                        }
                        ?>
                        <span class="d-inline-block average-rating"><?php echo $average_ceil_rating; ?></span>
                      </span>
                      <span class="enrolled-student">
                        <i class="far fa-user"></i>
                        <?php echo $this->crud_model->enrol_history($other_realted_course['id'])->num_rows(); ?>
                      </span>
                      <?php if ($other_realted_course['is_free_course'] == 1) : ?>
                        <span class="item-price">
                          <span class="current-price">Miễn phí</span>
                        </span>
                      <?php else : ?>
                        <?php if ($other_realted_course['discount_flag'] == 1) : ?>
                          <span class="item-price">
                            <span class="original-price"><?php echo currency($other_realted_course['price']); ?></span>
                            <span class="current-price"><?php echo currency($other_realted_course['discounted_price']); ?></span>
                          </span>
                        <?php else : ?>
                          <span class="item-price">
                            <span class="current-price"><?php echo currency($other_realted_course['price']); ?></span>
                          </span>
                        <?php endif; ?>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="student-feedback-box">
          <div class="student-feedback-title">
            Đánh giá
          </div>
          <div class="row">
            <div class="col-lg-3">
              <div class="average-rating">
                <div class="num">
                  
                </div>
                <div class="rating">
                  <?php
                  for ($i = 1; $i < 6; $i++) : ?>                    
                      <i class="fas fa-star filled" style="color: #f5c85b;"></i>                  
                  <?php endfor; ?>
                </div>
                <div class="title">Đánh giá của học viên</div>
              </div>
            </div>
            <div class="col-lg-9">
              <div class="individual-rating">
                <ul>
                  <?php for ($i = 1; $i <= 5; $i++) : ?>
                    <li>
                      <div class="progress">
                        <div class="progress-bar" style="width: <?php echo $this->crud_model->get_percentage_of_specific_rating($i, 'course', $course_id); ?>%"></div>
                      </div>
                      <div>
                        <span class="rating">
                          <?php for ($j = 1; $j <= (5 - $i); $j++) : ?>
                            <i class="fas fa-star"></i>
                          <?php endfor; ?>
                          <?php for ($j = 1; $j <= $i; $j++) : ?>
                            <i class="fas fa-star filled"></i>
                          <?php endfor; ?>

                        </span>
                        <span><?php echo $this->crud_model->get_percentage_of_specific_rating($i, 'course', $course_id); ?>%</span>
                      </div>
                    </li>
                  <?php endfor; ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="reviews" id="student_reviews">
            <div class="reviews-title">Cảm nhận</div>
            <ul>
              <?php
              $ratings = $this->crud_model->get_ratings('course', $course_id)->result_array();
              foreach ($ratings as $rating) :
              ?>
                <li>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="reviewer-details clearfix">
                        <div class="reviewer-img float-left">
                          <img src="<?php echo $this->user_model->get_user_image_url($rating['user_id']); ?>" alt="">
                        </div>
                        <div class="review-time">
                          <div class="time">
                            <?php echo date('D, d-M-Y', $rating['date_added']); ?>
                          </div>
                          <div class="reviewer-name">
                            <?php
                            $user_details = $this->user_model->get_user($rating['user_id'])->row_array();
                            echo $user_details['first_name'] . ' ' . $user_details['last_name'];
                            ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-8">
                      <div class="review-details">
                        <div class="rating">
                          <?php
                          for ($i = 1; $i < 6; $i++) : ?>
                            <?php if ($i <= $rating['rating']) : ?>
                              <i class="fas fa-star filled" style="color: #f5c85b;"></i>
                            <?php else : ?>
                              <i class="fas fa-star" style="color: #abb0bb;"></i>
                            <?php endif; ?>
                          <?php endfor; ?>
                        </div>
                        <div class="review-text">
                          <?php echo $rating['review']; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="course-sidebar natural">    
            <div class="preview-video-box">
              <a>
                <img src="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>" alt="" class="img-fluid">
                <span class="preview-text"></span>
                <span class="play-btn"></span>
              </a>
            </div>
          <div class="course-sidebar-text-box">
            <div class="price">
              <?php if ($course_details['is_free_course'] == 1) : ?>
                <span class="current-price"><span class="current-price">Miễn phí</span></span>
              <?php else : ?>
                <?php if ($course_details['discount_flag'] == 1) : ?>
                  <span class="current-price"><span class="current-price"><?php echo currency($course_details['discounted_price']); ?></span></span>
                  <span class="original-price"><?php echo currency($course_details['price']) ?></span>
                  <input type="hidden" id="total_price_of_checking_out" value="<?php echo currency($course_details['discounted_price']); ?>">
                <?php else : ?>
                  <span class="current-price"><span class="current-price"><?php echo currency($course_details['price']); ?></span></span>
                  <input type="hidden" id="total_price_of_checking_out" value="<?php echo currency($course_details['price']); ?>">
                <?php endif; ?>
              <?php endif; ?>
            </div>

            <?php if (is_purchased($course_details['id'])) : ?>
              <div class="already_purchased">
                <a href="<?php echo site_url('home/my_courses'); ?>">Đã đăng ký</a>
              </div>
            <?php else : ?>
              <?php if ($course_details['is_free_course'] == 1) : ?>
                <div class="buy-btns">
                  <?php if ($this->session->userdata('user_login') != 1) : ?>
                    <a href="#" class="btn btn-buy-now" onclick="handleEnrolledButton()">Đã đăng ký</a>
                  <?php else : ?>
                    <a href="<?php echo site_url('home/get_enrolled_to_free_course/' . $course_details['id']); ?>" class="btn btn-buy-now">Đăng ký ngay</a>
                  <?php endif; ?>
                </div>
              <?php else : ?>
                <div class="buy-btns">
                  <a href="<?php echo site_url('home/shopping_cart'); ?>" class="btn btn-buy-now" id="course_<?php echo $course_details['id']; ?>" onclick="handleBuyNow(this)">Mua ngay</a>
                  <?php if (in_array($course_details['id'], $this->session->userdata('cart_items'))) : ?>
                    <button class="btn btn-add-cart addedToCart" type="button" id="<?php echo $course_details['id']; ?>" onclick="handleCartItems(this)">Đã thêm vào giỏ hàng</button>
                  <?php else : ?>
                    <button class="btn btn-add-cart" type="button" id="<?php echo $course_details['id']; ?>" onclick="handleCartItems(this)">Thêm vào giỏ hàng</button>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
            <?php endif; ?>


            <div class="includes">
              <div class="title"><b>Trọn gói:</b></div>
              <ul>
                <li><i class="far fa-file-video"></i>
                  30 tiếng học
                </li>
                <li><i class="far fa-file"></i>28 bài giảng</li>
                <li><i class="far fa-compass"></i>Chất lượng Full HD</li>
                <li><i class="fas fa-mobile-alt"></i>Xem trên nhiều thiết bị</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
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
          $(elem).removeClass('addedToCart')
          $(elem).text("Thêm vào giỏ hàng");
        } else {
          $(elem).addClass('addedToCart')
          $(elem).text("Đã thêm vào giỏ hàng");
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

  function handleBuyNow(elem) {

    url1 = '<?php echo site_url('home/handleCartItemForBuyNowButton'); ?>';
    url2 = '<?php echo site_url('home/refreshWishList'); ?>';
    var explodedArray = elem.id.split("_");
    var course_id = explodedArray[1];

    $.ajax({
      url: url1,
      type: 'POST',
      data: {
        course_id: course_id
      },
      success: function(response) {
        $('#cart_items').html(response);
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
    console.log('here');
    $.ajax({
      url: '<?php echo site_url('home/isLoggedIn'); ?>',
      success: function(response) {
        if (!response) {
          window.location.replace("<?php echo site_url('login'); ?>");
        }
      }
    });
  }

  function viewMore(element, visibility) {
    if (visibility == 'hide') {
      $(element).parent('.view-more-parent').addClass('expanded');
      $(element).remove();
    } else if ($(element).hasClass('view-more')) {
      $(element).parent('.view-more-parent').addClass('expanded has-hide');
      $(element).removeClass('view-more').addClass('view-less').html('- View Less');
    } else if ($(element).hasClass('view-less')) {
      $(element).parent('.view-more-parent').removeClass('expanded has-hide');
      $(element).removeClass('view-less').addClass('view-more').html('+ View More');
    }
  }

</script>
