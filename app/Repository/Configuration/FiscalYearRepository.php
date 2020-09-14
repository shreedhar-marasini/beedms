<?php
/**
 * Created by PhpStorm.
 * User: srijan
 * Date: 8/3/17
 * Time: 3:29 PM
 */

namespace App\Repository\Configuration;

use App\Models\FiscalYear;
use Illuminate\Support\Facades\DB;

class FiscalYearRepository
{
    private $fiscalYear;

    public function __construct(FiscalYear $fiscalYear)
    {
        $this->fiscalYear = $fiscalYear;
    }

    public function all()
    {
        $fiscalYear = $this->fiscalYear->get();
        return $fiscalYear;
    }


    public function findById($id)
    {
        $fiscalYear = $this->fiscalYear->find($id);
        return $fiscalYear;
    }

    public function getFiscalYear($date)
    {

        return  $this->fiscalYear
            ->where('fy_start_date', '<', $date)
            ->where('fy_end_date', '>', $date)
            ->first();
          
    }

    public function getMonths()
    {
        $month = time();
        for ($i = 12; $i >= 1; $i--) {
            $months[] = date($month);
            $month = strtotime('last month', $month);

        }
//       dd($months);
        return $months;
    }

    public function checkRelation($id)
    {
        $fiscalYear = $this->fiscalYear->find($id);
       $documents = DB::table('dms_incoming_documents as dI')
                    ->where( 'dI.document_received_date', '>',  $fiscalYear->fy_start_date)
                    ->where( 'dI.document_received_date', '<',  $fiscalYear->fy_end_date)
                    ->select('dI.*')
                    ->get();
           

    
         
                
        return $documents;
                

    }
    public function checkRelation2($id)
    {
        $fiscalYear = $this->fiscalYear->find($id);
    
           
        $document = DB::table('dms_outgoing_documents as od')
                    ->where( 'od.outgoing_document_date', '>',  $fiscalYear->fy_start_date)
                    ->where( 'od.outgoing_document_date', '<',  $fiscalYear->fy_end_date)
                    ->select('od.*')
                    ->get();
        
    
         
                
        return $document;
                

    }
}