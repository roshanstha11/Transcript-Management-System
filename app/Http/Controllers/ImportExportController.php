<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TranscriptRecordExport;
use App\Imports\TranscriptRecordImport;
use Illuminate\Support\Facades\Auth;

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

            // ✅ Log activity here
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'Imported transcript records from file ' . $file->getClientOriginalName(),
            ]);
            
            return redirect(route('view-all-record'))->with('success', 'Records imported successfully. Duplicate registration numbers were automatically skipped.');
            // } 
            // catch (\Illuminate\Validation\ValidationException $e) {
                // return redirect('/')->with('error', 'Invalid file type. Please upload a CSV or Excel file.'); 
            } catch (\Exception $e) {
                return redirect(route('view-all-record'))->with('error', 'Failed to import records. Please ensure the feild format is correct.');
        }
    }

    public function export() 
    {
        try{
            return Excel::download(new TranscriptRecordExport, 'transcript_records.xlsx');
            // ✅ Log activity here
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'Exported transcript records to Excel file',
            ]);
            
            return redirect(route('view-all-record'))->with('success', 'Records exported successfully.');
        } catch (\Exception $e) {
            return redirect(route('view-all-record'))->with('error', 'Failed to export records.');
        }   
    }
}

