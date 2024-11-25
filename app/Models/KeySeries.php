<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeySeries extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'key_series';
    protected $fillable = [
        'ar_invoice_id',
        'series',
        'date',
        'status',
        'company_id'
    ];

    public function invoice() {
        return $this->belongsTo(ArInvoice::class, 'ar_invoice_id');
    }
}
