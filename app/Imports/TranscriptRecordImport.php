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
            'transcript_number' => $row['1'],
            'registration_number' => $row['2'],
            'school_name' => $row['3'],
            'student_name' => $row['4'],
            'nationality' => $row['5'],
            'gender' => $row['6'],
            'result_type' => $row['7'],
            'result' => $row['8'],
            'remarks' => $row['9'],
        ]);
    }
}
