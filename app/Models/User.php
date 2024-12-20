<?php

namespace App\Models;

use App\Models\Idea;
use App\Models\Task;
use App\Models\Comment;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function votes()
    {
        return $this->belongsToMany(Idea::class, 'votes');
    }

    public function getAvatar()
    {
        $firstCharacter = $this->email[0];

        $integerToUse = is_numeric($firstCharacter)
         ? ord(strtolower($firstCharacter)) - 21
         : ord(strtolower($firstCharacter)) - 96;

        //  return sprintf(
        //     'https://www.gravatar.com/avatar/%s?s=200&d=%s-%d.png',
        //     md5($this->email),
        //     'https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar',
        //     $integerToUse
        // );

        // with random avatar at each load :
        $emailHash = md5($this->email);
        $avatarDefaults = ['mp', 'identicon', 'monsterid', 'retro', 'robohash'];
        $randomInteger = rand(0, count($avatarDefaults) - 1);

        return "https://www.gravatar.com/avatar/{$emailHash}?s=200&d={$avatarDefaults[$randomInteger]}";


        /*$path = LaravelLocalization::getNonLocalizedURL('/storage/img/avatars/randatar') . $integerToUse . '.png';
        return $path;*/

    }

    public function isAdmin()
    {
        return in_array($this->email, [
            'admin@admin.com'
        ]);
    }
}
