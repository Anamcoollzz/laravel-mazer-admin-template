<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password', 'avatar', 'last_logged_in'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasRoles, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_logged_in' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Resolve the public URL for the user's avatar.
     */
    public function avatarUrl(): string
    {
        if ($this->avatar) {
            if (str_starts_with($this->avatar, 'http')) {
                return $this->avatar;
            }

            return Storage::disk('public')->url($this->avatar);
        }

        return asset('mazzer-assets/compiled/jpg/1.jpg');
    }

    /**
     * Duplicate this user with a unique email, "(Copy)" suffix, and copied roles.
     */
    public function duplicate(): self
    {
        $this->loadMissing('roles:id,name');

        $copy = $this->replicate(['last_logged_in', 'remember_token', 'avatar']);
        $copy->name = "{$this->name} (Copy)";
        $copy->email = $this->generateUniqueCopyEmail();
        $copy->save();

        $copy->syncRoles($this->roles->pluck('name')->all());

        return $copy;
    }

    /**
     * Generate a unique email address for a duplicated user.
     */
    private function generateUniqueCopyEmail(): string
    {
        [$local, $domain] = str_contains($this->email, '@')
            ? explode('@', $this->email, 2)
            : [$this->email, 'example.com'];

        $candidate = "{$local}-copy@{$domain}";
        $counter = 2;

        while (self::query()->where('email', $candidate)->exists()) {
            $candidate = "{$local}-copy-{$counter}@{$domain}";
            $counter++;
        }

        return $candidate;
    }
}
