<?php

namespace App\Ship\Tests\Fakes;

use App\Ship\Parents\Models\UserModel as ParentUserModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestUser extends ParentUserModel
{
    protected $table = 'test_users';

    protected $fillable = [
        'name',
        'published',
    ];

    public function hasAdminRole(): bool
    {
        return false;
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'user_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'user_id');
    }
}
