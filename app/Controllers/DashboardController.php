<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {

        $user = auth()->user();

        $socialLinks = json_decode($user->social_links ?? '{}', true);

        $data = [
            'title' => 'Dashboard',
            'user'  => $user,
            'social_links' => $socialLinks,
        ];

        return view('admin/dashboard', $data);
    }
}
