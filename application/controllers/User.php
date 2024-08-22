<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
require('./excel/vendor/autoload.php');

// Load library phpspreadsheet
require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet
class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('User_model', 'user');
  }
  public function index()
  {
    $data['title'] = 'My Profile';
    $data['sub_title'] = 'My Profile';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('user/index', $data);
    $this->load->view('templates/footer');
  }
  public function edit()
  {
    $data['title'] = 'My Profile';
    $data['sub_title'] = 'Edit Profile';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->form_validation->set_rules('name', 'Full name', 'required|trim');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('user/edit', $data);
      $this->load->view('templates/footer');
    } else {
      $name = strtoupper(htmlspecialchars($this->input->post('name')));
      $email = $this->input->post('email');

      // Check if there were image uploaded
      $upload_image = $_FILES['image']['name'];

      if ($upload_image) {
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']     = '2048';
        $config['upload_path'] = './assets/img/profile';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
          $old_image = $data['user']['image'];
          if ($old_image != 'default.jpg') {
            unlink(FCPATH . 'assets/img/profile/' . $old_image);
          }
          $new_image = $this->upload->data('file_name');
          $this->db->set('image', $new_image);
        } else {
          echo $this->upload->display_errors();
        }
      }

      $this->db->set('name', $name);
      $this->db->where('email', $email);
      $this->db->update('user');
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
      redirect('user');
    }
  }
  public function changepassword()
  {
    $data['title'] = 'My Profile';
    $data['sub_title'] = 'Change Password';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->form_validation->set_rules('current_password', 'Current password', 'required|trim');
    $this->form_validation->set_rules('new_password1', 'New password', 'required|trim|min_length[8]');
    $this->form_validation->set_rules('new_password2', 'Confirm new password', 'required|trim|min_length[8]|matches[new_password1]');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('user/changepassword', $data);
      $this->load->view('templates/footer');
    } else {
      $current_password = $this->input->post('current_password');
      $new_password = $this->input->post('new_password1');
      if (!password_verify($current_password, $data['user']['password'])) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Current password is incorrect!</div>');
        redirect('user/changepassword');
      } else {
        if ($current_password == $new_password) {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
          redirect('user/changepassword');
        } else {
          // Password Verif Done
          $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
          $this->db->set('password', $password_hash);
          $this->db->where('email', $this->session->userdata('email'));
          $this->db->update('user');

          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed successfully!</div>');
          redirect('user/changepassword');
        }
      }
    }
  }
  public function items()
  {
    $data['title'] = 'Items';
    $data['sub_title'] = 'Items';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->model('User_model', 'user');

    // Get keyword data
    if ($this->input->post('submit')) {
      $data['keyword_item'] = $this->input->post('keyword_item');
      $this->session->set_userdata('keyword_item', $data['keyword_item']);
    } else {
      $data['keyword_item'] = $this->session->userdata('keyword_item');
    }


    //Pagination Config
    $config['base_url'] = 'http://localhost/webisp/user/items';
    $this->db->like('keterangan', $data['keyword_item']);
    $this->db->or_like('tanggalperoleh', $data['keyword_item']);
    $this->db->or_like('nup', $data['keyword_item']);
    $this->db->or_like('merk', $data['keyword_item']);
    $this->db->or_like('namabarang', $data['keyword_item']);
    $this->db->or_like('nfctag', $data['keyword_item']);
    $this->db->or_like('uraianruangan', $data['keyword_item']);
    $this->db->or_like('barang.koderuangan', $data['keyword_item']);
    $this->db->or_like('barang.kodebarang', $data['keyword_item']);
    $this->db->from('barang');
    $this->db->join('kategoribarang', 'kategoribarang.kodebarang = barang.kodebarang');
    $this->db->join('ruangan', 'ruangan.koderuangan = barang.koderuangan');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;

    // Initialize
    $config['prev_link'] =  '&laquo';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';


    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);


    $data['itemData'] = $this->user->ItemData($config['per_page'], $data['start'], $data['keyword_item']);
    $data['item'] = $this->db->get('barang')->result_array();
    $data['itemcategory'] = $this->db->get('kategoribarang')->result_array();
    $data['room'] = $this->db->get('ruangan')->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('items/index', $data);
    $this->load->view('templates/footer');
  }

  public function addItems()
  {
    $data['title'] = 'Items';
    $data['sub_title'] = 'Add Items';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->model('User_model', 'user');

    $data['itemCategory'] = $this->db->get('kategoribarang')->result_array();
    $data['item'] = $this->db->get('barang')->result_array();
    $data['room'] = $this->db->get('ruangan')->result_array();

    $this->form_validation->set_rules('item_id', 'Item category', 'required|trim');
    $this->form_validation->set_rules('date_received', 'Date received', 'required|trim');
    $this->form_validation->set_rules('brand', 'Brand', 'required|trim');
    $this->form_validation->set_rules('nup', 'NUP', 'required|trim');
    $this->form_validation->set_rules('room_id', 'Room Code', 'required|trim');
    $this->form_validation->set_rules('item_detail', 'Item Detail', 'required|trim');
    $this->form_validation->set_rules('nfctag', 'NFC Tag', 'trim|required|is_unique[barang.nfctag]', [
      'is_unique' => 'This NFC tag has been registered.'
    ]);


    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('items/additems', $data);
      $this->load->view('templates/footer');
    } else {
      $data = [
        'kodebarang'        => $this->input->post('item_id'),
        'tanggalperoleh'  => $this->input->post('date_received'),
        'merk'          => $this->input->post('brand'),
        'nup'            => $this->input->post('nup'),
        'koderuangan'        => $this->input->post('room_id'),
        'keterangan'    => $this->input->post('item_detail'),
        'nfctag' => $this->input->post('nfctag')
      ];

      $this->db->insert('barang', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New item added!</div>');
      redirect('user/items');
    }
  }

  public function editItem()
  {
    $data['title'] = 'Items';
    $data['sub_title'] = 'Items';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


    $id = $this->input->post('id');
    $data = [
      'idbarang' => $id,
      'kodebarang' => $this->input->post('item_id'),
      'tanggalperoleh' => $this->input->post('date_received'),
      'merk' => $this->input->post('brand'),
      'nup' => $this->input->post('nup'),
      'koderuangan' => $this->input->post('room_id'),
      'keterangan' => $this->input->post('item_detail')
    ];


    $this->db->set($data);
    $this->db->where('idbarang', $id);
    $this->db->update('barang', $data);

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Item data updated!</div>');
    redirect('user/items');
  }

  public function deleteItems($id)
  {
    $this->db->where('idbarang', $id);
    $this->db->delete('barang');
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Item data deleted!</div>');
    redirect('user/items');
  }
  // Export Items
  public function export_items()
  {
    $items = $this->user->getItems();

    // Create new Spreadsheet object
    $spreadsheet = new Spreadsheet();

    // Set document properties
    $spreadsheet->getProperties()->setCreator('Inventory System')
      ->setLastModifiedBy('Inventory System')
      ->setTitle('Office 2007 XLSX Test Document')
      ->setSubject('Office 2007 XLSX Test Document')
      ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
      ->setKeywords('office 2007 openxml php')
      ->setCategory('Test result file');

    // Add some data
    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'No')
      ->setCellValue('B1', 'Item Code')
      ->setCellValue('C1', 'Date Received')
      ->setCellValue('D1', 'Category')
      ->setCellValue('E1', 'Brand')
      ->setCellValue('F1', 'NUP')
      ->setCellValue('G1', 'Room Code')
      ->setCellValue('H1', 'Room Name')
      ->setCellValue('I1', 'Item Detail')
      ->setCellValue('J1', 'NFC Tag');

    // https://phpspreadsheet.readthedocs.io/en/latest/topics/recipes/

    // $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(12);
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);

    $n = 1;
    $rowCount = 2;
    foreach ($items as $i) {
      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $rowCount, $n++)
        ->setCellValue('B' . $rowCount, $i->kodebarang)
        ->setCellValue('C' . $rowCount, $i->tanggalperoleh)
        ->setCellValue('D' . $rowCount, $i->namabarang)
        ->setCellValue('E' . $rowCount, $i->merk)
        ->setCellValue('F' . $rowCount, $i->nup)
        ->setCellValue('G' . $rowCount, $i->koderuangan)
        ->setCellValue('H' . $rowCount, $i->uraianruangan)
        ->setCellValue('I' . $rowCount, $i->keterangan)
        ->setCellValue('J' . $rowCount, $i->nfctag);
      $rowCount++;
    }

    // Rename worksheet
    $spreadsheet->getActiveSheet()->setTitle('Items Data ' . date('d-m-Y'));

    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $spreadsheet->setActiveSheetIndex(0);

    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Items Data.xlsx"');

    // If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    exit;
  }

  // Export Item Category
  public function export_itemcategory()
  {
    $itemcategory = $this->db->get('kategoribarang')->result();

    // Create new Spreadsheet object
    $spreadsheet = new Spreadsheet();

    // Set document properties
    $spreadsheet->getProperties()->setCreator('Inventory System')
      ->setLastModifiedBy('Inventory System')
      ->setTitle('Office 2007 XLSX Test Document')
      ->setSubject('Office 2007 XLSX Test Document')
      ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
      ->setKeywords('office 2007 openxml php')
      ->setCategory('Test result file');

    // Add some data
    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'No')
      ->setCellValue('B1', 'Item Code')
      ->setCellValue('C1', 'Item Name');

    // https://phpspreadsheet.readthedocs.io/en/latest/topics/recipes/

    // $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(12);
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);

    $n = 1;
    $rowCount = 2;
    foreach ($itemcategory as $ic) {
      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $rowCount, $n++)
        ->setCellValue('B' . $rowCount, $ic->kodebarang)
        ->setCellValue('C' . $rowCount, $ic->namabarang);
      $rowCount++;
    }

    // Rename worksheet
    $spreadsheet->getActiveSheet()->setTitle('Item Category Data ' . date('d-m-Y'));

    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $spreadsheet->setActiveSheetIndex(0);

    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Item Category Data.xlsx"');

    // If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    exit;
  }

  // Export Room Data
  public function export_room()
  {
    $room = $this->db->get('ruangan')->result();

    // Create new Spreadsheet object
    $spreadsheet = new Spreadsheet();

    // Set document properties
    $spreadsheet->getProperties()->setCreator('Inventory System')
      ->setLastModifiedBy('Inventory System')
      ->setTitle('Office 2007 XLSX Test Document')
      ->setSubject('Office 2007 XLSX Test Document')
      ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
      ->setKeywords('office 2007 openxml php')
      ->setCategory('Test result file');

    // Add some data
    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'No')
      ->setCellValue('B1', 'Room Code')
      ->setCellValue('C1', 'Room Name');
      // ->setCellValue('D1', 'NFC Tag');

    // https://phpspreadsheet.readthedocs.io/en/latest/topics/recipes/

    // $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(12);
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    // $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

    $n = 1;
    $rowCount = 2;
    foreach ($room as $r) {
      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $rowCount, $n++)
        ->setCellValue('B' . $rowCount, $r->koderuangan)
        ->setCellValue('C' . $rowCount, $r->uraianruangan);
        // ->setCellValue('D' . $rowCount, $r->nfctagruangan);
      $rowCount++;
    }

    // Rename worksheet
    $spreadsheet->getActiveSheet()->setTitle('Room Data ' . date('d-m-Y'));

    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $spreadsheet->setActiveSheetIndex(0);

    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Room Data.xlsx"');

    // If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    exit;
  }

  public function itemCategory()
  {
    $data['title'] = 'Item Category';
    $data['sub_title'] = 'Item Category';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    // Get keyword data
    if ($this->input->post('submit')) {
      $data['keyword_ic'] = $this->input->post('keyword_ic');
      $this->session->set_userdata('keyword_ic', $data['keyword_ic']);
    } else {
      $data['keyword_ic'] = $this->session->userdata('keyword_ic');
    }


    //Pagination Config
    $config['base_url'] = 'http://localhost/webisp/user/itemcategory';
    $this->db->like('namabarang', $data['keyword_ic']);
    $this->db->or_like('kodebarang', $data['keyword_ic']);
    $this->db->from('kategoribarang');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;

    // Initialize
    $config['prev_link'] =  '&laquo';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';


    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    if ($data['keyword_ic']) {
      $data['itemcategory'] = $this->db->like('namabarang', $data['keyword_ic']);
      $data['itemcategory'] = $this->db->or_like('kodebarang', $data['keyword_ic']);
    }
    $data['itemcategory'] = $this->db->get('kategoribarang', $config['per_page'], $data['start'], $data['keyword_ic'])->result_array();


    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('itemcategory/index', $data);
    $this->load->view('templates/footer');
  }

  public function addItemCategory()
  {
    $data['title'] = 'Item Category';
    $data['sub_title'] = 'Add Item Category';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->form_validation->set_rules('code', 'Item code', 'trim|required|is_unique[kategoribarang.kodebarang]', [
      'is_unique' => 'This item code has already exist.'
    ]);
    $this->form_validation->set_rules('name', 'Item name', 'trim|required|is_unique[kategoribarang.namabarang]', [
      'is_unique' => 'This item name has already exist.'
    ]);

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('itemcategory/additemcategory', $data);
      $this->load->view('templates/footer');
    } else {
      $data = [
        'kodebarang' => $this->input->post('code'),
        'namabarang' => $this->input->post('name')
      ];

      $this->db->insert('kategoribarang', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Item category added!</div>');
      redirect('user/itemcategory');
    }
  }

  public function editItemCategory()
  {
    $data['title'] = 'Item Category';
    $data['sub_title'] = 'Item Category';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


    $data['itemcategory'] = $this->db->order_by('id', 'DESC');
    $data['itemcategory'] = $this->db->get('kategoribarang')->result_array();

    $id = $this->input->post('id');
    $data = [
      'id' => $id,
      'kodebarang' => $this->input->post('code'),
      'namabarang' => $this->input->post('name')
    ];


    $this->db->set($data);
    $this->db->where('id', $id);
    $this->db->update('kategoribarang', $data);

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Item category updated!</div>');
    redirect('user/itemcategory');
  }

  public function deleteItemCategory($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('kategoribarang');
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Item category deleted!</div>');
    redirect('user/itemcategory');
  }

  public function room()
  {
    $data['title'] = 'Room';
    $data['sub_title'] = 'Room';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    // Get keyword data
    if ($this->input->post('submit')) {
      $data['keyword_room'] = $this->input->post('keyword_room');
      $this->session->set_userdata('keyword_room', $data['keyword_room']);
    } else {
      $data['keyword_room'] = $this->session->userdata('keyword_room');
    }

    //Pagination Config
    $config['base_url'] = 'http://localhost/webisp/user/room';
    $this->db->like('koderuangan', $data['keyword_room']);
    $this->db->or_like('uraianruangan', $data['keyword_room']);
    $this->db->or_like('nfctagruangan', $data['keyword_room']);
    $this->db->from('ruangan');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 5;

    // Initialize
    $config['prev_link'] =  '&laquo';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';


    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    if ($data['keyword_room']) {
      $data['room'] = $this->db->like('koderuangan', $data['keyword_room']);
      $data['room'] = $this->db->or_like('uraianruangan', $data['keyword_room']);
      $data['room'] = $this->db->or_like('nfctagruangan', $data['keyword_room']);
    }
    $data['room'] = $this->db->get('ruangan', $config['per_page'], $data['start'], $data['keyword_room'])->result_array();


    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('room/index', $data);
    $this->load->view('templates/footer');
  }
  public function addRoom()
  {
    $data['title'] = 'Room';
    $data['sub_title'] = 'Add Room';

    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->form_validation->set_rules('roomcode', 'Room code', 'trim|required|is_unique[ruangan.koderuangan]', [
      'is_unique' => 'This room code has been registered.'
    ]);
    $this->form_validation->set_rules('roomname', 'Room name', 'trim|required');
    // $this->form_validation->set_rules('nfctag', 'NFC Tag', 'trim|required|is_unique[ruangan.nfctagruangan]', [
    //   'is_unique' => 'This NFC tag has been registered.'
    // ]);

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('room/addroom', $data);
      $this->load->view('templates/footer');
    } else {
      $data = [
        'koderuangan' => $this->input->post('roomcode'),
        'uraianruangan' => $this->input->post('roomname'),
        'nfctagruangan' => $this->input->post('nfctag')
      ];

      $this->db->insert('ruangan', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New room added!</div>');
      redirect('user/room');
    }
  }

  public function editRoom()
  {
    $data['title'] = 'Room';

    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $data['room'] = $this->db->order_by('id', 'DESC');
    $data['room'] = $this->db->get('ruangan')->result_array();

    $id = $this->input->post('id');

    $data = [
      'koderuangan' => $this->input->post('roomcode'),
      'uraianruangan' => $this->input->post('roomname')
    ];

    $this->db->set($data);
    $this->db->where('id', $id);
    $this->db->update('ruangan', $data);

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Room data updated!</div>');
    redirect('user/room');
  }

  public function deleteRoom($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('ruangan');
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Room deleted!</div>');
    redirect('user/room');
  }
}
