<?php

class t_expenseModel extends CI_Model
{
  public function getTable($limit, $start)
  {


    $this->db->select('t_pengeluaran.id, t_pengeluaran.name,DATE_FORMAT(t_pengeluaran.date, "%w") AS day, DATE_FORMAT(t_pengeluaran.date, "%d-%M-%y") AS date, t_pengeluaran.biaya, t_pengeluaran.jumlah, t_pengeluaran.total, t_pengeluaran.keterangan, t_pengeluaran.status_data');
    $this->db->order_by('t_pengeluaran.date DESC');
    $this->db->where("t_pengeluaran.status_data != 'deleted'");

    $search_option = $this->input->post('search_option');
    if ($search_option == "by_date") {
      $date_start = date("Y-m-d", strtotime($this->input->post('date_start', true)));
      $date_end = date("Y-m-d", strtotime($this->input->post('date_end', true)));
      $this->db->where("DATE_FORMAT(t_pengeluaran.date, '%Y-%m-%d') >= '$date_start' AND DATE_FORMAT(t_pengeluaran.date, '%Y-%m-%d') <= '$date_end'");
    } else if ($search_option == "by_month") {
      $month = $this->input->post('month', true);
      $year = $this->input->post('year', true);
      $this->db->where("DATE_FORMAT(t_pengeluaran.date, '%m') = '$month' AND DATE_FORMAT(t_pengeluaran.date, '%Y') = '$year'");
    } else {
      $this->db->where("DATE_FORMAT(t_pengeluaran.date, '%Y-%m-%d') >= '" . date('Y-m-') . "01' AND DATE_FORMAT(t_pengeluaran.date, '%Y-%m-%d') <= '" . date('Y-m-d') . "'");
    }

    $get_table = $this->db->get('t_pengeluaran t_pengeluaran', $limit, $start);

    return $get_table->result_array();
  }

  public function countAllData()
  {
    $this->db->where("status_data != 'deleted'");
    $search_option = $this->input->post('search_option');
    if ($search_option == "by_date") {
      $date_start = date("Y-m-d", strtotime($this->input->post('date_start', true)));
      $date_end = date("Y-m-d", strtotime($this->input->post('date_end', true)));
      $this->db->where("DATE_FORMAT(t_pengeluaran.date, '%Y-%m-%d') >= '$date_start' AND DATE_FORMAT(t_pengeluaran.date, '%Y-%m-%d') <= '$date_end'");
    } else if ($search_option == "by_month") {
      $month = $this->input->post('month', true);
      $year = $this->input->post('year', true);
      $this->db->where("DATE_FORMAT(t_pengeluaran.date, '%m') = '$month' AND DATE_FORMAT(t_pengeluaran.date, '%Y') = '$year'");
    } else {
      $this->db->where("DATE_FORMAT(t_pengeluaran.date, '%Y-%m-%d') >= '" . date('Y-m-') . "01' AND DATE_FORMAT(t_pengeluaran.date, '%Y-%m-%d') <= '" . date('Y-m-d') . "'");
    }
    $get_table = $this->db->get('t_pengeluaran');
    return $get_table->num_rows();
  }

  public function sumPengeluaran()
  {
    $this->db->select_sum('t_pengeluaran.total');
    $this->db->where("status_data != 'deleted'");
    $search_option = $this->input->post('search_option');
    if ($search_option == "by_date") {
      $date_start = date("Y-m-d", strtotime($this->input->post('date_start', true)));
      $date_end = date("Y-m-d", strtotime($this->input->post('date_end', true)));
      $this->db->where("DATE_FORMAT(t_pengeluaran.date, '%Y-%m-%d') >= '$date_start' AND DATE_FORMAT(t_pengeluaran.date, '%Y-%m-%d') <= '$date_end'");
    } else if ($search_option == "by_month") {
      $month = $this->input->post('month', true);
      $year = $this->input->post('year', true);
      $this->db->where("DATE_FORMAT(t_pengeluaran.date, '%m') = '$month' AND DATE_FORMAT(t_pengeluaran.date, '%Y') = '$year'");
    } else {
      $this->db->where("DATE_FORMAT(t_pengeluaran.date, '%Y-%m-%d') >= '" . date('Y-m-') . "01' AND DATE_FORMAT(t_pengeluaran.date, '%Y-%m-%d') <= '" . date('Y-m-d') . "'");
    }
    $get_table = $this->db->get('t_pengeluaran');
    return $get_table->row_array();
  }

  public function getId($id)
  {
    $this->db->select('t_pengeluaran.id, t_pengeluaran.name, DATE_FORMAT(t_pengeluaran.date, "%d-%m-%Y") AS date, t_pengeluaran.biaya, t_pengeluaran.jumlah, t_pengeluaran.total, t_pengeluaran.keterangan, t_pengeluaran.status_data');
    $this->db->where("t_pengeluaran.status_data != 'deleted' AND t_pengeluaran.id = '$id'");
    $get_table = $this->db->get('t_pengeluaran t_pengeluaran');
    return $get_table->row_array();
  }

  public function insertData()
  {
    $date = date("Y-m-d", strtotime($this->input->post('date', true)));
    $biaya = str_replace(',', '', $this->input->post("biaya", true));
    $jumlah = $this->input->post('jumlah', true);
    $jumlah = $jumlah == "" ? 1 : $jumlah;
    $jumlah = $jumlah == 0 ? 1 : $jumlah;
    $data = [
      'name' => $this->input->post('name', true),
      'date' => $date,
      'biaya' => $biaya,
      'jumlah' => $jumlah,
      'total' => $jumlah * $biaya,
      'keterangan' => $this->input->post('keterangan', true),
      'status_data' => 'active'
    ];
    $this->db->insert('t_pengeluaran', $data);
  }

  public function deleteData($id)
  {
    $data = [
      'status_data' => 'deleted'
    ];
    $this->db->where('id', $id);
    $this->db->update('t_pengeluaran', $data);
  }

  public function editData($id)
  {
    $date = date("Y-m-d", strtotime($this->input->post('date', true)));
    $biaya = str_replace(',', '', $this->input->post("biaya", true));
    $jumlah = $this->input->post('jumlah', true);
    $jumlah = $jumlah == "" ? 1 : $jumlah;
    $jumlah = $jumlah == 0 ? 1 : $jumlah;
    $data = [
      'name' => $this->input->post('name', true),
      'date' => $date,
      'biaya' => $biaya,
      'jumlah' => $jumlah,
      'total' => $jumlah * $biaya,
      'keterangan' => $this->input->post('keterangan', true)
    ];
    $this->db->where('id', $id);
    $this->db->update('t_pengeluaran', $data);
  }
}
