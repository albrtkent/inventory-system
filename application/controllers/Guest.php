<?php
defined('BASEPATH') or exit('No direct script access allowed');
require('./excel/vendor/autoload.php');

// Load library phpspreadsheet
require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet
class Guest extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model', 'user');
  }
  public function index()
  {
    $data['title'] = 'My Profile';
    $data['sub_title'] = 'My Profile';

    $this->load->view('templates/header', $data);
    $this->load->view('guest/sidebar', $data);
    $this->load->view('guest/topbar', $data);
    $this->load->view('guest/items', $data);
    $this->load->view('templates/footer');
  }
  public function items()
  {
    $data['title'] = 'Items';
    $data['sub_title'] = 'Items';
    $this->load->model('User_model', 'user');

    // Get keyword data
    if ($this->input->post('submit')) {
      $data['keyword_item'] = $this->input->post('keyword_item');
      $this->session->set_userdata('keyword_item', $data['keyword_item']);
    } else {
      $data['keyword_item'] = $this->session->userdata('keyword_item');
    }


    //Pagination Config
    $config['base_url'] = 'http://localhost/webisp/guest/items';
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
    $this->load->view('guest/sidebar', $data);
    $this->load->view('guest/topbar', $data);
    $this->load->view('guest/items', $data);
    $this->load->view('templates/footer');
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
    $config['base_url'] = 'http://localhost/webisp/guest/itemcategory';
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
    $this->load->view('guest/sidebar', $data);
    $this->load->view('guest/topbar', $data);
    $this->load->view('guest/itemcategory', $data);
    $this->load->view('templates/footer');
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
    $config['base_url'] = 'http://localhost/webisp/guest/room';
    $this->db->like('koderuangan', $data['keyword_room']);
    $this->db->or_like('uraianruangan', $data['keyword_room']);
    // $this->db->or_like('nfctagruangan', $data['keyword_room']);
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
      // $data['room'] = $this->db->or_like('nfctagruangan', $data['keyword_room']);
    }
    $data['room'] = $this->db->get('ruangan', $config['per_page'], $data['start'], $data['keyword_room'])->result_array();


    $this->load->view('templates/header', $data);
    $this->load->view('guest/sidebar', $data);
    $this->load->view('guest/topbar', $data);
    $this->load->view('guest/room', $data);
    $this->load->view('templates/footer');
  }
}
