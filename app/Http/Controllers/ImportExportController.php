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
                
                return redirect(route('show-form'))->with('success', 'Records imported successfully.');
            // } 
            // catch (\Illuminate\Validation\ValidationException $e) {
                // return redirect('/')->with('error', 'Invalid file type. Please upload a CSV or Excel file.'); 
            } catch (\Exception $e) {
                return redirect(route('show-form'))->with('error', 'Failed to import records. Please ensure the feild format is correct.');
        }
    }

    public function export() 
    {
        try{
            return Excel::download(new TranscriptRecordExport, 'transcript_records.xlsx');
            return redirect(route('show-form'))->with('success', 'Records exported successfully.');
        } catch (\Exception $e) {
            return redirect(route('show-form'))->with('error', 'Failed to export records.');
        }   
    }
}
