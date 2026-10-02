<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PengajuanController extends BaseController
{
    // Tampilan Form Peminjaman Ruangan (user/room)
    public function ruangan()
    {
        return view('user/room');
    }

    // Proses Simpan Peminjaman Ruangan (user/room/store)
    public function storeRuangan()
    {
        // Logika simpan data ruangan
        return redirect()->to(site_url('user/history'))->with('success', 'Pengajuan peminjaman ruangan berhasil dikirim.');
    }

    // Tampilan Form Peminjaman Kendaraan (user/vehicle)
    public function kendaraan()
    {
        return view('user/vehicle');
    }

    // Proses Simpan Peminjaman Kendaraan (user/vehicle/store)
    public function storeKendaraan()
    {
        // Logika simpan data kendaraan
        return redirect()->to(site_url('user/history'))->with('success', 'Pengajuan peminjaman kendaraan berhasil dikirim.');
    }

    // Tampilan Form Pelaporan Kerusakan (user/kerusakan)
    public function kerusakan()
    {
        return view('user/kerusakan');
    }

    // Proses Simpan Pelaporan Kerusakan (user/kerusakan/store)
    public function storeKerusakan()
    {
        // Logika simpan data kerusakan
        return redirect()->to(site_url('user/history'))->with('success', 'Laporan kerusakan berhasil dikirim.');
    }
}