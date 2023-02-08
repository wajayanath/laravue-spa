<?php

namespace App\Http\Controllers;

use App\Imports\CsvImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import(Request $request)
    {
        if (empty($request->file('file')))
        {
            return response()->json(['message' => 'No file selected']);
        }
        else
        {
            Excel::import(new CsvImport, $request->file);
            return response()->json(['message' => 'Data imported successfully!', 200]);
        }
    }
}
