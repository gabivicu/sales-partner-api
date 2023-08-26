<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    /**
     * @var string
     */
    protected $table = 'clients';

    /**
     * @var string[]
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'phone',
        'email'
    ];

    /**
     * @return HasMany
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|unique:clients,phone',
            'email' => 'required|string|email|unique:clients,email',
        ];
    }
}
