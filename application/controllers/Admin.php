<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
  public function __construct()
  {
    parent::__construct();

    $this->load->database();
    $this->load->library('session');
    /*cache control*/
    $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    $this->output->set_header('Pragma: no-cache');
    if (!$this->session->userdata('cart_items')) {
      $this->session->set_userdata('cart_items', array());
    }
  }

  public function index() {
    if ($this->session->userdata('admin_login') == true) {
      $this->dashboard();
    }else {
      redirect(site_url('login'), 'refresh');
    }
  }
  public function dashboard() {
    if ($this->session->userdata('admin_login') != true) {
      redirect(site_url('login'), 'refresh');
    }
    $page_data['page_name'] = 'dashboard';
    $page_data['page_title'] = get_phrase('dashboard');
    $this->load->view('backend/index.php', $page_data);
  }

  public function blank_template() {
    if ($this->session->userdata('admin_login') != true) {
      redirect(site_url('login'), 'refresh');
    }
    $page_data['page_name'] = 'blank_template';
    $this->load->view('backend/index.php', $page_data);
  }

  public function categories($param1 = "", $param2 = "") {
    if ($this->session->userdata('admin_login') != true) {
      redirect(site_url('login'), 'refresh');
    }

    if ($param1 == 'add') {
      $this->crud_model->add_category();
      
      redirect(site_url('admin/categories'), 'refresh');
    }
    elseif ($param1 == "edit") {
      $this->crud_model->edit_category($param2);
      
      redirect(site_url('admin/categories'), 'refresh');
    }
    elseif ($param1 == "delete") {
      $this->crud_model->delete_category($param2);
     
      redirect(site_url('admin/categories'), 'refresh');
    }
    $page_data['page_name'] = 'categories';
    $page_data['page_title'] = get_phrase('categories');
    $page_data['categories'] = $this->crud_model->get_categories($param2);
    $this->load->view('backend/index', $page_data);
  }

  public function category_form($param1 = "", $param2 = "") {
    if ($this->session->userdata('admin_login') != true) {
      redirect(site_url('login'), 'refresh');
    }
    if ($param1 == "add_category") {
      $page_data['page_name'] = 'category_add';
      $page_data['categories'] = $this->crud_model->get_categories()->result_array();
      $page_data['page_title'] = get_phrase('add_category');
    }
    if ($param1 == "edit_category") {
      $page_data['page_name'] = 'category_edit';
      $page_data['page_title'] = get_phrase('edit_category');
      $page_data['categories'] = $this->crud_model->get_categories()->result_array();
      $page_data['category_id'] = $param2;
    }

    $this->load->view('backend/index', $page_data);
  }

  public function sub_categories_by_category_id($category_id = 0) {
    if ($this->session->userdata('admin_login') != true) {
      redirect(site_url('login'), 'refresh');
    }

    $category_id = $this->input->post('category_id');
    redirect(site_url("admin/sub_categories/$category_id"), 'refresh');
  }

  public function sub_category_form($param1 = "", $param2 = "") {
    if ($this->session->userdata('admin_login') != true) {
      redirect(site_url('login'), 'refresh');
    }

    if ($param1 == 'add_sub_category') {
      $page_data['page_name'] = 'sub_category_add';
      $page_data['page_title'] = get_phrase('add_sub_category');
    }
    elseif ($param1 == 'edit_sub_category') {
      $page_data['page_name'] = 'sub_category_edit';
      $page_data['page_title'] = get_phrase('edit_sub_category');
      $page_data['sub_category_id'] = $param2;
    }
    $page_data['categories'] = $this->crud_model->get_categories();
    $this->load->view('backend/index', $page_data);
  }

  public function users($param1 = "", $param2 = "") {
    if ($this->session->userdata('admin_login') != true) {
      redirect(site_url('login'), 'refresh');
    }
    if ($param1 == "add") {
      $this->user_model->add_user();
      redirect(site_url('admin/users'), 'refresh');
    }
    elseif ($param1 == "edit") {
      $this->user_model->edit_user($param2);
      redirect(site_url('admin/users'), 'refresh');
    }
    elseif ($param1 == "delete") {
      $this->user_model->delete_user($param2);
      redirect(site_url('admin/users'), 'refresh');
    }

    $page_data['page_name'] = 'users';
    $page_data['page_title'] = get_phrase('student');
    $page_data['users'] = $this->user_model->get_user($param2);
    $this->load->view('backend/index', $page_data);
  }

  public function user_form($param1 = "", $param2 = "") {
    if ($this->session->userdata('admin_login') != true) {
      redirect(site_url('login'), 'refresh');
    }

    if ($param1 == 'add_user_form') {
      $page_data['page_name'] = 'user_add';
      $page_data['page_title'] = get_phrase('student_add');
      $this->load->view('backend/index', $page_data);
    }
    elseif ($param1 == 'edit_user_form') {
      $page_data['page_name'] = 'user_edit';
      $page_data['user_id'] = $param2;
      $page_data['page_title'] = get_phrase('student_edit');
      $this->load->view('backend/index', $page_data);
    }
  }

  public function enrol_history($param1 = "") {
    if ($this->session->userdata('admin_login') != true) {
      redirect(site_url('login'), 'refresh');
    }

    if ($param1 != "") {
      $date_range                   = $this->input->get('date_range');
      $date_range                   = explode(" - ", $date_range);
      $page_data['timestamp_start'] = strtotime($date_range[0]);
      $page_data['timestamp_end']   = strtotime($date_range[1]);
    }else {
      $page_data['timestamp_start'] = strtotime('-29 days', time());
      $page_data['timestamp_end']   = strtotime(date("m/d/Y"));
    }
    $page_data['page_name'] = 'enrol_history';
    $page_data['enrol_history'] = $this->crud_model->enrol_history_by_date_range($page_data['timestamp_start'], $page_data['timestamp_end']);
    $page_data['page_title'] = get_phrase('enrol_history');
    $this->load->view('backend/index', $page_data);
  }

  public function enrol_student($param1 = "") {
    if ($this->session->userdata('admin_login') != true) {
      redirect(site_url('login'), 'refresh');
    }
    if ($param1 == 'enrol') {
      $this->crud_model->enrol_a_student_manually();
      redirect(site_url('admin/enrol_history'), 'refresh');
    }
    $page_data['page_name'] = 'enrol_student';
    $page_data['page_title'] = get_phrase('enrol_a_student');
    $this->load->view('backend/index', $page_data);
  }
  public function admin_revenue($param1 = "") {
    if ($this->session->userdata('admin_login') != true) {
      redirect(site_url('login'), 'refresh');
    }

    if ($param1 != "") {
      $date_range                   = $this->input->post('date_range');
      $date_range                   = explode(" - ", $date_range);
      $page_data['timestamp_start'] = strtotime($date_range[0]);
      $page_data['timestamp_end']   = strtotime($date_range[1]);
    }else {
      $page_data['timestamp_start'] = strtotime('-29 days', time());
      $page_data['timestamp_end']   = strtotime(date("m/d/Y"));
    }

    $page_data['page_name'] = 'admin_revenue';
    $page_data['payment_history'] = $this->crud_model->get_revenue_by_user_type($page_data['timestamp_start'], $page_data['timestamp_end'], 'admin_revenue');
    $page_data['page_title'] = get_phrase('admin_revenue');
    $this->load->view('backend/index', $page_data);
  }

  function invoice($payment_id = "") {
    if ($this->session->userdata('admin_login') != true) {
      redirect(site_url('login'), 'refresh');
    }
    $page_data['page_name'] = 'invoice';
    $page_data['payment_details'] = $this->crud_model->get_payment_details_by_id($payment_id);
    $page_data['page_title'] = get_phrase('invoice');
    $this->load->view('backend/index', $page_data);
  }

  public function payment_history_delete($param1 = "", $redirect_to = "") {
    if ($this->session->userdata('admin_login') != true) {
      redirect(site_url('login'), 'refresh');
    }
    $this->crud_model->delete_payment_history($param1);
  
    redirect(site_url('admin/'.$redirect_to), 'refresh');
  }

  public function enrol_history_delete($param1 = "") {
    if ($this->session->userdata('admin_login') != true) {
      redirect(site_url('login'), 'refresh');
    }
    $this->crud_model->delete_enrol_history($param1);
   
    redirect(site_url('admin/enrol_history'), 'refresh');
  }

  public function purchase_history() {
    if ($this->session->userdata('admin_login') != true) {
      redirect(site_url('login'), 'refresh');
    }
    $page_data['page_name'] = 'purchase_history';
    $page_data['purchase_history'] = $this->crud_model->purchase_history();
    $page_data['page_title'] = get_phrase('purchase_history');
    $this->load->view('backend/index', $page_data);
  }

  public function courses() {
    if ($this->session->userdata('admin_login') != true) {
      redirect(site_url('login'), 'refresh');
    }


    $page_data['selected_category_id']   = isset($_GET['category_id']) ? $_GET['category_id'] : "all";
    $page_data['selected_instructor_id'] = isset($_GET['instructor_id']) ? $_GET['instructor_id'] : "all";
    $page_data['selected_price']         = isset($_GET['price']) ? $_GET['price'] : "all";
    $page_data['selected_status']        = isset($_GET['status']) ? $_GET['status'] : "all";
    $page_data['courses']                = $this->crud_model->filter_course_for_backend($page_data['selected_category_id'], $page_data['selected_instructor_id'], $page_data['selected_price'], $page_data['selected_status']);
    $page_data['status_wise_courses']    = $this->crud_model->get_status_wise_courses();
    $page_data['instructors']            = $this->user_model->get_instructor();
    $page_data['page_name']              = 'courses';
    $page_data['categories']             = $this->crud_model->get_categories();
    $page_data['page_title']             = get_phrase('active_courses');
    $this->load->view('backend/index', $page_data);
  }

  public function pending_courses() {
    if ($this->session->userdata('admin_login') != true) {
      redirect(site_url('login'), 'refresh');
    }


    $page_data['page_name'] = 'pending_courses';
    $page_data['page_title'] = get_phrase('pending_courses');
    $this->load->view('backend/index', $page_data);
  }

  public function course_actions($param1 = "", $param2 = "") {
    if ($this->session->userdata('admin_login') != true) {
      redirect(site_url('login'), 'refresh');
    }

    if ($param1 == "add") {
      $this->crud_model->add_course();
      redirect(site_url('admin/courses'), 'refresh');

    }
    elseif ($param1 == "edit") {
      $this->crud_model->update_course($param2);
      redirect(site_url('admin/courses'), 'refresh');

    }
    elseif ($param1 == 'delete') {
      $this->is_drafted_course($param2);
      $this->crud_model->delete_course($param2);
      redirect(site_url('admin/courses'), 'refresh');
    }
  }


  public function course_form($param1 = "", $param2 = "") {

    if ($this->session->userdata('admin_login') != true) {
      redirect(site_url('login'), 'refresh');
    }

    if ($param1 == 'add_course') {
      $page_data['categories'] = $this->crud_model->get_categories();
      $page_data['page_name'] = 'course_add';
      $page_data['page_title'] = get_phrase('add_course');
      $this->load->view('backend/index', $page_data);

    }elseif ($param1 == 'course_edit') {
      $this->is_drafted_course($param2);
      $page_data['page_name'] = 'course_edit';
      $page_data['course_id'] =  $param2;
      $page_data['page_title'] = get_phrase('edit_course');
      $page_data['categories'] = $this->crud_model->get_categories();
      $this->load->view('backend/index', $page_data);
    }
  }

  private function is_drafted_course($course_id){
    $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
    if ($course_details['status'] == 'draft') {

      redirect(site_url('admin/courses'), 'refresh');
    }
  }

  public function change_course_status($updated_status = "") {
    $course_id = $this->input->post('course_id');
    $category_id = $this->input->post('category_id');
    $instructor_id = $this->input->post('instructor_id');
    $price = $this->input->post('price');
    $status = $this->input->post('status');
  
    redirect(site_url('admin/courses?category_id='.$category_id.'&status='.$status.'&instructor_id='.$instructor_id.'&price='.$price), 'refresh');
  }

  public function change_course_status_for_admin($updated_status = "", $course_id = "", $category_id = "", $status = "", $instructor_id = "", $price = "") {
    $this->crud_model->change_course_status($updated_status, $course_id);
    redirect(site_url('admin/courses?category_id='.$category_id.'&status='.$status.'&instructor_id='.$instructor_id.'&price='.$price), 'refresh');
  }


  public function update_phrase_with_ajax() {
    $current_editing_language = $this->input->post('currentEditingLanguage');
    $updatedValue = $this->input->post('updatedValue');
    $key = $this->input->post('key');
    saveJSONFile($current_editing_language, $key, $updatedValue);
    echo $current_editing_language.' '.$key.' '.$updatedValue;
  }


  function get_list_of_directories_and_files($dir = APPPATH, &$results = array()) {
    $files = scandir($dir);
    foreach($files as $key => $value){
      $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
      if(!is_dir($path)) {
        $results[] = $path;
      } else if($value != "." && $value != "..") {
        $this->get_list_of_directories_and_files($path, $results);
        $results[] = $path;
      }
    }
    return $results;
  }

  function manage_profile($param1 = '', $param2 = '', $param3 = '')
  {
    if ($this->session->userdata('admin_login') != 1)
    redirect(site_url('login'), 'refresh');
    if ($param1 == 'update_profile_info') {
      $this->user_model->edit_user($param2);
      redirect(site_url('admin/manage_profile'), 'refresh');
    }
    if ($param1 == 'change_password') {
      $this->user_model->change_password($param2);
      redirect(site_url('admin/manage_profile'), 'refresh');
    }
    $page_data['page_name']  = 'manage_profile';
    $page_data['page_title'] = get_phrase('manage_profile');
    $page_data['edit_data']  = $this->db->get_where('users', array(
      'id' => $this->session->userdata('user_id')
    ))->result_array();
    $this->load->view('backend/index', $page_data);
  }

  public function ajax_get_sub_category($category_id) {
    $page_data['sub_categories'] = $this->crud_model->get_sub_categories($category_id);

    return $this->load->view('backend/admin/ajax_get_sub_category', $page_data);
  }
}
