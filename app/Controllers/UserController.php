<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new User(); // inisialisasi model
    }

    /**
     * GET /users
     */
    public function index()
    {
        $users = $this->model->findAll();
        return $this->response->setJSON($users);
    }

    /**
     * GET /users/{id}
     */
    public function show($id = null)
    {
        $user = $this->model->find($id);
        if (!$user) {
            return $this->response->setStatusCode(404)
                ->setJSON(['error' => "User dengan ID $id tidak ditemukan"]);
        }

        return $this->response->setJSON($user);
    }

    /**
     * POST /users
     * Menggunakan form-data atau x-www-form-urlencoded
     */
    public function create()
    {
        $data = $this->request->getPost(); // ambil semua data POST

        if (!$this->model->insert($data)) {
            return $this->response->setStatusCode(400)
                ->setJSON(['errors' => $this->model->errors()]);
        }

        $id = $this->model->getInsertID();
        $user = $this->model->find($id);

        return $this->response->setStatusCode(201)
            ->setJSON(['message' => 'User berhasil dibuat', 'data' => $user]);
    }

    /**
     * PUT /users/{id} atau PATCH /users/{id}
     * Mengambil data mentah (raw input) karena browser tidak bisa kirim PUT form-data
     */
    public function update($id = null)
    {
        $data = $this->request->getRawInput(); // ambil body mentah

        if (!$this->model->find($id)) {
            return $this->response->setStatusCode(404)
                ->setJSON(['error' => "User dengan ID $id tidak ditemukan"]);
        }

        if (!$this->model->update($id, $data)) {
            return $this->response->setStatusCode(400)
                ->setJSON(['errors' => $this->model->errors()]);
        }

        $user = $this->model->find($id);

        return $this->response->setJSON(['message' => "User dengan ID $id berhasil diperbarui", 'data' => $user]);
    }

    /**
     * DELETE /users/{id}
     */
    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->response->setStatusCode(404)
                ->setJSON(['error' => "User dengan ID $id tidak ditemukan"]);
        }

        $this->model->delete($id);

        return $this->response->setJSON(['message' => 'User berhasil dihapus', 'id' => $id]);
    }
}
