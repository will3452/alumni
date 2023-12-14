<?php

namespace App\Exports;

use App\Models\CareerProgress;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class CareerProgressExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CareerProgress::all()->map(function ($row) {
            return [
                'name' => User::find($row->user_id)->name, 
                'year' => $row->year, 
                'company' => $row->company, 
                'job' => $row->job, 
                'level' => $row->level, 
            ];
        });
    }
}
