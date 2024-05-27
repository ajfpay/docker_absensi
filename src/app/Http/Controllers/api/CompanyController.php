<?php

namespace App\Http\Controllers\api;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CompanyController extends Controller
{
    public function show($id) {
        // Validasi bahwa $id adalah integer
        if (!is_numeric($id)) {
            return response(['error' => 'Invalid ID'], 400);
        }

        // Cari perusahaan berdasarkan ID
        $company = Company::find($id);

        // Jika perusahaan tidak ditemukan, kembalikan respons 404
        if (!$company) {
            return response(['error' => 'Company not found'], 404);
        }

        // Kembalikan data perusahaan
        return response(['company' => $company], 200);
    }
    
}
