<?php

namespace App\Models;

use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Attachment extends Model
{
    protected $fillable = [
        'path',
        'extra_identifier',
        'title',
        'size',
        'type',
        'attachment_id',
        'attachment_type'

    ];
    public function attachment(){
        return $this->morphTo();
    }
    public function url(): Attribute
    {
        return Attribute::make(fn(): string => URL::to('storage/' . $this->path));
    }
}
