<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Self_;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //! the function name need to be the same as the data
    //! in the database you want to change attribute
    //! set + name of the data(eg. Password) + Attribute
    //! PS need to have the correct spelling for this to work
    //! PPS this change data in the database
    //* For the UserController
    //* Mutator Eloquent
    // public function setPasswordAttribute($password)
    // {
    //     $this->attributes['password'] = \bcrypt($password);
    // }

    //! the function name need to be the same as the data
    //! in the database you want to change attribute
    //! set + name of the data(eg. Name) + Attribute
    //! PS need to have the correct spelling for this to work
    //! PPS this doesn't change data in the database, just the value in view
    //* For the UserController
    //* Accessor
    // public function getNameAttribute($name)
    // {
    //     return 'My name is ' . \ucfirst($name);
    // }

    public static function uploadAvatar($image)
    {
        $filename = $image->getClientOriginalName();
        (new self)->deleteOldImage();
        $image->storeAs('images', $filename, 'public'); //image is the name of the input field
        \auth()->user()->update(['avatar' => $filename]);
    }

    //* Delete old image
    protected function deleteOldImage()
    {
        if ($this->avatar) {
            Storage::delete('/public/images/' . $this->avatar);
        }
    }

    public function todos()
    {
        return $this->hasMany(Todo::class);
    }
}
