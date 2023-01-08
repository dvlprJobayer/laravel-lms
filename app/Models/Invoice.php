<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'due_date',
        'paid_date',
        'user_id'
    ];

    public function invoiceItems() {
        return $this->hasMany(InvoiceItem::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    public function calculation () {

        $calculation = [
            'total' => 0,
            'paid' => 0,
            'due' => 0,
        ];

        $calculation['total'] = $this->invoiceItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $calculation['paid'] = $this->payments->sum('amount');

        $calculation['due'] = $calculation['total'] - $calculation['paid'];

        return $calculation;
    }
}
