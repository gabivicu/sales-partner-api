<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    /**
     * @var string
     */
    protected $table = 'leads';

    /**
     * @var string[]
     */
    protected $fillable = [
        'message',
        'client_id'
    ];

    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'message' => 'required|string',
        ];
    }
}
