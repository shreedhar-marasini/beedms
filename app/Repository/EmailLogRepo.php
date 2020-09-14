<?php
/**
 * Created by PhpStorm.
 * User: ym-bikash
 * Date: 8/20/17
 * Time: 1:56 PM
 */
namespace App\Repository;

use App\Models\EmailLog;

class EmailLogRepo{
    /**
     * @var EmailLog
     */
    private $emailLog;

    public function __construct(EmailLog $emailLog)
    {
        $this->emailLog = $emailLog;
    }
    public function all(){
        return $this->emailLog
            ->all();
    }
}