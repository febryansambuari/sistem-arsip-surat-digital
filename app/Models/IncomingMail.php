<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class IncomingMail extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'mail_category',
        'mail_number',
        'mail_date',
        'mail_from',
        'mail_to',
        'mail_information',
        'mail_subject'
    ];

    public function documents()
    {
        return $this->morphMany(Media::class, 'model');
    }
}