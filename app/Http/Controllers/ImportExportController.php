<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TranscriptRecordImport;
use App\Exports\TranscriptRecordExport;

class ImportExportController extends Controller
{
    public function import(Request $request) 
    {
        try {
            // Validate File Type  
            $request->validate([
                'file' => 'required|mimes:csv,txt,xlsx,xls'
            ]);
            
            $file = $request->file('file');
                
                Excel::import(new TranscriptRecordImport, $file);
                
                return redirect('/')->with('success', 'Records imported successfully.');
            // } 
            // catch (\Illuminate\Validation\ValidationException $e) {
                // return redirect('/')->with('error', 'Invalid file type. Please upload a CSV or Excel file.'); 
            } catch (\Exception $e) {
                return redirect('/')->with('error', 'Failed to import records. Please ensure the feild format is correct.');
        }
    }

    public function export() 
    {
        return Excel::download(new TranscriptRecordExport, 'transcript_records.xlsx');
        return redirect('/')->with('success', 'Records exported successfully.');
    }
}
