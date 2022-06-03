<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="dripicons-network-1"></i> Thêm danh mục</h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <h4 class="mb-3 header-title">Thêm danh mục mới</h4>

                    <form class="required-form" action="<?php echo site_url('admin/categories/add'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="code">Mã danh mục</label>
                            <input type="text" class="form-control" id="code" name="code" value="<?php echo substr(md5(rand(0, 1000000)), 0, 10); ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="name">Tên<span class="required">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="parent">Danh mục cha</label>
                            <select class="form-control select2" data-toggle="select2" name="parent" id="parent" onchange="checkCategoryType(this.value)">
                                <option value="0">Không</option>
                                <?php foreach ($categories as $category) : ?>
                                    <?php if ($category['parent'] == 0) : ?>
                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group" id="icon-picker-area">
                            <label for="font_awesome_class">Icon hiển thị</label>
                            <input type="text" id="font_awesome_class" name="font_awesome_class" class="form-control icon-picker" autocomplete="off">
                        </div>

                        <div class="form-group" id="thumbnail-picker-area">
                            <label> Ảnh hiển thị <small>(Kích thước ảnh: 400 X 255)</small> </label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="category_thumbnail" name="category_thumbnail" accept="image/*" onchange="changeTitleOfImageUploader(this)">
                                    <label class="custom-file-label" for="category_thumbnail"></label>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary" onclick="checkRequiredFields()">Tạo</button>
                    </form>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<script type="text/javascript">
    function checkCategoryType(category_type) {
        if (category_type > 0) {
            $('#thumbnail-picker-area').hide();
            $('#icon-picker-area').hide();
        } else {
            $('#thumbnail-picker-area').show();
            $('#icon-picker-area').show();
        }
    }
</script>