<?php
/**
 * Created by PhpStorm.
 * User: srijan
 * Date: 3/2/16
 * Time: 2:49 PM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Calender extends Model
{
    public $timestamps = false;

    protected $fillable = ['nepali_year', 'month_code', 'eng_start_date', 'no_days', 'eng_end_date',];



}