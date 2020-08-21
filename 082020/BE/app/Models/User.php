<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'role_id',
        'information_id',
        'category_id',
        'tag_id'
    ];

    protected $appends = [
        'full_name',
        'favoritersIds'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function information()
    {
        return $this->hasOne(UserInformation::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'user_tags');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function favoriters()
    {
        return $this->belongsToMany(
            self::class,
            'favorites',
            'likee_id',
            'liker_id'
        );
    }

    public function favoritings()
    {
        return $this->belongsToMany(
            self::class,
            'favorites',
            'liker_id',
            'likee_id'
        );
    }

    public function images()
    {
        return $this->morphMany(Media::class, 'imageable');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($user) {
            Storage::delete('public/' . $user->information->avatar);
            foreach ($user->images as $image) {
                Storage::deleteDirectory('public/images/' . $user->id);
            }
            $user->information()->delete();
            $user->tags()->detach();
            $user->images()->delete();
        });
    }

    public function getFavoritersIdsAttribute()
    {
        return $this->favoriters->pluck('id');
    }

        /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
