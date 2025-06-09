<?php

declare(strict_types=1);

namespace App\Ship\Tests\Fakes;

use App\Ship\Parents\Models\UserModel as ParentUserModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestUser extends ParentUserModel
{
    use SoftDeletes;

    protected $table = 'test_users';

    protected $fillable = [
        'name',
        'email',
        'age',
        'published',
        'user_id',
        'active',
        'score',
        'metadata',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'user_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'user_id');
    }

    /**
     * Dummy relations for testing.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(self::class, 'id');
    }

    /**
     * Dummy relations for testing.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(self::class, 'id');
    }

    protected function casts(): array
    {
        return [
            'metadata' => 'array',
            'active'   => 'boolean',
            'score'    => 'decimal:1',
        ];
    }
}
