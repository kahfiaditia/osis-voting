<?php

namespace App\Helper;

use RealRashid\SweetAlert\Facades\Alert;

class AlertHelper
{

    public static function addAlert($info)
    {
        if ($info) {
            return Alert::success('Berhasil', "Berhasil disimpan");
        } else {
            return Alert::error('Gagal', "Gagal disimpan");
        }
    }

    public static function updateAlert($info)
    {
        if ($info) {
            Alert::success('Berhasil', "Berhasil diubah");
        } else {
            Alert::error('Gagal', 'Gagal diubah');
        }
    }

    public static function deleteAlert($info)
    {
        if ($info) {
            Alert::success('Berhasil', "Berhasil dihapus");
        } else {
            Alert::error('Gagal', 'Gagal dihapus');
        }
    }

    public static function addPayment($info)
    {
        if ($info) {
            Alert::success('Berhasil', 'Berhasil dibayar');
        } else {
            Alert::error('Gagal', 'Gagal dibayar');
        }
    }

    public static function addDuplicate($info)
    {
        if ($info !== true) {
            Alert::error('Gagal', 'Gagal disimpan, data sudah ada');
        }
    }

    public static function import($info)
    {
        if ($info) {
            Alert::success('Berhasil', 'Berhasil import file');
        } else {
            Alert::error('Gagal', 'Gagal import file');
        }
    }

    public static function uploadValidation($info)
    {
        if ($info !== true) {
            Alert::error('Gagal', 'Format file harus CSV');
        }
    }

    public static function paymentValidation($info)
    {
        if ($info) {
            Alert::success('Berhasil', 'Pembayaran sudah Lunas');
        } else {
            Alert::error('Gagal', 'Pembayaran melebihi tagihan');
        }
    }

    public static function nullValidation($info)
    {
        if ($info !== true) {
            Alert::error('Gagal', 'Pembayaran wajib diisi');
        }
    }

    public static function settingPayment($info)
    {
        if ($info !== true) {
            Alert::error('Gagal', 'Wajib setting pembayaran terlebih dahulu');
        }
    }

    public static function alertDinamis($info, $message)
    {
        if ($info) {
            Alert::success('Berhasil', $message);
        } else {
            Alert::error('Gagal', $message);
        }
    }
}
