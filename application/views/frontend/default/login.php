<section class="category-header-area">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('home'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">
                            <a href="#">
                                <?php echo $page_title; ?>
                            </a>
                        </li>
                    </ol>
                </nav>
                <h1 class="category-name">
                    Đăng nhập vào tài khoản của bạn
                </h1>
            </div>
        </div>
    </div>
</section>

<section class="category-course-list-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="user-dashboard-box mt-3">
                    <div class="user-dashboard-content w-100 login-form">
                        <div class="content-title-box">
                            <div class="title">Đăng nhập</div>
                            <div class="subtitle">Cung cấp địa chỉ email và mật khẩu của bạn.</div>
                        </div>
                        <form action="<?php echo site_url('login/validate_login/user'); ?>" method="post">
                            <div class="content-box">
                                <div class="basic-group">
                                    <div class="form-group">
                                        <label for="login-email"><span class="input-field-icon"><i class="fas fa-envelope"></i></span> Email:</label>
                                        <input type="email" class="form-control" name="email" id="login-email" placeholder="Email" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="login-password"><span class="input-field-icon"><i class="fas fa-lock"></i></span> Mật khẩu:</label>
                                        <input type="password" class="form-control" name="password" placeholder="mật khẩu" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="content-update-box">
                                <button type="submit" class="btn" style="background: #52ec73; border-color: #04AA6D;">Đăng nhập</button>
                            </div>
                            <div class="forgot-pass text-center">
                                <span>bạn</span>
                                <a href="javascript::" onclick="toggoleForm('forgot_password')">Quên mật khẩu?</a>
                            </div>
                            <div class="account-have text-center">
                                Bạn chưa có tài khoản? <a href="javascript::" onclick="toggoleForm('registration')">Tạo tài khoản mới</a>
                            </div>
                        </form>
                    </div>
                    <div class="user-dashboard-content w-100 register-form hidden">
                        <div class="content-title-box">
                            <div class="title">Đăng ký tài khoản</div>
                            <div class="subtitle">Đăng ký tài khoản mới để truy cập vào khóa học.</div>
                        </div>
                        <form action="<?php echo site_url('login/register'); ?>" method="post">
                            <div class="content-box">
                                <div class="basic-group">
                                    <div class="form-group">
                                        <label for="first_name"><span class="input-field-icon"><i class="fas fa-user"></i> Họ:</label>
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Nhập họ của bạn" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name"><span class="input-field-icon"><i class="fas fa-user"></i> Tên:</label>
                                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Nhập tên của bạn" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="registration-email"><span class="input-field-icon"><i class="fas fa-envelope"></i></span> Email:</label>
                                        <input type="email" class="form-control" name="email" id="registration-email" placeholder="Nhập email của bạn" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="registration-password"><span class="input-field-icon"><i class="fas fa-lock"></i></span> Mật khẩu:</label>
                                        <input type="password" class="form-control" name="password" id="registration-password" placeholder="Nhập mật khẩu" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="content-update-box">
                                <button type="submit" class="btn">Đăng ký</button>
                            </div>
                            <div class="account-have text-center">
                                Đã có tài khoản? <a href="javascript::" onclick="toggoleForm('login')">Đăng nhập</a>
                            </div>
                        </form>
                    </div>

                    <div class="user-dashboard-content w-100 forgot-password-form hidden">
                        <div class="content-title-box">
                            <div class="title">Quên mật khẩu</div>
                            <div class="subtitle">Nhập địa chỉ email của bạn để đặt lại mật khẩu.</div>
                        </div>
                        <form action="<?php echo site_url('login/forgot_password/frontend'); ?>" method="post">
                            <div class="content-box">
                                <div class="basic-group">
                                    <div class="form-group">
                                        <label for="forgot-email"><span class="input-field-icon"><i class="fas fa-envelope"></i></span> Email:</label>
                                        <input type="email" class="form-control" name="email" id="forgot-email" placeholder="Email" value="" required>
                                        <small class="form-text text-muted">Đường link đặt lại mật khẩu sẽ được gửi đến email của bạn.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="content-update-box">
                                <button type="submit" class="btn">Gửi</button>
                            </div>
                            <div class="forgot-pass text-center">
                                Trở về trang <a href="javascript::" onclick="toggoleForm('login')">Đăng nhập</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    function toggoleForm(form_type) {
        if (form_type === 'login') {
            $('.login-form').show();
            $('.forgot-password-form').hide();
            $('.register-form').hide();
        } else if (form_type === 'registration') {
            $('.login-form').hide();
            $('.forgot-password-form').hide();
            $('.register-form').show();
        } else if (form_type === 'forgot_password') {
            $('.login-form').hide();
            $('.forgot-password-form').show();
            $('.register-form').hide();
        }
    }
</script>