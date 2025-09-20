<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OtpVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'email',
        'otp_code',
        'expires_at',
        'attempts',
        'verified_at',
        'ip_address',
        'user_agent',
        'type',
        'method',
        'is_used'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'verified_at' => 'datetime',
        'is_used' => 'boolean',
    ];

    /**
     * Check if OTP is expired
     */
    public function isExpired(): bool
    {
        return $this->expires_at < now();
    }

    /**
     * Check if OTP is valid (not expired and not used)
     */
    public function isValid(): bool
    {
        return !$this->isExpired() && !$this->is_used && $this->verified_at === null;
    }

    /**
     * Mark OTP as verified
     */
    public function markAsVerified(): void
    {
        $this->update([
            'verified_at' => now(),
            'is_used' => true
        ]);
    }

    /**
     * Increment attempts count
     */
    public function incrementAttempts(): void
    {
        $this->increment('attempts');
    }

    /**
     * Scope to get valid OTPs
     */
    public function scopeValid($query)
    {
        return $query->where('expires_at', '>', now())
                    ->where('is_used', false)
                    ->whereNull('verified_at');
    }

    /**
     * Scope to get OTPs by phone
     */
    public function scopeByPhone($query, $phone)
    {
        return $query->where('phone', $phone);
    }

    /**
     * Scope to get OTPs by email
     */
    public function scopeByEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    /**
     * Scope to get recent OTPs (within last hour)
     */
    public function scopeRecent($query)
    {
        return $query->where('created_at', '>', now()->subHour());
    }

    /**
     * Get the user associated with this OTP (if exists)
     */
    public function user()
    {
        if ($this->phone) {
            return User::where('phone', $this->phone)->first();
        }

        if ($this->email) {
            return User::where('email', $this->email)->first();
        }

        return null;
    }

    /**
     * Clean up expired OTPs
     */
    public static function cleanupExpired(): int
    {
        return static::where('expires_at', '<', now()->subDay())->delete();
    }

    /**
     * Get OTP attempts count for phone/email in last hour
     */
    public static function getRecentAttemptsCount($contact, $method = 'phone'): int
    {
        $query = static::recent();

        if ($method === 'phone') {
            $query->byPhone($contact);
        } else {
            $query->byEmail($contact);
        }

        return $query->count();
    }
}