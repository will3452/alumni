<?php

namespace App\Exports;

use App\Models\CareerProgress;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class CareerProgressExport implements FromCollection
{
    public $only; 
    public function __construct($only)
    {
        $this->only = $only; 
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if ($this->only) {
            return CareerProgress::whereUserId($this->only)->get()->map(function ($row) {
                return [
                    'name' => User::find($row->user_id)->name, 
                    'year' => $row->year, 
                    'company' => $row->company, 
                    'job' => $row->job, 
                    'level' => $row->level, 
                ];
            }); 
        }
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
