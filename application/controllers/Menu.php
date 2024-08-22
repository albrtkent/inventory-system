<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }
  public function index()
  {
    $data['title'] = 'Menu Management';
    $data['sub_title'] = 'Menu Management';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    // Get keyword data
    if ($this->input->post('submit')) {
      $data['keyword_menu'] = $this->input->post('keyword_menu');
      $this->session->set_userdata('keyword_menu', $data['keyword_menu']);
    } else {
      $data['keyword_menu'] = $this->session->userdata('keyword_menu');
    }

    //Pagination Config
    $config['base_url'] = 'http://localhost/webisp/menu/index';
    $this->db->like('menu', $data['keyword_menu']);
    $this->db->from('user_menu');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;

    // Initialize
    $config['prev_link'] =  '&laquo';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';


    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    if ($data['keyword_menu']) {
      $data['menu'] = $this->db->like('menu', $data['keyword_menu']);
    }
    $data['menu'] = $this->db->get('user_menu', $config['per_page'], $data['start'], $data['keyword_menu'])->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('menu/index', $data);
    $this->load->view('templates/footer');
  }
  public function addMenu()
  {
    $data['title'] = 'Menu Management';
    $data['sub_title'] = 'Menu Management';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
    redirect('menu');
  }


  public function submenu()
  {
    $data['title'] = 'Submenu Management';
    $data['sub_title'] = 'Submenu Management';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->model('Menu_model', 'menu');

    // Get keyword data
    if ($this->input->post('submit')) {
      $data['keyword_sm'] = $this->input->post('keyword_sm');
      $this->session->set_userdata('keyword_sm', $data['keyword_sm']);
    } else {
      $data['keyword_sm'] = $this->session->userdata('keyword_sm');
    }

    //Pagination Config
    $config['base_url'] = 'http://localhost/webisp/menu/submenu';
    $this->db->like('title', $data['keyword_sm']);
    $this->db->or_like('url', $data['keyword_sm']);
    $this->db->or_like('icon', $data['keyword_sm']);
    $this->db->or_like('menu', $data['keyword_sm']);
    $this->db->from('user_sub_menu');
    $this->db->join('user_menu', 'user_menu.id = user_sub_menu.menu_id');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;


    // Initialize
    $config['prev_link'] =  '&laquo';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';


    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);

    $data['subMenu'] = $this->menu->SubMenuData($config['per_page'], $data['start'], $data['keyword_sm']);
    $data['menu'] = $this->db->get('user_menu')->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('menu/submenu', $data);
    $this->load->view('templates/footer');
  }
  public function addSubMenu()
  {
    $data = [
      'title' => $this->input->post('title'),
      'menu_id' => $this->input->post('menu_id'),
      'url' => $this->input->post('url'),
      'icon' => $this->input->post('icon'),
      'is_active' => $this->input->post('is_active')
    ];
    $this->db->insert('user_sub_menu', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New submenu added!</div>');
    redirect('menu/submenu');
  }

  // Edit Menu
  public function edit_menu()
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $data['menu'] = $this->db->get('user_menu')->result_array();

    $id = $this->input->post('id');
    $menu = strtoupper($this->input->post('menu'));
    $this->form_validation->set_rules('menu', 'Menu', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('menu/index', $data);
      $this->load->view('templates/footer');
    } else {
      $this->db->set('menu', $menu);
      $this->db->where('id', $id);
      $this->db->update('user_menu');
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu updated!</div>');
      redirect('menu');
    }
  }

  // Edit Submenu
  public function edit_submenu()
  {
    $data['title'] = 'Edit Submenu';
    $data['sub_title'] = 'Submenu Management';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->model('Menu_model', 'menu');

    $data['subMenu'] = $this->menu->getSubMenu();
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $id = $this->input->post('id');

    $this->form_validation->set_rules('title', 'Title', 'required');


    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('menu/submenu', $data);
      $this->load->view('templates/footer');
    } else {
      $data = [
        'title' => $this->input->post('title'),
        'menu_id' => $this->input->post('menu_id'),
        'url' => $this->input->post('url'),
        'icon' => $this->input->post('icon'),
        'is_active' => $this->input->post('is_active')
      ];
      $this->db->set($data);
      $this->db->where('id', $id);
      $this->db->update('user_sub_menu', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu updated!</div>');
      redirect('menu/submenu');
    }
  }

  // Delete Menu
  public function delete($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('user_menu');
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu deleted!</div>');
    redirect('menu');
  }
  // Delete Submenu
  public function delete_submenu($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('user_sub_menu');
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu deleted!</div>');
    redirect('menu/submenu');
  }
}
