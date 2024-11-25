<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArInvoice extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql';
    protected $table = 'ar_invoices'; 
    protected $fillable = [
        'DocNum',
        'CardCode',
        'CardName',
        'Street',
        'LicTradNum',
        'status',
        'branch_id',
        'company_id',
        'posting_date'
    ];
    public function scopeFilter($query, $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $search = '%'.$search.'%';
            $query->where('DocNum', 'LIKE', $search);
        })->when($filters['branch'] ?? null, function ($query, $branch) {
            $query->where('branch_id', $branch);
        });
    } 
    public function keys() {
        return $this->hasOne(KeySeries::class, 'ar_invoice_id');
    }
    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id', 'bplId');
    }
}
