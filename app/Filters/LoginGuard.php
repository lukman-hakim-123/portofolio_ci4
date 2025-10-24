<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $auth = service('auth');

        // Jika sudah login, arahkan ke dashboard
        if ($auth->loggedIn()) {
            return redirect()->to('/admin');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
