<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function dashboard()
    {
        return view('dashbord');
    }

    public function addStock()
    {
        return view('pages.addnewStock');
    }

    public function stockList()
    {
        return view('pages.stocklist');
    }

    public function goToStock($batch_id) {
        // Fetch stock details based on $batch_id
        return view('pages.stock', compact('batch_id'));
    }
    
    public function stockTransfer()
    {
        return view('pages.transferPage');
    }

    public function getUsers()
    {
        return view('pages.users.getusersPage');
    }
}
