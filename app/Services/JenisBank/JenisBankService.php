<?php

namespace App\Services\JenisBank;

use App\Repositories\JenisBank\JenisBankRepository;

class JenisBankService implements IJenisBankService
{
    private $jenisBankRepo;

    public function __construct()
    {
        $this->jenisBankRepo = new JenisBankRepository();
    }

    private function _queryDataTable($search, $order)
    {
        $column_order = ['id', 'nama']; //field yang ada di table user
        $column_search = ['id', 'nama']; //field yang diizin untuk pencarian
        $order_by = ['id' => 'asc']; // default order

        $query = $this->jenisBankRepo->getActive();

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
        $countAll = $this->jenisBankRepo->getActive()
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

    public function getJenisBanks()
    {
        return $this->jenisBankRepo->getActive()->get()->getResult();
    }

    public function saveData($data)
    {
        $message = 'Data berhasil disimpan';
        if ((int)$data['id'] > 0) {
            $message = 'Data berhasil diubah';
        }
        $this->jenisBankRepo->save($data);

        $response = [
        'status' => true,
        'message' => $message
        ];

        return $response;
    }

    public function removeData($data)
    {
        $data['is_active'] = false;
        $this->jenisBankRepo->save($data);

        $response = [
        'status' => true,
        'message' => 'Data berhasil dihapus'
        ];

        return $response;
    }
}
