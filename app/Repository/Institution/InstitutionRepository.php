<?php
/**
 * Created by PhpStorm.
 * User: ym-bikash
 * Date: 8/3/17
 * Time: 2:30 PM
 */

namespace App\Repository\Institution;


use App\Models\Institution;
use App\Repository\Documents\DigitizedDocumentRepo;
use App\Repository\Documents\IncomingDocumentRepo;
use App\Repository\Documents\OutgoingDocumentRepository;
use App\User;
use Illuminate\Support\Facades\DB;

class InstitutionRepository
{
    protected $institution;
    /**
     * @var IncomingDocumentRepo
     */
    private $incomingDocumentRepo;
    /**
     * @var OutgoingDocumentRepository
     */
    private $outgoingDocumentRepository;
    /**
     * @var DigitizedDocumentRepo
     */
    private $digitizedDocumentRepo;

    /**
     * @param Institution $institution
     */

    public function __construct(Institution $institution,
                                IncomingDocumentRepo $incomingDocumentRepo,
                                OutgoingDocumentRepository $outgoingDocumentRepository,
                                DigitizedDocumentRepo $digitizedDocumentRepo)
    {

        $this->institution = $institution;
        $this->incomingDocumentRepo = $incomingDocumentRepo;
        $this->outgoingDocumentRepository = $outgoingDocumentRepository;
        $this->digitizedDocumentRepo = $digitizedDocumentRepo;
    }

    public function all($request)
    {
        $institutions = $this->institution;

        if ($request->has('institution_name')) {
            $name = $request->institution_name;
            $institutions = $institutions->where('institution_name', 'LIKE', '%' . $name . '%');
        }
        if ($request->has('institution_address')) {
            $address = $request->institution_address;
            $institutions = $institutions->where('institution_address', 'LIKE', '%' . $address . '%');
        }
        if ($request->has('institution_contact_number')) {
            $contact = $request->institution_contact_number;
            $institutions = $institutions->where('institution_contact_number', 'LIKE', '%' . $contact . '%');
        }

        return $institutions->orderBy('institution_name', 'asc')->get();
    }

    public function lists()
    {
        return $this->institution
            ->select('id', 'institution_name')
            ->orderBy('institution_name', 'asc')
            ->get();
    }

    public function getInstitutionName($request)
    {
        $institutions = $this->institution
            ->orderBy('institution_name', 'ASC')
            ->where('institution_name', 'LIKE', $request->institution_name . '%')
            ->get();
        foreach ($institutions as $institute) {
            $ins[] = '<option class="text-danger">' . $institute->institution_name . '</option>';
           
        }

        return $ins;
    }



    //timeline institution with deleted_date old one whic was wrong for other user group excep super admin
    /*
     *
     CREATE VIEW v_institution_timeline AS SELECT id AS document_id,sender_institution_id as institution_id ,created_at AS created_date,deleted_at as deleted_date,'incoming' AS documentType,'incoming' AS timelineType FROM dms_incoming_documents UNION

    SELECT id AS document_id,institution_id as institution_id, created_at AS created_date,deleted_at as deleted_date,'outgoing' AS documentType,'outgoing' AS timelineType FROM dms_outgoing_documents UNION


    SELECT id AS document_id,related_institution_id as institution_id, created_at AS created_date,deleted_at as deleted_date,'digitized' AS documentType,'digitized' AS timelineType FROM dms_digitized_documents UNION

    SELECT email_logs_document_id AS document_id,institution_id as institution_id, created_at AS created_date,NULL as deleted_date,email_logs_document_type AS documentType,'email' AS timelineType FROM dms_email_logs
    */

    public function getDocumentDate($institution_id)
    {
        if (User::isSuperAdmin()) {

            $documentTrack = DB::select("SELECT DISTINCT (DATE (created_date)) as created_at FROM `v_institution_timeline` where deleted_date IS NULL AND institution_id= $institution_id ORDER by DATE(created_date)  desc");
            return $documentTrack;
        } else {
            $incoming = $this->incomingDocumentRepo;
            $outgoing =
                /*
                 * SELECT DISTINCT created_at FROM
(SELECT DISTINCT date(dms_outgoing_documents.created_at) as created_at FROM `dms_outgoing_documents` JOIN `users` where  users.department_id = 1  UNION

SELECT DISTINCT date(dms_outgoing_documents.created_at) as created_at FROM `dms_outgoing_documents` WHERE dms_outgoing_documents.outgoing_document_privacy = 'General'
UNION

SELECT DISTINCT date(dms_outgoing_documents.created_at) as created_at FROM `dms_outgoing_documents`  where dms_outgoing_documents.signature_user_id = 3   UNION

 SELECT DISTINCT date(dms_outgoing_documents.created_at) as created_at FROM `dms_outgoing_documents` where dms_outgoing_documents.issued_by = 3)a*/

            $documentTrack = DB::select("SELECT DISTINCT created_at FROM 
                (SELECT DISTINCT date(dms_outgoing_documents.created_at) as created_at FROM `dms_outgoing_documents` JOIN `users` ON users.id=dms_outgoing_documents.created_by_user_id where  users.department_id = 1  UNION 
                
                SELECT DISTINCT date(dms_outgoing_documents.created_at) as created_at FROM `dms_outgoing_documents` WHERE dms_outgoing_documents.outgoing_document_privacy = 'General'
                )a
                
                UNION
                SELECT DISTINCT created_at FROM (
                
                SELECT DISTINCT date(dms_outgoing_documents.created_at) as created_at FROM `dms_outgoing_documents`  where dms_outgoing_documents.signature_user_id = 3   UNION 
                
                 SELECT DISTINCT date(dms_outgoing_documents.created_at) as created_at FROM `dms_outgoing_documents` where dms_outgoing_documents.issued_by = 3)b 
                 UNION
                 SELECT DISTINCT (DATE (created_date)) as created_at FROM `v_institution_timeline` where deleted_date IS NULL AND institution_id= 1
                 
                 ORDER by DATE(created_at)  desc");
            $documentTrack = DB::select("SELECT DISTINCT (DATE (created_date)) as created_at FROM `v_institution_timeline` where deleted_date IS NULL AND institution_id= $institution_id ORDER by DATE(created_date)  desc");

            return $documentTrack;
        }
    }

    public static function getDocumentInfo($action_date, $institution_id)
    {
        $documentTrack = DB::select("SELECT * FROM `v_institution_timeline` where institution_id= $institution_id AND DATE (created_date)=\"$action_date\" AND deleted_date IS NULL ORDER by created_date desc ");
        return $documentTrack;
    }


}