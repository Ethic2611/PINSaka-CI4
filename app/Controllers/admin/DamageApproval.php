<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DamageReportMA;
use App\Models\AcceptedDamageReportMA;

class DamageApproval extends BaseController
{
    // Halaman Kelola Laporan
    public function index()
    {
        $model = new DamageReportMA();
        $data['pending_reports'] = $model->where('status', 'Pending')->orderBy('created_at', 'DESC')->findAll();
        
        // Disesuaikan dengan nama file: app/Views/admin/damage-report-admin.php
        return view('admin/damage-report', $data);
    }

    // Terima Laporan -> Simpan ke database accepted_damage_reports
    public function approve($id = null)
    {
        $reportModel   = new DamageReportMA();
        $acceptedModel = new AcceptedDamageReportMA();

        $report = $reportModel->find($id);
        if ($report) {
            // Update status laporan utama
            $reportModel->update($id, ['status' => 'Diterima']);

            // Simpan ke database khusus yang diterima
            $acceptedModel->insert([
                'report_id'          => $report['id'],
                'full_name'          => $report['full_name'],
                'damage_description' => $report['damage_description'],
                'action_status'      => 'Diterima & Diproses',
                'accepted_at'        => date('Y-m-d H:i:s')
            ]);

            return redirect()->to(site_url('admin/damage-reports'))->with('success', 'Laporan kerusakan berhasil diterima.');
        }
        return redirect()->to(site_url('admin/damage-reports'))->with('error', 'Data tidak ditemukan.');
    }

    // Tampilkan Riwayat Laporan yang Diterima
    public function history()
    {
        $acceptedModel = new AcceptedDamageReportMA();
        $data['accepted_damage_reports'] = $acceptedModel->orderBy('accepted_at', 'DESC')->findAll();
        return view('admin/historyAdmin', $data);
    }
}