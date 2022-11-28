<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class KurirController extends BaseController
{
    private $kurirService;
    public function __construct()
    {
        $this->kurirService = Services::kurirService();
    }

    public function index(): string
    {
        $data = [
        'title' => 'Kurir',
        'parent' => 'Master Data',
        ];

        return view('kurir/index', $data);
    }

    public function getDataTable(): void
    {
        $post = (object)$this->request->getVar();
        $response = $this->kurirService->getDataTable($post);

        echo json_encode($response);
    }

    public function getKurirs(): void
    {
        $response = $this->kurirService->getKurirs();

        echo json_encode($response);
    }

    public function saveData(): void
    {
        $post = $this->request->getVar();
        $response = $this->kurirService->saveData($post);

        echo json_encode($response);
    }

    public function removeData(): void
    {
        $post = $this->request->getVar();
        $response = $this->kurirService->removeData($post);

        echo json_encode($response);
    }
}
