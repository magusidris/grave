<?php

if (! function_exists('formatPrice')) {
    /**
     * formatPrice
     *
     * @param  mixed $str
     * @return void
     */
    function formatPrice($str)
    {
        return 'Rp ' . number_format($str, '0', '', '.');
    }
}

if (! function_exists('get_gravatar')) {
    /**
     * get_gravatar
     *
     * @param  mixed $email
     * @param  mixed $size
     * @param  mixed $default
     * @return void
     */
    function get_gravatar($email, $size = 120, $default = 'mp')
    {
        // 1. Hash email menggunakan md5 setelah diubah ke huruf kecil dan di-trim.
        $hash = md5(strtolower(trim($email)));

        // 2. Buat URL lengkap dengan parameter.
        return "https://www.gravatar.com/avatar/{$hash}?s={$size}&d={$default}";
    }
}
