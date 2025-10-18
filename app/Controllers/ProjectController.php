<?php

namespace App\Controllers;

use App\Models\Project;

class ProjectController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new Project(); // inisialisasi model Project
    }

    /**
     * GET /projects
     */
    public function index()
    {
        $projects = $this->model->findAll();
        return $this->response->setJSON($projects);
    }

    /**
     * GET /projects/{id}
     */
    public function show($id = null)
    {
        $project = $this->model->find($id);
        if (!$project) {
            return $this->response->setStatusCode(404)
                ->setJSON(['error' => "Project dengan ID $id tidak ditemukan"]);
        }

        return $this->response->setJSON($project);
    }

    /**
     * POST /projects
     * Ambil data dari form-data / x-www-form-urlencoded
     */
    public function create()
    {
        $data = $this->request->getPost();

        if (!$this->model->insert($data)) {
            return $this->response->setStatusCode(400)
                ->setJSON(['errors' => $this->model->errors()]);
        }

        $id = $this->model->getInsertID();
        $project = $this->model->find($id);

        return $this->response->setStatusCode(201)
            ->setJSON(['message' => 'Project berhasil dibuat', 'data' => $project]);
    }

    /**
     * PUT /projects/{id} atau PATCH /projects/{id}
     * Ambil data mentah karena PUT/PATCH
     */
    public function update($id = null)
    {
        $data = $this->request->getRawInput();

        if (!$this->model->find($id)) {
            return $this->response->setStatusCode(404)
                ->setJSON(['error' => "Project dengan ID $id tidak ditemukan"]);
        }

        if (!$this->model->update($id, $data)) {
            return $this->response->setStatusCode(400)
                ->setJSON(['errors' => $this->model->errors()]);
        }

        $project = $this->model->find($id);

        return $this->response->setJSON(['message' => "Project dengan ID $id berhasil diperbarui", 'data' => $project]);
    }

    /**
     * DELETE /projects/{id}
     */
    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->response->setStatusCode(404)
                ->setJSON(['error' => "Project dengan ID $id tidak ditemukan"]);
        }

        $this->model->delete($id);

        return $this->response->setJSON(['message' => 'Project berhasil dihapus', 'id' => $id]);
    }
}
