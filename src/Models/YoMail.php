<?php

namespace Codebitz\Yomail\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoMail extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'headers' => 'array',
        'to' => 'array',
        'from' => 'array',
        'cc' => 'array',
        'bcc' => 'array',
        'attachments' => 'array'
    ];

    protected $table = 'yomails';

}
