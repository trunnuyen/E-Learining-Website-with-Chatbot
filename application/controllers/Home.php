<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        // $this->load->library('stripe');
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        if (!$this->session->userdata('cart_items')) {
            $this->session->set_userdata('cart_items', array());
        }
    }

    public function index() {
        $this->home();
    }

    public function home() {
        $page_data['page_name'] = "home";
        $page_data['page_title'] = get_phrase('home');
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }

    public function shopping_cart() {
        if (!$this->session->userdata('cart_items')) {
            $this->session->set_userdata('cart_items', array());
        }
        $page_data['page_name'] = "shopping_cart";
        $page_data['page_title'] = get_phrase('shopping_cart');
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }

    public function courses() {
        if (!$this->session->userdata('layout')) {
            $this->session->set_userdata('layout', 'list');
        }
        $layout = $this->session->userdata('layout');
        $selected_category_id = "all";
        $selected_price = "all";
        $selected_level = "all";
        $selected_language = "all";
        $selected_rating = "all";
        // Get the category ids
        if (isset($_GET['category']) && !empty($_GET['category'] && $_GET['category'] != "all")) {
            $selected_category_id = $this->crud_model->get_category_id($_GET['category']);
        }

        // Get the selected price
        if (isset($_GET['price']) && !empty($_GET['price'])) {
            $selected_price = $_GET['price'];
        }

        // Get the selected level
        if (isset($_GET['level']) && !empty($_GET['level'])) {
            $selected_level = $_GET['level'];
        }



        if ($selected_category_id == "all" && $selected_price == "all" && $selected_level == 'all' && $selected_language == 'all' && $selected_rating == 'all') {
            $this->db->where('status', 'active');
            $total_rows = $this->db->get('course')->num_rows();
            $config = array();
            $config = pagintaion($total_rows, 6);
            $config['base_url']  = site_url('home/courses/');
            $this->pagination->initialize($config);
            $this->db->where('status', 'active');
            $page_data['courses'] = $this->db->get('course', $config['per_page'], $this->uri->segment(3))->result_array();
        }else {
            $courses = $this->crud_model->filter_course($selected_category_id, $selected_price, $selected_level, $selected_language, $selected_rating);
            $page_data['courses'] = $courses;
        }

        $page_data['page_name']  = "courses_page";
        $page_data['page_title'] = get_phrase('courses');
        $page_data['layout']     = $layout;
        $page_data['selected_category_id']     = $selected_category_id;
        $page_data['selected_price']     = $selected_price;
        $page_data['selected_level']     = $selected_level;
        $page_data['selected_language']     = $selected_language;
        $page_data['selected_rating']     = $selected_rating;
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }

    public function set_layout_to_session() {
        $layout = $this->input->post('layout');
        $this->session->set_userdata('layout', $layout);
    }

    public function course($slug = "", $course_id = "") {
        $page_data['course_id'] = $course_id;
        $page_data['page_name'] = "course_page";
        $page_data['page_title'] = get_phrase('course');
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }


    public function my_courses() {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('home'), 'refresh');
        }
        $page_data['page_name'] = "my_courses";
        $page_data['page_title'] = get_phrase("my_courses");
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }

    public function my_wishlist() {
        if (!$this->session->userdata('cart_items')) {
            $this->session->set_userdata('cart_items', array());
        }
        $my_courses = $this->crud_model->get_courses_by_wishlists();
        $page_data['my_courses'] = $my_courses;
        $page_data['page_name'] = "my_wishlist";
        $page_data['page_title'] = get_phrase('my_wishlist');
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }

    public function purchase_history() {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('home'), 'refresh');
        }

        $total_rows = $this->crud_model->purchase_history($this->session->userdata('user_id'))->num_rows();
        $config = array();
        $config = pagintaion($total_rows, 3);
        $config['base_url']  = site_url('home/purchase_history');
        $this->pagination->initialize($config);
        $page_data['per_page']   = $config['per_page'];
        $page_data['page_name']  = "purchase_history";
        $page_data['page_title'] = get_phrase('purchase_history');
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }

    public function profile($param1 = "") {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('home'), 'refresh');
        }

        if ($param1 == 'user_profile') {
            $page_data['page_name'] = "user_profile";
            $page_data['page_title'] = get_phrase('user_profile');
        }elseif ($param1 == 'user_credentials') {
            $page_data['page_name'] = "user_credentials";
            $page_data['page_title'] = get_phrase('credentials');
        }elseif ($param1 == 'user_photo') {
            $page_data['page_name'] = "update_user_photo";
            $page_data['page_title'] = get_phrase('update_user_photo');
        }
        $page_data['user_details'] = $this->user_model->get_user($this->session->userdata('user_id'));
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }

    public function update_profile($param1 = "") {
        if ($param1 == 'update_basics') {
            $this->user_model->edit_user($this->session->userdata('user_id'));
        }elseif ($param1 == "update_credentials") {
            $this->user_model->update_account_settings($this->session->userdata('user_id'));
        }elseif ($param1 == "update_photo") {
            $this->user_model->upload_user_image($this->session->userdata('user_id'));
        }
        redirect(site_url('home/profile/user_profile'), 'refresh');
    }

    public function handleWishList() {
        if ($this->session->userdata('user_login') != 1) {
            echo false;
        }else {
            if (isset($_POST['course_id'])) {
                $course_id = $this->input->post('course_id');
                $this->crud_model->handleWishList($course_id);
            }
            $this->load->view('frontend/'.get_frontend_settings('theme').'/wishlist_items');
        }
    }
    public function handleCartItems() {
        if (!$this->session->userdata('cart_items')) {
            $this->session->set_userdata('cart_items', array());
        }

        $course_id = $this->input->post('course_id');
        $previous_cart_items = $this->session->userdata('cart_items');
        if (in_array($course_id, $previous_cart_items)) {
            $key = array_search($course_id, $previous_cart_items);
            unset($previous_cart_items[$key]);
        }else {
            array_push($previous_cart_items, $course_id);
        }

        $this->session->set_userdata('cart_items', $previous_cart_items);
        $this->load->view('frontend/'.get_frontend_settings('theme').'/cart_items');
    }

    public function handleCartItemForBuyNowButton() {
        if (!$this->session->userdata('cart_items')) {
            $this->session->set_userdata('cart_items', array());
        }

        $course_id = $this->input->post('course_id');
        $previous_cart_items = $this->session->userdata('cart_items');
        if (!in_array($course_id, $previous_cart_items)) {
            array_push($previous_cart_items, $course_id);
        }
        $this->session->set_userdata('cart_items', $previous_cart_items);
        $this->load->view('frontend/'.get_frontend_settings('theme').'/cart_items');
    }

    public function refreshWishList() {
        $this->load->view('frontend/'.get_frontend_settings('theme').'/wishlist_items');
    }

    public function refreshShoppingCart() {
        $this->load->view('frontend/'.get_frontend_settings('theme').'/shopping_cart_inner_view');
    }

    public function isLoggedIn() {
        if ($this->session->userdata('user_login') == 1)
        echo true;
        else
        echo false;
    }

    public function payment_success($method = "", $user_id = "", $amount_paid = "") {
        $this->crud_model->enrol_student($user_id);
        $this->crud_model->course_purchase($user_id, $method, $amount_paid);
        $this->session->set_userdata('cart_items', array());
        redirect('home', 'refresh');
    }

    public function my_courses_by_category() {
        $category_id = $this->input->post('category_id');
        $course_details = $this->crud_model->get_my_courses_by_category_id($category_id)->result_array();
        $page_data['my_courses'] = $course_details;
        $this->load->view('frontend/'.get_frontend_settings('theme').'/reload_my_courses', $page_data);
    }

    public function search($search_string = "") {
        if (isset($_GET['query']) && !empty($_GET['query'])) {
            $search_string = $_GET['query'];
            $page_data['courses'] = $this->crud_model->get_courses_by_search_string($search_string)->result_array();
        }else {
            redirect(site_url(), 'refresh');
        }

        if (!$this->session->userdata('layout')) {
            $this->session->set_userdata('layout', 'list');
        }
        $page_data['layout']     = $this->session->userdata('layout');
        $page_data['page_name'] = 'courses_page';
        $page_data['search_string'] = $search_string;
        $page_data['page_title'] = get_phrase('search_results');
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }
    public function my_courses_by_search_string() {
        $search_string = $this->input->post('search_string');
        $course_details = $this->crud_model->get_my_courses_by_search_string($search_string)->result_array();
        $page_data['my_courses'] = $course_details;
        $this->load->view('frontend/'.get_frontend_settings('theme').'/reload_my_courses', $page_data);
    }

    public function get_my_wishlists_by_search_string() {
        $search_string = $this->input->post('search_string');
        $course_details = $this->crud_model->get_courses_of_wishlists_by_search_string($search_string);
        $page_data['my_courses'] = $course_details;
        $this->load->view('frontend/'.get_frontend_settings('theme').'/reload_my_wishlists', $page_data);
    }

    public function reload_my_wishlists() {
        $my_courses = $this->crud_model->get_courses_by_wishlists();
        $page_data['my_courses'] = $my_courses;
        $this->load->view('frontend/'.get_frontend_settings('theme').'/reload_my_wishlists', $page_data);
    }

    public function get_course_details() {
        $course_id = $this->input->post('course_id');
        $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
        echo $course_details['title'];
    }

    public function about_us() {
        $page_data['page_name'] = 'about_us';
        $page_data['page_title'] = get_phrase('about_us');
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }

    public function terms_and_condition() {
        $page_data['page_name'] = 'terms_and_condition';
        $page_data['page_title'] = get_phrase('terms_and_condition');
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }

    public function privacy_policy() {
        $page_data['page_name'] = 'privacy_policy';
        $page_data['page_title'] = get_phrase('privacy_policy');
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }

    public function get_enrolled_to_free_course($course_id) {
        if ($this->session->userdata('user_login') == 1) {
            $this->crud_model->enrol_to_free_course($course_id, $this->session->userdata('user_id'));
            redirect(site_url('home/my_courses'), 'refresh');
        }else {
            redirect(site_url('login'), 'refresh');
        }
    }

    public function login() {
        if ($this->session->userdata('admin_login')) {
            redirect(site_url('admin'), 'refresh');
        }elseif ($this->session->userdata('user_login')) {
            redirect(site_url('user'), 'refresh');
        }
        $page_data['page_name'] = 'login';
        $page_data['page_title'] = get_phrase('login');
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }

    public function sign_up() {
        if ($this->session->userdata('admin_login')) {
            redirect(site_url('admin'), 'refresh');
        }elseif ($this->session->userdata('user_login')) {
            redirect(site_url('user'), 'refresh');
        }
        $page_data['page_name'] = 'sign_up';
        $page_data['page_title'] = get_phrase('sign_up');
        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);
    }

}
