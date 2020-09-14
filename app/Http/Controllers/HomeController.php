<?php

namespace App\Http\Controllers;

use App\Models\MasterSetting;
use App\Models\UserLogTable;
use App\Online;
use App\Repository\Configuration\FiscalYearRepository;
use App\Repository\Documents\DigitizedDocumentRepo;
use App\Repository\Documents\DocumentCommentRepository;
use App\Repository\Documents\IncomingDocumentRepo;
use App\Repository\Documents\OutgoingDocumentRepository;
use App\Repository\DocumentTimelineRepository;
use App\Repository\Institution\InstitutionRepository;
use App\Repository\UserRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var OutgoingDocumentRepository
     */
    private $outgoingDocumentRepository;
    /**
     * @var IncomingDocumentRepo
     */
    private $incomingDocumentRepo;
    /**
     * @var DigitizedDocumentRepo
     */
    private $digitizedDocumentRepo;
    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;
    /**
     * @var DocumentCommentRepository
     */
    private $documentCommentRepository;
    /**
     * @var InstitutionRepository
     */
    private $institutionRepository;
    /**
     * @var DocumentTimelineRepository
     */
    private $documentTimelineRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository,
                                OutgoingDocumentRepository $outgoingDocumentRepository,
                                IncomingDocumentRepo $incomingDocumentRepo,
                                DigitizedDocumentRepo $digitizedDocumentRepo,
                                FiscalYearRepository $fiscalYearRepository,
                                DocumentCommentRepository $documentCommentRepository,
                                InstitutionRepository $institutionRepository,
                                DocumentTimelineRepository $documentTimelineRepository)
    {

        $this->middleware(['auth', 'roles']);
        $this->userRepository = $userRepository;
        $this->outgoingDocumentRepository = $outgoingDocumentRepository;
        $this->incomingDocumentRepo = $incomingDocumentRepo;
        $this->digitizedDocumentRepo = $digitizedDocumentRepo;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->documentCommentRepository = $documentCommentRepository;
        $this->institutionRepository = $institutionRepository;
        $this->documentTimelineRepository = $documentTimelineRepository;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $totalUser = $this->userRepository->all();
        $totalOutgoing = $this->outgoingDocumentRepository->all($request)->get();
        $totalOutgoingDocument=$totalOutgoing;
        $signatures = $this->userRepository->signatureAllowOtherList();
        $totalIncoming = $this->incomingDocumentRepo->getfilter($request)->get();
        $totalIncomingDocument = $totalIncoming;
        $totalDigitize = $this->digitizedDocumentRepo->getDigitizedDocument($request)->get();
        $totalDigitizedDocument = $totalDigitize->take(5);
        $totalIssued = $this->outgoingDocumentRepository->getDocumentByStatus('issued');
        $totalIssuedDocument = $totalIssued;
        $totalDraftDocument = $this->outgoingDocumentRepository->getDocumentByStatus('draft')->take(5);
        $totalInstitution = $this->institutionRepository->all($request);
     
        //report line chart
        $monthList = $this->fiscalYearRepository->getMonths();
        $calender=MasterSetting::where('key_name','=','_GOOGLE_CALENDER_IFRAME_')->first();
 
 
        for ($i = 0; $i <= 11; $i++) {
            $incomingGraph[$i] = $this->incomingDocumentRepo->getDocumentByMonth($monthList[$i]);

            $outgoingGraph[$i] = $this->outgoingDocumentRepository->getDocumentByMonth($monthList[$i]);
            $issueDocumentGraph[$i] = $this->outgoingDocumentRepository->getIssuedDocumentByMonth($monthList[$i]);
            $digitizedGraph[$i] = $this->digitizedDocumentRepo->getDocumentByMonth($monthList[$i]);

        }
        $documentComments = $this->documentCommentRepository->all();
    
        //select * from users where id in(SELECT DISTINCT(user_id) FROM `user_log_tables` where created_at BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY)created_at AND NOW())

//         $currentlyLoggedInUser=DB::select('select users.* from users where users.id in(SELECT DISTINCT(user_id) FROM `user_log_tables` where created_at BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW())');


        $currentlyLoggedInUser = DB::select('select users.* from users where users.id in(SELECT DISTINCT(user_id) FROM `user_log_tables` where created_at BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()) ORDER BY created_at DESC ');
       
        //         $currentlyLoggedInUser=DB::select('select distinct user_id
//from user_log_tables GROUP BY user_id ORDER BY created_at desc');


//        join('users','users.id','=','user_log_tables.user_id')->orderBy('user_log_tables.created_at','desc')->paginate(8);
        $userActivity = $this->userRepository->getUserActivity()->get();
       
//        dd($userActivity);
        $userActivity = $userActivity->take(5);
     
        $recentlyAddedDocuments = $this->documentTimelineRepository->getRecentlyAddedDocuments();

        $recentlyAddedDocuments = array_slice($recentlyAddedDocuments, 0, 5);
     
//        dd($userActivity);
//        dd($documentComments);
//        dd($documentComments);


        $usersOnline = $this->userRepository->online();
        return view('home', compact('totalUser', 'totalOutgoingDocument', 'totalIncomingDocument', 'totalDigitizedDocument',
            'totalIssuedDocument', 'totalInstitution', 'incomingGraph', 'monthList', 'outgoingGraph', 'digitizedGraph', 'issueDocumentGraph','recentlyAddedDocuments',
            'signatures', 'totalDraftDocument', 'documentComments', 'currentlyLoggedInUser', 'userActivity','usersOnline',
            'calender','totalDigitize','totalIssued','totalIncoming','totalOutgoing'));
    }




    /*
     * public function yearWiseProposalCount(Request $request){
        $auth = $request->get('auth');

        $proposals = array();
        if($auth == $this->api_authKey)
        {
            $years = $this->proposalRepo->getYears();

            foreach($years as $year) {

                //  $proposals['years'][] = $years;
                if($year->date>0)
                    $proposals['yearlyData'][$year->date] = $this->proposalRepo->proposalCountYearWise($year->date);

            }
            $proposals['ResearchAreas'] = $this->researchAreaRepo->all()->get();
            return response($proposals);

        }else{
            $arr = ['msg'=>'Invalid Auth Key provided'];
            return json_encode($arr);
        }
    }*/
}



/*

@if($documentComment->document_comments_type=="incoming")
                                                <?php $document=\App\Models\IncomingDocument::find($documentComment->document_id)?>
@if($document!=null)

@endif

@elseif($documentComment->document_comments_type=="outgoing")
<?php $document=\App\Models\IncomingDocument::find($documentComment->document_id)?>
@if($document!=null)
<div class="direct-chat-msg">
    <div class="direct-chat-info clearfix">
        <span class="direct-chat-name pull-left">{{$documentComment->user->name}}</span>

                                                    <span class="direct-chat-timestamp pull-right">
                                                    {{date("j M, Y H:i a", strtotime($documentComment->created_at))}}</span>
    </div>
    <!-- /.direct-chat-info -->
    @if($documentComment->user->user_image!=null)

    <img class="direct-chat-img" src="{{asset('/storage/avatar/'.$documentComment->user->user_image)}}"
         alt="message user image">
    @else
    <img class="direct-chat-img" src="{{url('uploads/users/dummyUser.png')}}"
         alt="message user image">

    @endif

    <!-- /.direct-chat-img -->
    <div class="direct-chat-text">
        "{{$documentComment->document_comments_description}}" on {{$documentComment->document_comments_type}} document



        <a href="{{url('documents/outgoingDocument/'.$document->id)}}">{{$document->outgoing_document_subject}}</a>

    </div>
    <!-- /.direct-chat-text -->
</div>
@endif
@else
<?php $document=\App\Models\DigitizedDocument::find($documentComment->document_id)?>
@if($document!=null)
<div class="direct-chat-msg">
    <div class="direct-chat-info clearfix">
        <span class="direct-chat-name pull-left">{{$documentComment->user->name}}</span>

                                                    <span class="direct-chat-timestamp pull-right">
                                                    {{date("j M, Y H:i a", strtotime($documentComment->created_at))}}</span>
    </div>
    <!-- /.direct-chat-info -->
    @if($documentComment->user->user_image!=null)

    <img class="direct-chat-img" src="{{asset('/storage/avatar/'.$documentComment->user->user_image)}}"
         alt="message user image">
    @else
    <img class="direct-chat-img" src="{{url('uploads/users/dummyUser.png')}}"
         alt="message user image">

    @endif

    <!-- /.direct-chat-img -->
    <div class="direct-chat-text">
        "{{$documentComment->document_comments_description}}" on {{$documentComment->document_comments_type}} document



        <a href="{{url('documents/outgoingDocument/'.$document->id)}}">{{$document->document->name}}</a>

    </div>
    <!-- /.direct-chat-text -->
</div>
@endif
*/