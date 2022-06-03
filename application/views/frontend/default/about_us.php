<section class="category-header-area">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('home'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">
                            <a href="#">
                                Liên hệ
                            </a>
                        </li>
                    </ol>
                </nav>
                <h1 class="category-name">
                    Liên hệ
                </h1>
            </div>
        </div>
    </div>
</section>

<section class="category-course-list-area">
    <div class="container">
        <div class="row">
            <div class="col" style="padding: 35px;">
                <h2>Thông tin liên hệ:</h2>
                <p>Email: ntelearning@edu.vn</p>
                <p>Hotline: (123) 1234 1234 - 098 7654 321 </p>
                <div id="address" style="float:left;">Địa chỉ: Đường Hàn Thuyên, khu phố 6 P, Thủ Đức, Thành phố Hồ Chí Minh, Việt Nam</div>
            </div>

            <div id="googleMap" style="width:100%;height:400px;"></div>

            <script>
                function myMap() {
                    var mapProp = {
                        center: new google.maps.LatLng(10.870010859921887, 106.80305224403946),
                        zoom: 17,
                    };
                    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
                }
            </script>

            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsqo7g6hSf6YV5sDCY6GmUoSsoVBmi1fs&callback=myMap"></script>
        </div>
    </div>
</section>