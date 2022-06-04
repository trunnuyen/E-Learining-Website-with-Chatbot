<?php

$my_courses = $this->user_model->my_courses()->result_array();

$categories = array();
foreach ($my_courses as $my_course) {
    $course_details = $this->crud_model->get_course_by_id($my_course['course_id'])->row_array();
    if (!in_array($course_details['category_id'], $categories)) {
        array_push($categories, $course_details['category_id']);
    }
}
?>
<section class="page-header-area my-course-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="page-title">Khóa học của bạn</h1>
                <ul>
                    <li class="active"><a href="<?php echo site_url('home/my_courses'); ?>">Tất cả khóa học</a></li>
                    <li><a href="<?php echo site_url('home/my_wishlist'); ?>">Wishlist</a></li>
                    <li><a href="<?php echo site_url('home/purchase_history'); ?>">Đã mua</a></li>
                    <li><a href="<?php echo site_url('home/profile/user_profile'); ?>">Thông tin cá nhân</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="my-courses-area">
    <div class="container">
        
        <div class="row no-gutters" id="my_courses_area">
            <?php foreach ($my_courses as $my_course) :
                $course_details = $this->crud_model->get_course_by_id($my_course['course_id'])->row_array();
                $instructor_details = $this->user_model->get_all_user($course_details['user_id'])->row_array(); ?>

                <div class="col-lg-3">
                    <div class="course-box-wrap">
                        <div class="course-box">
                            <a href="<?php echo site_url('home/lesson/' . slugify($course_details['title']) . '/' . $my_course['course_id']); ?>">
                                <div class="course-image">
                                    <img src="<?php echo $this->crud_model->get_course_thumbnail_url($my_course['course_id']); ?>" alt="" class="img-fluid">
                                    <span class="play-btn"></span>
                                </div>
                            </a>
                            <div class="course-details">
                                <a href="<?php echo site_url('home/course/' . slugify($course_details['title']) . '/' . $my_course['course_id']); ?>">
                                    <h5 class="title"><?php echo ellipsis($course_details['title']); ?></h5>
                                </a>
                                <div class="rating your-rating-box" >
                                    <?php
                                    for ($i = 1; $i < 6; $i++) : ?>                                    
                                            <i class="fas fa-star filled"></i>
                                    <?php endfor; ?>
                                    
                                </div>
                            </div>
                            <div class="row" style="padding: 5px;">
                                <div class="col-md-6">
                                    <a href="<?php echo site_url('home/course/' . slugify($course_details['title']) . '/' . $my_course['course_id']); ?>" class="btn">Chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<script type="text/javascript">
    function getCoursesByCategoryId(category_id) {
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('home/my_courses_by_category'); ?>',
            data: {
                category_id: category_id
            },
            success: function(response) {
                $('#my_courses_area').html(response);
            }
        });
    }

    function getCoursesBySearchString(search_string) {
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('home/my_courses_by_search_string'); ?>',
            data: {
                search_string: search_string
            },
            success: function(response) {
                $('#my_courses_area').html(response);
            }
        });
    }

    function getCourseDetailsForRatingModal(course_id) {
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('home/get_course_details'); ?>',
            data: {
                course_id: course_id
            },
            success: function(response) {
                $('#course_title_1').append(response);
                $('#course_title_2').append(response);
                $('#course_thumbnail_1').attr('src', "<?php echo base_url() . 'uploads/thumbnails/course_thumbnails/'; ?>" + course_id + ".jpg");
                $('#course_thumbnail_2').attr('src', "<?php echo base_url() . 'uploads/thumbnails/course_thumbnails/'; ?>" + course_id + ".jpg");
                $('#course_id_for_rating').val(course_id);
                // $('#instructor_details').text(course_id);
                console.log(response);
            }
        });
    }
</script>