<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public array $registration = [
        'username' => [
            'label' => 'Nama Pengguna',
            'rules' => [
                'required',
                'max_length[30]',
                'min_length[3]',
                'regex_match[/\A[a-zA-Z0-9\.]+\z/]',
                'is_unique[users.username]',
            ],
            'errors' => [
                'required' => 'Nama pengguna wajib diisi.',
                'is_unique' => 'Nama pengguna sudah digunakan.',
                'min_length' => 'Nama pengguna minimal 3 karakter.',
                'regex_match' => 'Nama pengguna hanya boleh huruf, angka, dan titik.',
            ]
        ],

        'email' => [
            'label' => 'Email',
            'rules' => [
                'required',
                'max_length[254]',
                'valid_email',
                'is_unique[auth_identities.secret]',
            ],
            'errors' => [
                'required' => 'Email wajib diisi.',
                'valid_email' => 'Email tidak valid.',
                'is_unique' => 'Email sudah digunakan.',
            ]
        ],

        'password' => [
            'label' => 'Password',
            'rules' => 'required|max_byte[72]|min_length[8]|strong_password[]',
            'errors' => [
                'required' => 'Password wajib diisi.',
                'max_byte' => 'Password terlalu panjang.',
                'min_length' => 'Password minimal 8 karakter.',
                'strong_password' => 'Password harus lebih kuat (gabungkan huruf besar, kecil, angka, dan simbol).',
            ]
        ],

        'password_confirm' => [
            'label' => 'Konfirmasi Password',
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => 'Konfirmasi Password wajib diisi.',
                'matches' => 'Konfirmasi Password tidak cocok.',
            ]
        ],
    ];

    public array $login = [
        'email' => [
            'label' => 'Email',
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Email wajib diisi.',
                'valid_email' => 'Format Email tidak valid.',
            ]
        ],
        'password' => [
            'label' => 'Password',
            'rules' => 'required',
            'errors' => [
                'required' => 'Password wajib diisi.',
            ]
        ],
    ];
}
