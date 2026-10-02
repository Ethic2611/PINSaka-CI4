<?php

namespace App\Controllers\Admin; // Adjust namespace jika di folder Admin (App\Controllers\Admin)
use App\Controllers\BaseController;
use App\Models\DamageReportMA;

class DamageReport extends BaseController
{
    public function save()
    {
        $reportModel = new DamageReportMA();

        // 1. Ambil file foto dari request
        $filePhoto = $this->request->getFile('photo');
        $photoName = null;

        // 2. Validasi & Pindahkan File jika diunggah
        if ($filePhoto && $filePhoto->isValid() && !$filePhoto->hasMoved()) {
            // Buat nama file acak yang unik agar tidak saling menimpa
            $photoName = $filePhoto->getRandomName();

            // Pindahkan file ke direktori public/uploads/damage_reports/
            $filePhoto->move(FCPATH . 'uploads/damage_reports', $photoName);
        }

        // 3. Susun data sesuai dengan $allowedFields pada DamageReportMA
        $data = [
            'full_name'          => $this->request->getPost('full_name'),
            'nip'                => $this->request->getPost('nip'),
            'department'         => $this->request->getPost('department'),
            'phone'              => $this->request->getPost('phone'),
            'damage_description' => $this->request->getPost('damage_description'),
            'photo'              => $photoName, // Menyimpan nama file ke database (contoh: 1718293819_abc.jpg)
            'status'             => 'Pending'
        ];

        // 4. Simpan ke database
        if ($reportModel->insert($data)) {
            return redirect()->back()->with('success', 'Laporan kerusakan berhasil dikirim.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengirim laporan kerusakan.');
        }
    }
}