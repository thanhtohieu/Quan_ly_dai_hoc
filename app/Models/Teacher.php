<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ClassSection;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'email',
        'phone',
        'address',
        'faculty_id',
        'degree_id',
        'user_id',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Lấy khoa mà giáo viên này thuộc về
     */
    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }

    /**
     * Lấy học vị của giáo viên
     */
    public function degree(): BelongsTo
    {
        return $this->belongsTo(Degree::class);
    }

    /**
     * Lấy tài khoản người dùng liên kết với giáo viên này
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Lấy họ tên đầy đủ của giáo viên
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Các lớp học phần do giáo viên giảng dạy
     */
    public function classSections(): HasMany
    {
        return $this->hasMany(ClassSection::class);
    }
}
