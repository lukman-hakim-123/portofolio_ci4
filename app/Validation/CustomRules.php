<?php

namespace App\Validation;

class CustomRules
{
    public function valid_year_range(string $str): bool
    {
        // Jika end_year kosong → valid
        if (empty($str)) {
            return true;
        }

        // Ambil start_year dari input POST
        $start = $_POST['start_year'] ?? 0;

        // Validasi: end_year tidak boleh lebih kecil dari start_year
        return (int)$str >= (int)$start;
    }
}
