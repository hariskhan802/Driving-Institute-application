<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['examiner_id', 'student_id', 'theory_no', 'practical_no', 'theory_date', 'theory_pass', 'practical_date', 'town', 'distinct'];

}
