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
}
