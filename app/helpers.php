<?php

use App\Facades\Currency;

 function  currency($value)
 {
    return Currency::formatCurrency($value,config('app.currency')) ;
 }