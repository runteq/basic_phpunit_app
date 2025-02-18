<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Task extends Model
{
    protected $fillable = [
        'title', 'content', 'status', 'priority', 'deadline', 'user_id',
    ];

    protected $casts = [
        'status'   => 'integer',
        'deadline' => 'datetime',
    ];

    protected $errors;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isValid()
    {
        $rules = [
            'title'  => 'required|unique:tasks,title,' . $this->id,
            'status' => 'required|integer',
        ];

        $validator = Validator::make($this->attributes, $rules);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }

        $this->errors = collect();
        return true;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}

