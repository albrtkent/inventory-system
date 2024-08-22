<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }
  public function index()
  {
    $data['title'] = 'Dashboard';
    $data['sub_title'] = 'Dashboard';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/index', $data);
    $this->load->view('templates/footer');
  }

  public function role()
  {
    $data['title'] = 'Role';
    $data['sub_title'] = 'Role';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    // Get keyword data
    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    //Pagination Config
    $config['base_url'] = 'http://localhost/webisp/admin/role';
    $this->db->like('role', $data['keyword']);
    $this->db->from('user_role');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;

    // Initialize
    $config['prev_link'] =  '&laquo';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';


    $this->pagination->initialize($config);


    $data['start'] = $this->uri->segment(3);
    if ($data['keyword']) {
      $data['role'] = $this->db->like('role', $data['keyword']);
    }
    $data['role'] = $this->db->get('user_role', $config['per_page'], $data['start'], $data['keyword'])->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/role', $data);
    $this->load->view('templates/footer');
  }

  public function add_role()
  {
    $data['title'] = 'Role';
    $data['sub_title'] = 'Role';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();



    // Get keyword data
    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
    } else {
      $data['keyword'] = null;
    }

    //Pagination Config
    $config['base_url'] = 'http://localhost/webisp/admin/role';
    $this->db->like('role', $data['keyword']);
    $this->db->from('user_role');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;

    // Initialize
    $config['prev_link'] =  '&laquo';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';


    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $data['role'] = $this->db->get('user_role', $config['per_page'], $data['start'], $data['keyword'])->result_array();

    $this->form_validation->set_rules('role', 'Role name', 'is_unique[user_role.role]', [
      'is_unique' => 'This role has already exist!'
    ]);

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('admin/role', $data);
      $this->load->view('templates/footer');
    } else {
      $this->db->insert('user_role', ['role' => strtoupper($this->input->post('role'))]);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New role added!</div>');
      redirect('admin/role');
    }
  }

  public function edit_role()
  {
    $data['title'] = 'Role';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $data['role'] = $this->db->get('user_role')->result_array();
    $id = $this->input->post('id');
    $role = strtoupper($this->input->post('role'));
    $this->form_validation->set_rules('role', 'Role name', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('admin/role');
      $this->load->view('templates/footer');
    } else {
      $this->db->set('role', $role);
      $this->db->where('id', $id);
      $this->db->update('user_role');
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role updated!</div>');
      redirect('admin/role');
    }
  }

  public function roleAccess($role_id)
  {
    $data['title'] = 'Role';
    $data['sub_title'] = 'Role Access';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

    $this->db->where('id !=', 1);
    $data['menu'] = $this->db->get('user_menu')->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/role-access', $data);
    $this->load->view('templates/footer');
  }

  public function changeaccess()
  {
    $menu_id = $this->input->post('menuId');
    $role_id = $this->input->post('roleId');

    $data = [
      'role_id' => $role_id,
      'menu_id' => $menu_id
    ];

    $result = $this->db->get_where('user_access_menu', $data);

    if ($result->num_rows() < 1) {
      $this->db->insert('user_access_menu', $data);
    } else {
      $this->db->delete('user_access_menu', $data);
    }

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access changed!</div>');
  }

  public function users()
  {
    $data['title'] = 'Users';
    $data['sub_title'] = 'Users';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->load->model('Admin_model', 'admin');

    // Get keyword data
    if ($this->input->post('submit')) {
      $data['keyword_user'] = $this->input->post('keyword_user');
      $this->session->set_userdata('keyword_user', $data['keyword_user']);
    } else {
      $data['keyword_user'] = $this->session->userdata('keyword_user');
    }

    //Pagination Config
    $config['base_url'] = 'http://localhost/webisp/admin/users/';
    $this->db->like('name', $data['keyword_user']);
    $this->db->or_like('email', $data['keyword_user']);
    $this->db->from('user');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;

    // Initialize
    $config['prev_link'] =  '&laquo';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';


    $this->pagination->initialize($config);


    $data['start'] = $this->uri->segment(3);
    $data['users'] = $this->admin->getUsers($config['per_page'], $data['start'], $data['keyword_user']);
    $data['roles'] = $this->db->get('user_role')->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/users', $data);
    $this->load->view('templates/footer');
  }

  public function addUser()
  {
    $data['title'] = 'Users';
    $data['sub_title'] = 'Add User';

    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $data['users'] = $this->db->get('user')->result_array();

    $this->form_validation->set_rules('name', 'Name', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
      'is_unique' => 'This email has already exist!'
    ]);
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
      'matches' => 'Password doesnt match!',
      'min_length' => 'Password is too short!'
    ]);
    $this->form_validation->set_rules('password2', 'Password Verification', 'required|trim|matches[password1]');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('admin/users/adduser', $data);
      $this->load->view('templates/footer');
    } else {
      $data = [
        'name' => strtoupper(htmlspecialchars($this->input->post('name', true))),
        'email' => htmlspecialchars($this->input->post('email', true)),
        'image' => 'default.jpg',
        'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
        'role_id' => 2,
        'is_active' => 1,
        'date_created' => time()
      ];
      $this->db->insert('user', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New user added!</div>');
      redirect('admin/users');
    }
  }

  public function edit_user()
  {
    $data['title'] = 'Edit Users';
    $data['sub_title'] = 'Edit Users';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $data['users'] = $this->db->get('user')->result_array();
    $id = $this->input->post('id');

    $this->form_validation->set_rules('name', 'Name', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('admin/users', $data);
      $this->load->view('templates/footer');
    } else {
      $email = $this->input->post('email', true);
      $data = [
        'name' => strtoupper(htmlspecialchars($this->input->post('name', true))),
        'email' => strtolower(htmlspecialchars($email)),
        'image' => $this->input->post('image'),
        'password' => $this->input->post('password'),
        'role_id' => $this->input->post('role_id'),
        'is_active' => $this->input->post('is_active'),
        'date_created' => date($this->input->post('date_created'))
      ];
      $this->db->set($data);
      $this->db->where('id', $id);
      $this->db->update('user', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User data edited!</div>');
      redirect('admin/users');
    }
  }

  public function delete_user($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('user');
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User deleted!</div>');
    redirect('admin/users');
  }

  public function delete_role($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('user_role');
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role deleted!</div>');
    redirect('admin/role');
  }
}
