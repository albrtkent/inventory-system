<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
  public function getUsers($limit, $start, $keyword_user = null)
  {
    if ($keyword_user) {
      $this->db->like('name', $keyword_user);
      $this->db->or_like('email', $keyword_user);
    }
    return $this->db->get('user', $limit, $start, $keyword_user)->result_array();
  }
}
