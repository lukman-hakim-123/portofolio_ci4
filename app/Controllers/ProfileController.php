<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    public function index()
    {
        $user = auth()->user();

        $socialLinks = json_decode($user->social_links ?? '{}', true);

        $data = [
            'title' => 'Profile',
            'user'  => $user,
            'social_links' => $socialLinks,
        ];

        return view('admin/profile', $data);
    }

    public function update()
    {
        // Ambil provider user dari Shield
        $users = auth()->getProvider();
        $user  = auth()->user();

        // Validasi
        if (!$this->validate('profileUpdate')) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        // Update data umum
        $user->fill([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'), // <== ini penting!
            'bio'      => $this->request->getPost('bio'),
            'social_links' => json_encode([
                'linkedin' => $this->request->getPost('linkedin'),
                'github'   => $this->request->getPost('github'),
                'twitter'  => $this->request->getPost('twitter'),
                'website'  => $this->request->getPost('website'),
            ]),
        ]);

        // Update foto (jika ada)
        $file = $this->request->getFile('photo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'images/profile', $newName);

            // hapus foto lama
            if ($user->image && file_exists(FCPATH . 'images/profile/' . $user->image)) {
                unlink(FCPATH . 'images/profile/' . $user->image);
            }

            $user->image = $newName;
        }

        // Simpan user via provider Shield (otomatis update email di auth_identities)
        $users->save($user);

        return redirect()->back()->with('message', 'Profil berhasil diperbarui!');
    }
}
