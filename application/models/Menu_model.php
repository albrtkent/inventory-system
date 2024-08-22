<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
  public function getSubMenu()
  {
    $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                  FROM `user_sub_menu` JOIN `user_menu`
                  ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                ";

    return $this->db->query($query)->result_array();
  }
  // Pagination
  public function SubMenuData($limit, $start, $keyword_sm = null)
  {
    $this->db->select('user_menu.menu, user_sub_menu.*');
    $this->db->from('user_menu');
    $this->db->join('user_sub_menu', 'user_sub_menu.menu_id = user_menu.id');
    $this->db->limit($limit, $start, $keyword_sm);
    if ($keyword_sm) {
      $this->db->like('title', $keyword_sm);
      $this->db->or_like('url', $keyword_sm);
      $this->db->or_like('icon', $keyword_sm);
      $this->db->or_like('menu', $keyword_sm);
    }
    $query = $this->db->get();
    return $query->result_array();
  }
  public function totalSubMenu()
  {
    return $this->db->count_all('user_sub_menu');
  }
}
