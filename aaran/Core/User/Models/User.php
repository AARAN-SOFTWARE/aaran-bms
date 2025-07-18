<?php

namespace Aaran\Core\User\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Aaran\Core\User\Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'active_id',
        'tenant_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function getName($id)
    {
        return self::find($id)->name;
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn(string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }

//    public function todos()
//    {
//        return $this->hasMany(Todo::class);
//    }

}
