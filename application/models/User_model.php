<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
  public function getItemCategory()
  {
    $query = "SELECT *
                  FROM `kategoribarang` JOIN `barang`
                  ON `kategoribarang`.`kodebarang` = `barang`.`kodebarang`
                ";

    return $this->db->query($query)->result_array();
  }
  public function ItemData($limit, $start, $keyword_item = null)
  {
    $this->db->select(
      'kategoribarang.kodebarang, kategoribarang.namabarang, barang.*, ruangan.koderuangan, ruangan.uraianruangan'
    );
    $this->db->from('kategoribarang');
    $this->db->join('barang', 'kategoribarang.kodebarang = barang.kodebarang');
    $this->db->join('ruangan', 'ruangan.koderuangan = barang.koderuangan');
    $this->db->limit($limit, $start, $keyword_item);
    if ($keyword_item) {
      $this->db->like('keterangan', $keyword_item);
      $this->db->or_like('uraianruangan', $keyword_item);
      $this->db->or_like('barang.koderuangan', $keyword_item);
      $this->db->or_like('tanggalperoleh', $keyword_item);
      $this->db->or_like('nfctag', $keyword_item);
      $this->db->or_like('barang.kodebarang', $keyword_item);
      $this->db->or_like('merk', $keyword_item);
      $this->db->or_like('namabarang', $keyword_item);
    }
    $query = $this->db->get();
    return $query->result_array();
  }
  public function totalItem()
  {
    return $this->db->count_all('barang');
  }

  // For Excel
  public function getItems()
  {

    $query = " SELECT `kategoribarang`.`kodebarang`, `kategoribarang`.`namabarang`, `barang`.*, `ruangan`.`koderuangan`, `ruangan`.`uraianruangan`
                FROM `kategoribarang` 
                JOIN `barang` ON `kategoribarang`.`kodebarang` = `barang`.`kodebarang`
                JOIN `ruangan` ON `ruangan`.`koderuangan` = `barang`.`koderuangan`
              ";

    return $this->db->query($query)->result();
  }
}
