<?php

namespace App\Services\Kurir;

use App\Repositories\Kurir\KurirRepository;
use Config\Database;

class KurirService implements IKurirService
{
    private $kurirRepo;

    public function __construct()
    {
        $this->kurirRepo = new KurirRepository();
    }

    private function _queryDataTable($search, $order)
    {
        $column_order = ['id', 'nama']; //field yang ada di table user
        $column_search = ['id', 'nama']; //field yang diizin untuk pencarian
        $order_by = ['id' => 'asc']; // default order

        $query = $this->kurirRepo->getActive();

        $query = datatableQuery($query, $search, $column_search, $column_order, $order, $order_by);

        return $query;
    }

    public function getDataTable($request)
    {
        $search = $request->search;
        $order = $request->order;
        $length = $request->length;
        $start = $request->start;
        $draw = $request->draw;

        $query = $this->_queryDataTable($search, $order);
        if ($length != -1) {
            $query = $query->limit($length, $start);
        }
        $query = $query->get();

        $list = $query->getResult();
        $countFilltered = $query->getNumRows();
        $countAll = $this->kurirRepo->getActive()
            ->get()
            ->getNumRows();

        foreach ($list as $i => $v) {
            $start++;
            $list[$i]->no = $start;
        }

        $response = [
        "draw" => $draw,
        "recordsTotal" => $countFilltered,
        "recordsFiltered" => $countAll,
        "data" => $list,
        ];


        return $response;
    }

    public function getKurirs()
    {
        $response = $this->kurirRepo
            ->getActive()
            ->get()
            ->getResult();

        return $response;
    }

    public function saveData($post)
    {
        $message = 'Data berhasil disimpan';
        $kurir = [
        'id' => $post['id'],
        'nama' => $post['nama'],
        'kategori' => $post['kategori'],
        'eta_awal' => $post['eta_awal'],
        'eta_akhir' => $post['eta_akhir'],
        ];

        if (isset($_FILES['image'])) {
            $file = $_FILES['image'];
            $filename = $file['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $upload_location = './uploads/kurir/';

            $new_name = time() . '.' . $ext;
            $path = $upload_location . $new_name;
            if (move_uploaded_file($file['tmp_name'], $path)) {
                $kurir['image'] = $new_name;
            }
        }

        if ((int)$kurir['id'] > 0) {
            $message = 'Data berhasil diubah';
            $kurir['updated_at'] = date('Y-m-d H:i:s');
        } else {
            $kurir['created_by'] = session()->get('user_id');
        }

        $db = Database::connect();
        $db->transStart();
        $this->kurirRepo->save($kurir);
        $db->transComplete();

        $response = [
        'status' => true,
        'message' => $message
        ];

        return $response;
    }

    public function removeData($data)
    {
        $data['is_active'] = false;
        $db = Database::connect();
        $db->transStart();

        $this->kurirRepo->save($data);

        $db->transComplete();

        $response = [
        'status' => true,
        'message' => 'Data berhasil dihapus'
        ];

        return $response;
    }
}
