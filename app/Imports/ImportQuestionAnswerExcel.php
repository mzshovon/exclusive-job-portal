<?php
namespace App\Imports;

use App\Models\Answer;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportQuestionAnswerExcel implements ToCollection
{
    function __construct($data)
    {
        $this->data = $data;
    }
    public function collection(Collection $rows)
    {
       $status = 1;
       $upload = $this->data['upload_type'] == 'subject' ? Subject::find($this->data['id']) : Exam::find($this->data['id']);
    //    dd($upload);
       foreach($rows as $row) {
        $question = new Question();
        $question->name = $row[0];
        $question->mark = $this->data['mark'];
        $question->negative_mark = $this->data['negative_mark'];
        $question->type = $this->data['type'];
        $question->status = $status;
        $question->save();
        $upload->questions()->attach($question->id);
        if($question->id) {
            for ($i=1; $i< $row->count(); $i++) {
                if($row[$i] && $row[$i] != "is answer") {
                    $answer = new Answer();
                    $answer->name = $row[$i];
                    $answer->is_answer = ($i+1) < $row->count() && $row[$i+1] == "is answer" ? 1: 0;
                    $answer->description = null;
                    $answer->save();
                    $question->answers()->attach($answer->id);
                }
            }
        }
       }
    }
}
