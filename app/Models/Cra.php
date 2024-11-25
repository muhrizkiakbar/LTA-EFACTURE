<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cra extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'bp_code', 
        'bp_name',
        'type', 
        'doc_num',
        'doc_date', 
        'post_date',
        'due_date',
        'bp_ref_no',
        'original_amount',
        'balance_due',
        'pt',
        'branch',
        'delivery_date',
        'pic_admin',
        'note',
        'remark',
        'status',
    ];

    public function scopeFilter($query, $filters)
    {
        $query->when($filters['date'] ?? null, function ($query, $date) {
            $query->where('post_date', '=',$date);
        })
        ->when($filters['status'] ?? null, function ($query, $status) {
            $query->where('status', '=' ,$status);
        })
        ->when($filters['search'] ?? null, function ($query, $search) {
            $search = '%' . $search . '%';
            $query->where('bp_code', 'LIKE', $search);
            $query->orWhere('bp_name', 'LIKE', $search);
            $query->orWhere('doc_num', 'LIKE', $search);
        })
        ->when($filters['sort'] ?? null, function ($query, $sortBy) {
            if (count($params = explode(':', $sortBy)) === 2) {
                [$column, $direction] = $params;
            } else {
                [$direction] = $params;
                $column = 'created_at';
            }
            $query->orderBy($column, $direction);
        }
        )->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } else if ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }
}
