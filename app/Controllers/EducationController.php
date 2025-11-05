<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Migrations\Educations;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EducationModel;

class EducationController extends BaseController
{
    protected $educationModel;

    public function __construct()
    {
        $this->educationModel = new EducationModel();
    }

    public function index()
    {
        $user = auth()->user();

        $educations = $this->educationModel->where('user_id', $user->id)
            ->orderBy('start_year', 'DESC')
            ->findAll();
        $data = [
            'title' => 'Pendidikan',
            'educations' => $educations,
        ];

        return view('admin/education/education', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Pendidikan'
        ];

        return view('admin/education/add_education', $data);
    }

    public function store()
    {

        if (! $this->validate('education')) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('logo');
        if ($file->getError() == 4) { // tidak ada file diupload
            return redirect()->back()
                ->withInput()
                ->with('errors', ['logo' => 'Logo wajib diisi.']);
        }

        $user = auth()->user();
        $userId = $user ? $user->id : null;

        $file = $this->request->getFile('logo');
        $newName = null;


        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'images/education', $newName);
        }

        $institution = $this->request->getPost('institution');
        $major = $this->request->getPost('major');
        $startYear = $this->request->getPost('start_year');
        $endYear = $this->request->getPost('end_year');

        if (empty($endYear)) {
            $endYear = null;
        }

        $this->educationModel->insert([
            'user_id'     => $userId,
            'logo'        => $newName,
            'institution' => $institution,
            'major'       => $major,
            'start_year'  => $startYear,
            'end_year'    => $endYear,
        ]);

        return redirect()->to('admin/pendidikan')->with('message', 'Data pendidikan berhasil disimpan!');
    }

    public function edit($id)
    {
        $education = $this->educationModel->find($id);

        if (!$education) {
            return redirect()->back()->with('message', 'Data pendidikan tidak ditemukan.');
        }

        $data = [
            "title" => 'Edit Pendidikan',
            "education" => $education
        ];

        return view("admin/education/edit_education", $data);
    }

    public function update($id)
    {
        if (!$this->validate('education')) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $education = $this->educationModel->find($id);
        if (!$education) {
            return redirect()->back()->with('message', 'Data tidak ditemukan.');
        }

        $file = $this->request->getFile('logo');
        $newName = $education['logo']; // default: pakai logo lama

        // Kalau upload baru
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'images/education', $newName);

            // hapus file lama
            if (!empty($education['logo']) && file_exists(FCPATH . 'images/education/' . $education['logo'])) {
                unlink(FCPATH . 'images/education/' . $education['logo']);
            }
        }

        // Ambil data dari form
        $data = [
            'institution' => $this->request->getPost('institution'),
            'major' => $this->request->getPost('major'),
            'start_year' => $this->request->getPost('start_year'),
            'end_year' => $this->request->getPost('end_year') ?: null,
            'logo' => $newName,
        ];

        $this->educationModel->update($id, $data);

        return redirect()->to(site_url('admin/pendidikan'))->with('message', 'Data pendidikan berhasil diperbarui!');
    }

    public function delete($id)
    {
        // Cari data education berdasarkan ID
        $education = $this->educationModel->find($id);

        if ($education) {
            // Hapus file logo kalau ada
            $logoPath = FCPATH . 'images/education/' . $education['logo'];
            if (is_file($logoPath)) {
                unlink($logoPath); // hapus file fisik
            }

            // Hapus data dari database
            $this->educationModel->delete($id);

            // Pesan sukses
            return redirect()->to('admin/pendidikan')
                ->with('message', 'Data pendidikan berhasil dihapus.');
        }

        // Kalau tidak ditemukan
        return redirect()->to('admin/pendidikan')
            ->with('message', 'Data tidak ditemukan.');
    }
}
