<?php

namespace App\Http\Controllers;
 
use App\Sections\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
 
class ExportController extends Controller
{
 
    function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
 
}