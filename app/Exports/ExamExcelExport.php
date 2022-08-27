<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExamExcelExport implements FromView
{    
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function view(): View
    {
        return view('panel.exports.exam', [
            'exams' => $this->data
        ]);
    }
}