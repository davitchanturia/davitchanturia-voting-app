<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // elequent relationship between idea
    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }

    // elequent relationship between voted ideas
    public function votes()
    {
        return $this->belongsToMany(Idea::class, 'votes');
    }

    // elequent relationship between idea comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // user avatar
    public function getAvatar()
    {
        $firstCharacter = $this->email[0];

        $integerToUse = is_numeric($firstCharacter)
            ? ord(strtolower($firstCharacter)) - 21  // if true
            : ord(strtolower($firstCharacter)) - 96 ; // else

        return 'https://gravatar.com/avatar/'
            .md5($this->email)
            .'?s=200'
            .'&d=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-'
            .$integerToUse
            .'.png';
    }

    public function isAdmin()
    {
        return in_array($this->email, [
            'dato@redberry.ge'
        ]);
    }
}
