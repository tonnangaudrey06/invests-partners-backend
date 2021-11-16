<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'type',
        'url',
        'source',
        'projet',
        'message',
        'actualite'
    ];

    public static function getAllowedFiles()
    {
        return ['pdf', 'doc', 'docx', 'pptx', 'ppt', 'xls', 'xlsx', 'txt', 'zip', 'rar', '7z'];
    }

    public static function getAllowedImages()
    {
        return ['png', 'jpg', 'jpeg', 'gif'];
    }

    public static function getAllowedVideos()
    {
        return ['mp4', 'avi', 'mkv', 'm4v', 'mpg', 'mpeg', 'mov', '3gp'];
    }

    public function secteur()
    {
        return $this->belongsTo(Secteur::class, 'secteur', 'id');
    }

    public function projet()
    {
        return $this->belongsTo(Secteur::class, 'secteur', 'id');
    }

    // public function actualite()
    // {
    //     return $this->belongsTo(secteur::class, 'secteur', 'id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
}
