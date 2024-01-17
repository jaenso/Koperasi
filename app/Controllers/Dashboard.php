<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];
        return view('Bendahara/dashboard', $data);
    }

    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard'
        ];
        echo view('Component/header', $data);
        echo view('Component/sidebar');
        echo view('Bendahara/dashboard');
        echo view('Component/footer');
    }
}
