<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'file_path',
        'comments',
    ];

    protected static function booted(): void
    {
        self::deleting(function (Document $customerDocument){
            Storage::disk('public')->delete($customerDocument->file_path);
        });   
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
