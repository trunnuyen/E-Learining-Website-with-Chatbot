<div class="row ">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-body">
				<h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> Tài khoản admin</h4>
			</div> <!-- end card body-->
		</div> <!-- end card -->
	</div><!-- end col-->
</div>

<div class="row ">
	<div class="col-xl-7">
		<div class="card">
			<div class="card-body">
				<h4 class="header-title mb-3">Thông tin cá nhân</h4>
				<?php
				foreach($edit_data as $row):
					$social_links = json_decode($row['social_links'], true);?>
					<?php echo form_open(site_url('admin/manage_profile/update_profile_info/'.$row['id']) , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>

					<div class="form-group">
						<label>Tên</label>
						<input type="text" class="form-control" name="first_name" value="<?php echo $row['first_name'];?>" required/>
					</div>

					<div class="form-group">
						<label>Họ</label>
						<input type="text" class="form-control" name="last_name" value="<?php echo $row['last_name'];?>" required/>
					</div>

					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="email" value="<?php echo $row['email'];?>" required/>
					</div>

					<div class="form-group">
						<label>Mô tả</label>
						<textarea rows="5" class="form-control" name="title" placeholder="<?php echo get_phrase('a_short_title_about_yourself'); ?>" required><?php echo $row['title']; ?></textarea>
					</div>

					<div class="form-group">
						<label> Ảnh đại diện </label>
						<div class="d-flex mt-2">
                              <div class="">
                                  <img class = "rounded-circle img-thumbnail" src="<?php echo base_url('uploads/user_image/'.$row['id'].'.jpg');?>" alt="" style="height: 50px; width: 50px;">
                              </div>
                              <div class="flex-grow-1 pl-2">
                                  <div class="input-group">
                                      <div class="custom-file">
                                          <input type="file" class="custom-file-input" name = "user_image" id="user_image" onchange="changeTitleOfImageUploader(this)" accept="image/*">
                                          <label class="custom-file-label ellipsis" for="">Tải ảnh lên</label>
                                      </div>
                                  </div>
                              </div>
                          </div>
                    </div>

					<div class="row justify-content-center">
						<button type="submit" class="btn btn-primary">Lưu</button>
					</div>
				</form>
				<?php
			endforeach;
			?>
		</form>
	</div> <!-- end card body-->
</div> <!-- end card -->
</div>
<div class="col-xl-5">
	<div class="card">
		<div class="card-body">
			<?php foreach($edit_data as $row): ?>
				<?php echo form_open(site_url('admin/manage_profile/change_password/'.$row['id']) , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
				<div class="form-group">
					<label>Mật khẩu hiện tại</label>
					<input type="password" class="form-control" name="current_password" value="" required/>
				</div>
				<div class="form-group">
					<label>Mật khẩu mới</label>
					<input type="password" class="form-control" name="new_password" value="" required/>
				</div>
				<div class="form-group">
					<label>Nhập lại mật khẩu mới</label>
					<input type="password" class="form-control" name="confirm_password" value="" required/>
				</div>
				<div class="row justify-content-center">
					<button type="submit" class="btn btn-info">Đổi mật khẩu</button>
				</div>
			</form>
			<?php endforeach; ?>
		</div>
	</div>
</div>
</div>
