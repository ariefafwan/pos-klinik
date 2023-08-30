<?php

function uang($uang)
{
    return "Rp. " . number_format($uang, 0, ',', '.');
}

function terbilang($uang)
{
    $uang = abs($uang);
    $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    $terbilang = "";
    if ($uang < 12) {
        $terbilang = " " . $huruf[$uang];
    } else if ($uang < 20) {
        $terbilang = terbilang($uang - 10) . " Belas";
    } else if ($uang < 100) {
        $terbilang = terbilang($uang / 10) . " Puluh" . terbilang($uang % 10);
    } else if ($uang < 200) {
        $terbilang = " Seratus" . terbilang($uang - 100);
    } else if ($uang < 1000) {
        $terbilang = terbilang($uang / 100) . " Ratus" . terbilang($uang % 100);
    } else if ($uang < 2000) {
        $terbilang = " Seribu" . terbilang($uang - 1000);
    } else if ($uang < 1000000) {
        $terbilang = terbilang($uang / 1000) . " Ribu" . terbilang($uang % 1000);
    } else if ($uang < 1000000000) {
        $terbilang = terbilang($uang / 1000000) . " Juta" . terbilang($uang % 1000000);
    } else if ($uang < 1000000000000) {
        $terbilang = terbilang($uang / 1000000000) . " Milyar" . terbilang(fmod($uang, 1000000000));
    } else if ($uang < 1000000000000000) {
        $terbilang = terbilang($uang / 1000000000000) . " Trilyun" . terbilang(fmod($uang, 1000000000000));
    }
    return $terbilang;
}

function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $indexing = explode('-', $tanggal);

    // index var menjadi 0 = tanggal, 1 = bulan, 2 = tahun

    return $indexing[2] . ' ' . $bulan[(int)$indexing[1]] . ' ' . $indexing[0];
}
