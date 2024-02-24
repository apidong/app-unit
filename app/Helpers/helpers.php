<?php

if (!function_exists('unformat_rupiah')) {
    /**
     * rubah format nomor rupiah agar bisa terbaca oleh sistem.
     *
     * @return string
     */
    function unformat_rupiah($harga)
    {
        if ($harga == null) {
            return null;
        }
        $harga_clean = preg_replace('/([^0-9\\,])/i', '', $harga);

        return str_replace(',', '.', $harga_clean);
    }
}

if (!function_exists('format_rupiah')) {
    /**
     * rubah format nomor rupiah agar bisa terbaca oleh sistem.
     *
     * @return string
     */
    function format_rupiah($harga)
    {
        return number_format($harga, 2, ',', '');
    }
}

if (!function_exists('rupiah')) {
    /**
     * rubah format nomor rupiah agar bisa terbaca oleh sistem.
     *
     * @return string
     */
    function rupiah($harga)
    {
        return number_format($harga, 0, ',', '.');
    }
}

if (!function_exists('generateRandomHexColor')) {
    /**
     * generato hex color.
     *
     * @return string
     */
    function generateRandomHexColor()
    {
        // Generate random RGB values
        $red = mt_rand(0, 255);
        $green = mt_rand(0, 255);
        $blue = mt_rand(0, 255);

        // Convert RGB to hexadecimal
        $hexColor = sprintf('#%02x%02x%02x', $red, $green, $blue);

        return  $hexColor;
    }
}

if (!function_exists('aturMenu')) {
    function aturMenu($array)
    {
        $user = auth()->user();
        $permisions = $user->getPermissionsViaRoles()->pluck('name');

        return array_map(function ($value) use ($permisions) {
            if (is_array($value)) {
                if (isset($value['permision']) && !$permisions->contains($value['permision'])) {
                    return null;
                }
                unset($value['id']);
                unset($value['id_parent']);
                unset($value['active']);
                if (isset($value['submenu']) && count($value['submenu']) == null) {
                    unset($value['submenu']);
                }
                if (isset($value['key']) && $value['key'] !== null) {
                    $value['id'] = $value['key'];
                }

                // Recursively remove null values from nested arrays
                return aturMenu($value);
            }

            return $value;
        }, array_filter($array, function ($value) {
            return $value !== null;
        }));
    }
}

if (!function_exists('format_domain')) {
    function format_domain($domain)
    {
        $domain = str_replace(['https://', 'http://'], '', $domain);
        $domain = rtrim($domain, '/');

        return $domain;
    }
}

if (!function_exists('format_api_domain')) {
    function format_api_domain($domain)
    {
        $domain = str_replace(['https://', 'http://'], '', $domain);
        $domain = rtrim($domain, '/');

        return $domain;
    }
}

if (!function_exists('get_nama_file')) {
    function get_nama_file($url, $default = '')
    {
        $nama_file = $default;
        $path_parts = pathinfo($url);
        if (count($path_parts) > 3) {
            $nama_file = $path_parts['filename'] . '.' . $path_parts['extension'];
        }

        return $nama_file;
    }
}

if (!function_exists('get_name_permision')) {
    function get_name_permision($string, $searchValues = ['read-', 'create-', 'update-', 'delete-'])
    {
        return str_replace($searchValues, '', $string);
    }
}
