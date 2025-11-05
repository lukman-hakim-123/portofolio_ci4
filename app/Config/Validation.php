<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;
use \App\Validation\CustomRules;

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
        CustomRules::class,
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

    public array $profileUpdate = [
        'photo' => [
            'label' => 'Foto Profil',
            'rules' => 'if_exist|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png,image/webp]|max_size[photo,2048]',
            'errors' => [
                'is_image' => 'File harus berupa gambar.',
                'mime_in' => 'Format gambar tidak valid (hanya JPG, PNG, WEBP).',
                'max_size' => 'Ukuran gambar maksimal 2MB.',
            ],
        ],

        'username' => [
            'label' => 'Nama Pengguna',
            'rules' => 'required|min_length[3]|max_length[50]',
            'errors' => [
                'required' => 'Nama pengguna tidak boleh kosong.',
                'min_length' => 'Nama pengguna minimal 3 karakter.',
                'max_length' => 'Nama pengguna maksimal 50 karakter.',
            ],
        ],

        'email' => [
            'label' => 'Email',
            'rules' => 'required|valid_email|max_length[100]',
            'errors' => [
                'required' => 'Email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'max_length' => 'Email terlalu panjang.',
            ],
        ],

        'bio' => [
            'label' => 'Bio',
            'rules' => 'permit_empty|max_length[255]',
            'errors' => [
                'max_length' => 'Bio maksimal 255 karakter.',
            ],
        ],
    ];

    public array $education = [
        'logo' => [
            'label' => 'logo',
            'rules' => 'if_exist|is_image[logo]|mime_in[logo,image/jpg,image/jpeg,image/png,image/webp]|max_size[logo,2048]',
            'errors' => [
                'is_image' => 'File harus berupa gambar.',
                'mime_in' => 'Format gambar tidak valid (hanya JPG, PNG, WEBP).',
                'max_size' => 'Ukuran gambar maksimal 2MB.',
            ]
        ],
        'institution' => [
            'label' => 'institution',
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Sekolah/Universitas wajib diisi.',
            ]
        ],
        'major' => [
            'label' => 'major',
            'rules' => 'required',
            'errors' => [
                'required' => 'Jurusan wajib diisi.',
            ]
        ],
        'start_year' => [
            'label' => 'start_year',
            'rules' => 'required',
            'errors' => [
                'required' => 'Tahun Mulai wajib diisi.',
            ]
        ],
        'end_year' => [
            'label' => 'end_year',
            'rules' => 'permit_empty|valid_year_range',
            'errors' => [
                'valid_year_range' => 'Tahun selesai tidak boleh lebih kecil dari tahun mulai.',
            ]
        ],
    ];
}
