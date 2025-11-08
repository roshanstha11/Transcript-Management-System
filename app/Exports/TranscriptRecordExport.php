<?php

namespace App\Exports;

use App\Models\Transcript;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TranscriptRecordExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Transcript::select(
            'programme_name',
            'transcript_number',
            'registration_number',
            'school_name',
            'student_name',
            'nationality',
            'gender',
            'result_type',
            'result',
            'remarks')->get()->map(function ($record) {
                return [
                    'programme_name' => $record->programme_name,
                    'transcript_number' => $record->transcript_number,
                    'registration_number' => $record->registration_number,
                    'school_name' => $record->school_name,
                    'student_name' => $record->student_name,
                    'nationality' => $record->nationality,
                    'gender' => $record->gender,
                    'result_type' => $record->result_type,
                    'result' => $record->result,
                    'remarks' => $record->remarks,
                ];
            }
        );
    }
    public function headings(): array
    {
        return [
            'programme_name',
            'transcript_number',
            'registration_number',
            'school_name',
            'student_name',
            'nationality',
            'gender',
            'result_type',
            'result',
            'remarks',
        ];
    }
}
