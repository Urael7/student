<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $fillable = [
        'user_id', 'full_name', 'student_id', 'leave_type', 'start_date', 'end_date', 'reason', 'attachment',
    ];
}