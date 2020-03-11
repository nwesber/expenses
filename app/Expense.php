<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
  
    protected $table = "expense";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'entry_date',
        'expense_category_id'
    ];

    public function category(){
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
    }

    public function getEntryDateAttribute($value){
        return date('Y-m-d', strtotime($value));
    }

}
