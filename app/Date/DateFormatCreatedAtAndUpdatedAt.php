<?php

namespace App\Date;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait DateFormatCreatedAtAndUpdatedAt
{
        /**
     * Get the user's created_at.
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->format('d F Y'),
        );
    }

    /**
     * Get the user's updated_at.
     */
    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->format('d F Y'),
        );
    }
}
