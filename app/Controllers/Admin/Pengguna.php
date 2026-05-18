<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Pengguna extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Pengguna',
            'pengguna' => $this->userModel->getDaftarUser()
        ];

        return view('admin/pengguna/index', $data);
    }

    public function toggleAktif($id)
    {
        $currentUserId = session()->get('user_id');

        if ($currentUserId == $id) {
            session()->setFlashdata('error', 'Anda tidak dapat menonaktifkan akun Anda sendiri.');
            return redirect()->back();
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            session()->setFlashdata('error', 'Pengguna tidak ditemukan.');
            return redirect()->back();
        }

        $newStatus = $user['aktif'] ? 0 : 1;
        $this->userModel->update($id, ['aktif' => $newStatus]);

        $statusText = $newStatus ? 'diaktifkan' : 'dinonaktifkan';
        session()->setFlashdata('sukses', "Akun pengguna berhasil $statusText.");
        return redirect()->back();
    }

    public function ubahRole($id)
    {
        $currentUserId = session()->get('user_id');

        if ($currentUserId == $id) {
            session()->setFlashdata('error', 'Anda tidak dapat mengubah role akun Anda sendiri.');
            return redirect()->back();
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            session()->setFlashdata('error', 'Pengguna tidak ditemukan.');
            return redirect()->back();
        }

        $role = $this->request->getPost('role');
        $allowedRoles = ['admin', 'petugas', 'anggota'];

        if (!in_array($role, $allowedRoles)) {
            session()->setFlashdata('error', 'Role tidak valid.');
            return redirect()->back();
        }

        $this->userModel->update($id, ['role' => $role]);
        session()->setFlashdata('sukses', 'Role pengguna berhasil diubah.');
        return redirect()->back();
    }
}
