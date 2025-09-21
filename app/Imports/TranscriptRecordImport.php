<?php

namespace App\Imports;

use App\Models\FormSubmission as TranscriptRecord;
use Maatwebsite\Excel\Concerns\ToModel;

class TranscriptRecordImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TranscriptRecord([
            'programme_name' => $row['0'],
            // 'transcript_number' => $row['1'],
            'registration_number' => $row['1'],
            'school_name' => $row['2'],
            'student_name' => $row['3'],
            'nationality' => $row['4'],
            'gender' => $row['5'],
            'result_type' => $row['6'],
            'result' => $row['7'],
            'remarks' => $row['8'],
        ]);
    }
}
