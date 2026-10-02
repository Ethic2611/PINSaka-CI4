<?php

namespace App\Controllers\User; // Perbaikan namespace untuk folder user

use App\Controllers\BaseController;
use App\Models\RoomBookingModel;

class BookingController extends BaseController
{
    private array $rooms = [
        ['name'=>'Media Center Auditorium Merapi','capacity'=>50],
        ['name'=>'Ruang Rapat Semeru','capacity'=>30],
        ['name'=>'Ruang Rapat Kelud','capacity'=>15],
        ['name'=>'Ruang Rapat Sinabung','capacity'=>16],
        ['name'=>'Ruang Rapat Galunggung','capacity'=>10],
        ['name'=>'Ruang Rapat Kerinci','capacity'=>14],
        ['name'=>'Matsushita Hall','capacity'=>100],
    ];

    private array $vehicles = [
        'TOYOTA INNOVA - AB 1621 CE','DAIHATZU TERIOS - AB 1723 CE',
        'MITSHUBISI COLT L 300 - AB 1050 DE','TOURING (PANTER) - AB 1102 DE',
        'NISSAN NAVARA - AB 8039 DE','HONDA TIGER - AB 2341 YZ',
        'HONDA MEGAPRO - AB 2520 YZ','SUZUKI THUNDER - AB 2218 DE',
        'HONDA NF 125 - AB 2427 DE','TOSSA - AB 2486 DE'
    ];

    private function loginCheck()
    {
        if (!session()->get('logged_in')) return redirect()->to('/login');
        return null;
    }

    public function room()
    {
        $data['rooms'] = [
            [
                'name'     => 'Media Center Auditorium Merapi',
                'capacity' => 50,
                'image'    => 'merapi-k50.jpeg'
            ],
            [
                'name'     => 'Ruang Rapat Semeru',
                'capacity' => 30,
                'image'    => 'semeru-30.jpeg'
            ],
            [
                'name'     => 'Ruang Rapat Kelud',
                'capacity' => 15,
                'image'    => 'kelud.jpeg'
            ],
            [
                'name'     => 'Ruang Rapat Sinabung',
                'capacity' => 16,
                'image'    => 'sinabung-16.jpeg'
            ],
            [
                'name'     => 'Ruang Rapat Galunggung',
                'capacity' => 10,
                'image'    => 'galunggung.jpg'
            ],
            [
                'name'     => 'Ruang Rapat Kerinci',
                'capacity' => 14,
                'image'    => 'kerinci.jpeg'
            ],
            [
                'name'     => 'Ruang Rapat Matsushita Hall',
                'capacity' => 100,
                'image'    => 'matshusita hall.jpeg'
            ],
        ];

        return view('booking/room', $data);
    }

    public function vehicle()
    {
        if ($r = $this->loginCheck()) return $r;
        return view('booking/vehicle', ['vehicles' => $this->vehicles]);
    }

    public function save()
    {
        $bookingModel = new RoomBookingModel();

        // 1. Ambil data time_slots (mencakup pengecekan jika dikirim sebagai array checkbox 'time_slots[]' atau single 'time_slot')
        $rawTimeSlots = $this->request->getPost('time_slots') ?? $this->request->getPost('time_slot');

        // 2. Jika input berupa array (dari checkbox), gabungkan menjadi teks string (contoh: "Pagi, Siang")
        if (is_array($rawTimeSlots)) {
            $timeSlot = implode(', ', $rawTimeSlots);
        } else {
            $timeSlot = $rawTimeSlots ?? '';
        }

        // 3. Ambil dan susun data request
        $data = [
            'type'            => $this->request->getPost('type'),
            'full_name'       => $this->request->getPost('full_name'),
            'nip'             => $this->request->getPost('nip'),
            'department'      => $this->request->getPost('department'),
            'phone'           => $this->request->getPost('phone'),
            'email'           => $this->request->getPost('email'),
            'item'            => $this->request->getPost('item'),
            'purpose'         => $this->request->getPost('purpose'),
            'personnel_count' => $this->request->getPost('personnel_count'),
            'start_date'      => $this->request->getPost('start_date'),
            'end_date'        => $this->request->getPost('end_date'),
            'time_slot'       => $timeSlot, // Nilai time_slot dipastikan berisi string dan tidak NULL
            'status'          => 'Pending'
        ];

        // 4. Simpan ke database
        if ($bookingModel->insert($data)) {
            return redirect()->to(site_url('dashboard/index'))->with('success', 'Permohonan peminjaman berhasil diajukan!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data peminjaman.');
        }
    }
}