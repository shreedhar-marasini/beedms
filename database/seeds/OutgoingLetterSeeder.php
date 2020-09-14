<?php

use Illuminate\Database\Seeder;

class OutgoingLetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dms_outgoing_documents')->truncate();


        $letters = array(
            array('id' => '3','institution_id' => '6','department_name' => '1', 'folder_id' => '0', 'outgoing_document_subject' => 'Request for Tender Purchase','template_id' => '6','signature_user_id' => '2','outgoing_document_content' => '<p style="text-align:center"><strong><u><span style="font-size:12.0pt">Subject: Request for Tender Purchase</span></u></strong></p>

<p><span style="font-size:12.0pt">Dear Sir/Madame,</span></p>

<p><span style="font-size:12.0pt">We, the undersigned, would like to request for the RFP Document/&nbsp;Tender for following details:</span></p>

<p><strong><span style="font-size:12.0pt">Missing/Found Person Database and Unidentified Bodies Database Software</span></strong></p>

<p><span style="font-size:12.0pt">Thanking you for your kind cooperation.</span></p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-04-09','deleted_at' => NULL,'created_at' => '2017-04-09 18:11:06','outgoing_issue_date' => '2017-04-09','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-QTE-1','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-04-09 22:29:12','outgoing_serial_number' => '1'),
            array('id' => '2','institution_id' => '1','department_name' => '1','folder_id' => '0', 'outgoing_document_subject' => 'Payment Release to Bank Account','template_id' => '3','signature_user_id' => '2','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p>We, the undersigned, would like to request you to make the balance Payment of 50% of contract amount, NRs. 11,46,950 (Including VAT) for the software Development service for &ldquo;<strong>CIMS Software Sync Management, Upgradation and Support</strong>&ldquo; as per the contract by depositing it to nominated bank account below.</p>

<p><strong>Bank Details </strong><br />
Account Name: Young Minds Creation Pvt. Ltd<br />
Bank Name and Branch: Nepal Investment Bank, New Baneshwor<br />
Bank a/c: 02801030250337<br />
&nbsp;</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-04-09','deleted_at' => NULL,'created_at' => '2017-04-02 16:35:28','outgoing_issue_date' => '2017-04-09','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-QTE-2','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-04-09 22:29:24','outgoing_serial_number' => '2'),
            array('id' => '4','institution_id' => '16','department_name' => '1','folder_id' => '0','outgoing_document_subject' => 'Request for Annual maintainace','template_id' => '1','signature_user_id' => '2','outgoing_document_content' => '<p>Date:_2017/04/10_________________</p>

<p>Dear Sir/Madam,<br />
We, the undersigned, offer to provide the consulting services for <strong>&ldquo;web best e-service software system)&rdquo; </strong>in accordance with your Request for Quotation and our Quotation as per TOR.</p>

<table align="left" border="1" cellpadding="0" cellspacing="0" class="Table" style="width:100%">
	<tbody>
		<tr>
			<td><strong>PARTICULARS</strong></td>
			<td style="text-align:right"><strong>AMOUNT IN NPR</strong></td>
		</tr>
		<tr>
			<td>Annaul Maintainace of&nbsp;web best&nbsp;E-service software system</td>
			<td style="text-align:right">10,000.00</td>
		</tr>
		<tr>
			<td style="text-align:right"><strong>VAT13%</strong></td>
			<td style="text-align:right">1,300.00</td>
		</tr>
		<tr>
			<td style="text-align:right"><strong>Total</strong></td>
			<td style="text-align:right"><strong>11,300.00</strong></td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<p>In Words:&nbsp;Eleven Thousand And Three Hundred Only.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-04-10','deleted_at' => NULL,'created_at' => '2017-04-10 15:32:07','outgoing_issue_date' => '2017-04-10','created_by_user_id' => '1','issued_by' => '1','outgoing_issue_number' => '1617-QTE-3','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-04-10 15:34:43','outgoing_serial_number' => '3'),
            array('id' => '5','institution_id' => '25','department_name' => '1', 'folder_id' => '0','outgoing_document_subject' => 'Project Submission, Launch & AMC','template_id' => '8','signature_user_id' => '1','outgoing_document_content' => '<p>With respect to contract signed on 2072-12-29, in between Young Minds Creation Pvt. Ltd and Department of Cottage and Small Industry (DCSI), for the development of <strong>Online Industry Registration System and e-Services</strong>, we visited DCSI and presented the finished software on the testing server to different officials and made necessary updates to system as required. We also have finished and submitted final software and reports on it during last fiscal year and have also recieved our payments as per the contract. However, we are unable to launch the system since the server has not been provided till date despite of several follow-ups over the email and phone.</p>

<p>Please note that it has already been one year since we were contracted and our free support is only <span style="color:#c0392b"><strong>valid till 2073-03-28</strong></span>. We would, therefore, like to request you to kindly provide us with your server details and access so that we can launch the software to your server.</p>

<p><strong>Attachments (with this letter)</strong>:</p>

<p>Final software source code with manuals in a Disc</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-04-12','deleted_at' => NULL,'created_at' => '2017-04-12 15:34:21','outgoing_issue_date' => '2017-04-12','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-PRJ-4','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-04-12 17:10:39','outgoing_serial_number' => '4'),
            array('id' => '6','institution_id' => '26','department_name' => '1', 'folder_id' => '0','outgoing_document_subject' => 'For Deadline Extension and Additional Work Quotation','template_id' => '1','signature_user_id' => '1','outgoing_document_content' => '<p>Dear Sir/ Madam,<br />
With reference to meeting held on 13-April-2017 at Practical Action Nepal Office, against contract SRM/AGF/2016-017/15 for the development of Market Information System, we discovered need of following additional works for the easy use and successful implementation of the system.</p>

<ul>
	<li>Frontend/ Public Web-Portal</li>
	<li>Resource Centre login for MIS for management of item price, mason, house sample cost</li>
	<li>Calculate the number of items according to the house dimension</li>
</ul>

<p>This requires <strong><span style="color:#c0392b">additional 15 working days time</span></strong> and additional cost for development. We, thus, request you to kindly extend <span style="color:#c0392b"><strong>delivery date to 15-May-2017.</strong></span> This might also push acceptance testing time simultaneously.&nbsp;</p>

<p>The initial contract amount was Rs. 782,525.00 inclusive of VAT for a work of 45 days which when converted to per day rate becomes Rs. 17,389.44. For additional 15 days work, we have estimated <span style="color:#c0392b"><strong>additional cost of Rs. 2,60,842</strong></span> (Two Lakhs Sixty Thousands Eight Hundreds and Forty Two Only) inclusive of VAT.</p>

<p>Please kindly consider this as formal quote and provide us with confirmation over the email to proceed ahead.</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-04-16','deleted_at' => NULL,'created_at' => '2017-04-16 12:50:10','outgoing_issue_date' => '2017-04-16','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-QTE-5','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-04-16 17:53:29','outgoing_serial_number' => '5'),
            array('id' => '7','institution_id' => '28','department_name' => '1', 'folder_id' => '0', 'outgoing_document_subject' => 'Quotation for SMS Services','template_id' => '1','signature_user_id' => '1','outgoing_document_content' => '<p><span style="font-size:12.0pt">Dear Sir/Madam,</span></p>

<p style="text-align:justify"><span style="font-size:12.0pt">As per the requirement from ITMD, We are experienced SMS provider and eligible to provide quality of services.</span></p>

<p style="text-align:justify"><span style="font-size:12.0pt">We are providing complete SMS based services along with custom software development. We provide connectivity of all major telecom operators in Nepal for PUSH and PULL SMS facilities.</span></p>

<p style="text-align:justify"><span style="font-size:12.0pt">Please, find the quotation below as per the requirement along with required documents:</span></p>

<table border="1" cellspacing="0" class="MsoTableGrid" style="border-collapse:collapse; border:solid windowtext 1.0pt; width:648px">
	<tbody>
		<tr>
			<td style="width:31.25pt">
			<p style="text-align:justify"><span style="font-size:12.0pt">SN</span></p>
			</td>
			<td style="width:153.0pt">
			<p style="text-align:justify"><span style="font-size:12.0pt">Particular</span></p>
			</td>
			<td style="width:45.0pt">
			<p style="text-align:justify"><span style="font-size:12.0pt">Qty.</span></p>
			</td>
			<td style="width:63.0pt">
			<p style="text-align:justify"><span style="font-size:12.0pt">Rate (NRs)</span></p>
			</td>
			<td style="width:67.5pt">
			<p style="text-align:justify"><span style="font-size:12.0pt">Total (NRs.)</span></p>
			</td>
			<td style="width:1.75in">
			<p style="text-align:justify"><span style="font-size:12.0pt">Remarks</span></p>
			</td>
		</tr>
		<tr>
			<td style="width:31.25pt">
			<p style="text-align:justify"><span style="font-size:12.0pt">1.</span></p>
			</td>
			<td style="width:153.0pt">
			<p><span style="font-size:12.0pt">Telecom Connectivity Integration along with API services</span></p>
			</td>
			<td style="width:45.0pt">
			<p style="text-align:justify"><span style="font-size:12.0pt">1</span></p>
			</td>
			<td style="width:63.0pt">
			<p style="text-align:justify"><span style="font-size:12.0pt">150,000</span></p>
			</td>
			<td style="width:67.5pt">
			<p style="text-align:justify"><span style="font-size:12.0pt">1,50,000</span></p>
			</td>
			<td style="width:1.75in">
			<p><span style="font-size:12.0pt">Yearly System Integration and Support Charge</span></p>
			</td>
		</tr>
		<tr>
			<td style="width:31.25pt">
			<p style="text-align:justify"><span style="font-size:12.0pt">2.</span></p>
			</td>
			<td style="width:153.0pt">
			<p style="text-align:justify"><span style="font-size:12.0pt">SMS Charges</span></p>
			</td>
			<td style="width:45.0pt">
			<p style="text-align:justify"><span style="font-size:12.0pt">1</span></p>
			</td>
			<td style="width:63.0pt">
			<p style="text-align:justify"><span style="font-size:12.0pt">1.6</span></p>
			</td>
			<td style="width:67.5pt">
			<p style="text-align:justify"><span style="font-size:12.0pt">1.6</span></p>
			</td>
			<td style="width:1.75in">
			<p style="text-align:justify"><span style="font-size:12.0pt">Per SMS</span></p>
			</td>
		</tr>
	</tbody>
</table>

<p style="text-align:justify"><em><span style="font-size:12.0pt">All the above cost are exclusive of 13% VAT</span></em></p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-04-19','deleted_at' => NULL,'created_at' => '2017-04-19 17:02:10','outgoing_issue_date' => '2017-04-19','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-QTE-6','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-04-19 17:07:05','outgoing_serial_number' => '6'),
            array('id' => '8','institution_id' => '25','department_name' => '1', 'folder_id' => '0', 'outgoing_document_subject' => 'OIRS made online to our test server.','template_id' => '8','signature_user_id' => '2','outgoing_document_content' => '<p>With reference to letter received on&nbsp;2073-12-31 with letter no 1688 from Department of Cottage and Small Industry (DoCSI) for the development of Online Industry Registration System and e-Services, we have uploaded a fresh copy of system at following address to meet your request.</p>

<p><strong>ADMIN LOGIN PAGE:</strong> <a href="http://174.136.57.48/~youngmin/ym$/oirs/public/login">http://174.136.57.48/~youngmin/ym$/oirs/public/login</a><br />
<strong>ADMIN USER NAME: </strong><a href="mailto:oirs@gmail.com">oirs@youngminds.com.np</a><br />
<strong>ADMIN PASSWORD: </strong>SysAD58KLt<br />
<br />
<strong>CLIENT LOGIN PAGE:</strong> <a href="http://174.136.57.48/~youngmin/ym$/oirs/public/index">http://174.136.57.48/~youngmin/ym$/oirs/public/index</a><br />
<strong>CLIENT USER NAME: </strong><a href="mailto:newcompany@gmail.com">newcompany@youngminds.com.np</a><br />
<strong>CLIENT PASSWORD: </strong>newKomPany684K</p>

<p>If you need any support, please contact Srijan Karki, srijan@youngminds.com.np, 9841939716.</p>

<p>NOTE: The test server will remain online for 1 month from today.</p>

<p>&nbsp;</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-04-20','deleted_at' => NULL,'created_at' => '2017-04-20 14:34:06','outgoing_issue_date' => '2017-04-20','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-PRJ-7','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-04-20 14:35:05','outgoing_serial_number' => '7'),
            array('id' => '9','institution_id' => '4','department_name' => '1', 'folder_id' => '0', 'outgoing_document_subject' => 'Quotation for GSuite','template_id' => '1','signature_user_id' => '2','outgoing_document_content' => '<p>Dear Sir/Madam,<br />
We, the undersigned, offer to provide the <strong>quotation for GSuite </strong>in accordance with your Request for Quotation and our Quotation as per TOR.</p>

<p>&nbsp;</p>

<table align="left" border="1" cellpadding="0" cellspacing="0" class="Table" style="border:1px solid #333333; width:100%">
	<tbody>
		<tr>
			<td style="width:70%"><strong>PARTICULARS</strong></td>
			<td style="text-align:right"><strong>AMOUNT IN NPR</strong></td>
		</tr>
		<tr>
			<td>Restoring G-Suite Email for 1 month</td>
			<td style="text-align:right">12,000.00</td>
		</tr>
		<tr>
			<td style="text-align:right"><strong>Total</strong></td>
			<td style="text-align:right"><strong>12,000.00</strong></td>
		</tr>
		<tr>
			<td style="text-align:right"><strong>13% VAT</strong></td>
			<td style="text-align:right"><strong>1,560.00</strong></td>
		</tr>
		<tr>
			<td style="text-align:right"><strong>Grand Total</strong></td>
			<td style="text-align:right"><strong>13,560.00</strong></td>
		</tr>
		<tr>
			<td colspan="2">In Words: Thirteen Thousands Five Hundreds and Sixty</td>
		</tr>
		<tr>
			<td colspan="2"><em>NOTE: Quotation valid for 2 weeks and payment has to be made within 1 week from the date of contract.</em></td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<p>&nbsp;</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-04-23','deleted_at' => NULL,'created_at' => '2017-04-25 14:02:11','outgoing_issue_date' => '2017-04-23','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-QTE-8','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-04-25 14:02:33','outgoing_serial_number' => '8'),
            array('id' => '10','institution_id' => '4','department_name' => '1','folder_id' => '0', 'outgoing_document_subject' => 'Payment Release for GSuite Services','template_id' => '3','signature_user_id' => '2','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p style="text-align:justify">We, hereby, submit our Tax Invoice and request you to kindly release the payment at earliest.</p>

<p style="text-align:justify">We also request to make the payment to our bank account if possible.</p>

<p style="text-align:justify"><strong>Bank Details</strong><br />
A/C Name: Young Minds Creation (P) Ltd<br />
Bank A/C No: 02801030250337, Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-04-25','deleted_at' => NULL,'created_at' => '2017-04-25 18:35:38','outgoing_issue_date' => '2017-04-25','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-PRQ-9','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-04-25 18:35:47','outgoing_serial_number' => '9'),
            array('id' => '11','institution_id' => '31','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Internship Completion','template_id' => '5','signature_user_id' => '1','outgoing_document_content' => '<p>This is to certify that <strong>Mr. Srijan Karki</strong> of Islington College has successfully completed his Internship of 90 days in this company. His tasks as an intern are as mentioned below.</p>

<p><strong>SUMMARY</strong><br />
<strong>Job Position: Intern</strong></p>

<p><strong>Job Description:</strong><br />
Design and Develop Content Management System (CMS) using Laravel, CSS, Bootstrap and JavaScript. After the completion of this task he was added to a team under a developer and real time task was assigned.<br />
During these tasks we noticed he has great progressive skills and can handle multiple tasks at the same time.</p>

<p><strong>Date Joined:</strong> 7-June-2015&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<br />
<strong>Completed on: </strong>30-September-2015<br />
<strong>Performance:</strong> Excellent</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2015-10-20','deleted_at' => NULL,'created_at' => '2017-04-27 14:09:17','outgoing_issue_date' => '2017-04-27','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-HR-10','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-04-27 14:15:23','outgoing_serial_number' => '10'),
            array('id' => '12','institution_id' => '31','department_name' => '1','folder_id'=>'0','folder_id' => '0','outgoing_document_subject' => 'Work Experience Letter','template_id' => '5','signature_user_id' => '1','outgoing_document_content' => '<p>This is to certify that <strong>Mr. Srijan Karki</strong> (DOB: May 05, 1995), has been responsibly working as a <strong>full time Software Developer</strong> in this company <strong>since February 03, 2016</strong> and company proudly recommends him for his future plans.</p>

<p>Some of the projects he has completed as a Software Developer in this company are listed below:</p>

<ol>
	<li>Morang Auto Work&rsquo;s (MAW) Customer Relationship Management System.</li>
	<li>Central Dairy Cooperative Association Nepal&rsquo;s (CDCAN) Farmer/ Cattle Information Management System.</li>
	<li>Department of Small and Cottage Industry, Ministry of Industry, Government of Nepal, Online Industry Registration Management System (OIRS).</li>
	<li>Pokhara University&rsquo;s Exam Management System.</li>
</ol>

<p>He has been participating in performing the work with determination and sincerity. Over the time period of his work tenure, company has perceived him as an active, qualified and efficient Software Developer, who performs all of the assigned tasks efficiently. He is a valuable asset of our organization and we wish him Success in his future endeavors. We are pleased to commend him for his higher studies as well as his competencies in Software Development and Design in IT industry. Please feel free to contact us for any queries related to him.</p>

<p>&nbsp;</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-03-29','deleted_at' => NULL,'created_at' => '2017-04-27 14:13:33','outgoing_issue_date' => '2017-03-29','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-HR-11','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-04-27 14:16:23','outgoing_serial_number' => '11'),
            array('id' => '14','institution_id' => '4','department_name' => '1','folder_id'=>'0','folder_id' => '0','outgoing_document_subject' => 'payment request','template_id' => '3','signature_user_id' => '3','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p style="text-align:justify">With reference to service provided to NHRC for server migration to GIDC<strong>, w</strong>e, hereby, submit our Tax Invoice and request you to kindly release the payment at earliest.</p>

<p style="text-align:justify">We also request to make the payment to our bank account if possible.</p>

<p style="text-align:justify"><strong>Bank Details</strong><br />
A/C Name: Young Minds Creation (P) Ltd<br />
Bank A/C No: 02801030250337, Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-05-07','deleted_at' => NULL,'created_at' => '2017-05-07 17:03:49','outgoing_issue_date' => '2017-05-07','created_by_user_id' => '1','issued_by' => '1','outgoing_issue_number' => '1617-PRQ-12','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-05-07 17:25:40','outgoing_serial_number' => '12'),
            array('id' => '13','institution_id' => '33','department_name' => '1','folder_id'=>'0','folder_id' => '0','outgoing_document_subject' => 'Power of Attorney','template_id' => '4','signature_user_id' => '2','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p>We, the undersigned, would like to grant the power of attorney to Mr. Suraj Bhattarai to apply for new blue book for vehicle BA38PA 7030 registered in the name of Young Minds Creation (P) Ltd.</p>

<p>&nbsp;</p>

<p>__________________________<br />
Suraj Bhattarai</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-05-02','deleted_at' => NULL,'created_at' => '2017-05-02 18:32:02','outgoing_issue_date' => '2017-05-02','created_by_user_id' => '1','issued_by' => '1','outgoing_issue_number' => '1617-BG-13','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-05-07 20:57:39','outgoing_serial_number' => '13'),
            array('id' => '16','institution_id' => '7','department_name' => '1','folder_id'=>'0','folder_id' => '0','outgoing_document_subject' => 'Payroll Advice','template_id' => '10','signature_user_id' => '2','outgoing_document_content' => '<div style="margin-top:30px">
<p>Dear Sir,<br />
Please debit our account for Young Minds Creation(P) Ltd at your branch with account number <strong>02801030250337</strong> and creditrespective amount to respective account number as mentioned below for the salary settlement.</p>

<p>Salary for the period of : 2017-04 April</p>

<table border="1" cellspacing="0">
	<tbody>
		<tr>
			<td style="width:5%"><strong>SN.</strong></td>
			<td><strong>Name</strong></td>
			<td style="width:20%"><strong>Account No.</strong></td>
			<td style="width:20%"><strong>Amount (Rs.)</strong></td>
		</tr>
		<tr>
			<td>1</td>
			<td>Nirmala Shrestha</td>
			<td>02805080373265</td>
			<td>14,270.00</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Puja Kumari Sah</td>
			<td>02805080379540</td>
			<td>6,937.00</td>
		</tr>
		<tr>
			<td>3</td>
			<td>Santosh Dhungana</td>
			<td>02805080381611</td>
			<td>7,656.00</td>
		</tr>
		<tr>
			<td>4</td>
			<td>Suraj Bhattarai</td>
			<td>02805080382229</td>
			<td>7,920.00</td>
		</tr>
		<tr>
			<td>5</td>
			<td>Shristi Maharjan</td>
			<td>00405080346214</td>
			<td>5,285.00</td>
		</tr>
		<tr>
			<td>6</td>
			<td>Srijan Karki</td>
			<td>02805080369190</td>
			<td>17,226.00</td>
		</tr>
		<tr>
			<td>7</td>
			<td>Sunita Tamang</td>
			<td>02105080069605</td>
			<td>19,800.00</td>
		</tr>
		<tr>
			<td>8</td>
			<td>Sushil Timilsina</td>
			<td>02805080374002</td>
			<td>14,784.00</td>
		</tr>
		<tr>
			<td colspan="3" style="width:391.25pt">Total</td>
			<td><strong>93,878.00</strong></td>
		</tr>
		<tr>
			<td colspan="4">In Words: Ninety Three Thousands Eight Hundreds and Seventy Eight</td>
		</tr>
	</tbody>
</table>
</div>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-05-08','deleted_at' => NULL,'created_at' => '2017-05-08 13:15:19','outgoing_issue_date' => '2017-05-08','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-SS-14','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-05-08 14:11:09','outgoing_serial_number' => '14'),
            array('id' => '15','institution_id' => '6','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Power of Attorney','template_id' => '11','signature_user_id' => '2','outgoing_document_content' => '<p>We, the undersigned, are sending below personnel for the negotiation, discussion and decision making on the project &quot;Missing/Found Person Database and Unidentified Bodies Database Software&quot;.</p>

<p>&nbsp;</p>

<p>_______________________<br />
Abhijit Gupta - Director</p>

<p>&nbsp;</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-05-12','deleted_at' => NULL,'created_at' => '2017-05-07 17:11:37','outgoing_issue_date' => '2017-05-12','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-POA-15','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-05-12 14:27:02','outgoing_serial_number' => '15'),
            array('id' => '17','institution_id' => '4','department_name' => '2','folder_id'=>'0','outgoing_document_subject' => 'payment request','template_id' => '3','signature_user_id' => '3','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p style="text-align:justify">With reference to contract signed with Young Minds Creations Pvt. Ltd on 2073-11-15<strong>&nbsp;</strong>for providing the consulting service for &ldquo;<strong>Upgrading Ethical Review System V.2.</strong>&rdquo;, we have finished all tasks as per the contract. We, hereby, submit our Tax Invoice and request you to kindly release the payment at earliest.</p>

<p style="text-align:justify">We also request to make the payment to our bank account if possible.</p>

<p style="text-align:justify"><strong>Bank Details</strong><br />
A/C Name: Young Minds Creation (P) Ltd<br />
Bank A/C No: 02801030250337, Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-05-16','deleted_at' => NULL,'created_at' => '2017-05-17 14:41:08','outgoing_issue_date' => '2017-05-16','created_by_user_id' => '1','issued_by' => '1','outgoing_issue_number' => '1617-PRQ-16','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-05-17 14:42:16','outgoing_serial_number' => '16'),
            array('id' => '18','institution_id' => '17','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Deadline Extension','template_id' => '12','signature_user_id' => '1','outgoing_document_content' => '<p>With reference to contract signed on <strong>30-Jan-2017</strong> in between Young Minds Creation Pvt. Ltd and SJVN Arun-3 power Development Company (P) Ltd, for &quot;<strong>PCRD-70/2016 Design of Corporate Website</strong>&quot;, we are sorry to inform you that, we are unable to deliver the project within the deadline because of the several internal problems in our company.</p>

<p>We, hereby, request you to kindly extend the deadline by 1 month.</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-05-21','deleted_at' => NULL,'created_at' => '2017-05-22 14:04:31','outgoing_issue_date' => '2017-05-21','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-EXT-17','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-05-22 14:04:50','outgoing_serial_number' => '17'),
            array('id' => '19','institution_id' => '17','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Inception Report','template_id' => '13','signature_user_id' => '1','outgoing_document_content' => '<p>With reference to contract signed on 30-Jan-2017 in between SJVN Arun-3 power Development Company (P) Ltd and Young Minds Creation (P) Ltd for &quot;<strong>PCRD-70/2016 Design of Corporate Website</strong>&quot;, we, hereby, are submitting inception report. Please find the report attached with this letter.</p>

<p>Should you have any questions, please feel free to send us an email at info@youngminds.com.np or call us at 9851151705/ 9851151706.</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-05-22','deleted_at' => NULL,'created_at' => '2017-05-22 14:26:52','outgoing_issue_date' => '2017-05-22','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-INC-18','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-05-22 14:54:35','outgoing_serial_number' => '18'),
            array('id' => '20','institution_id' => '31','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Appointment as Intern','template_id' => '16','signature_user_id' => '1','outgoing_document_content' => '<p>This is to inform that Ms. Saraswati Saud, student of BIM 8th semester from St. Xavier&rsquo;s College, Maitighar has been accepted for her internship in this company. Her internship details are as summarized below.</p>

<p><strong>INTERNSHIP DETAILS:</strong></p>

<p>Internship Title: Ruby on Rails Developer<br />
Position Title: Intern<br />
Duration: 3 months (20 hrs/week)<br />
Start Date: 10 May, 2017<br />
End Date: 10 August, 2017</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-05-28','deleted_at' => NULL,'created_at' => '2017-05-28 16:53:38','outgoing_issue_date' => '2017-05-28','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-HR-19','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-05-28 17:02:41','outgoing_serial_number' => '19'),
            array('id' => '21','institution_id' => '7','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'For Performance Bond','template_id' => '15','signature_user_id' => '1','outgoing_document_content' => '<p>With reference to board decisions and negotiations held with Nepal Police Headquarter for the Consulting Service procurement for Design, Development and Implementation of Intranet Based System for Missing/ Found Person Database and Unidentified Dead Bodies Database, we, hereby, request bank to issue a performance bond as mentioned below.</p>

<p>To: Crime Investigation Department, Nepal Police Headquarter, Naxal, Kathmandu<br />
Contract Amount: Rs. 31,00,000+VAT<br />
Performance Bond Amount: Rs. 1,55,000/-<br />
Validity: August 2018</p>

<p>Bank is adviced to debit necessary fund and charges required for this performance bond from our bank account (02801030250337) held at your New Baneshwor Branch.</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-05-28','deleted_at' => NULL,'created_at' => '2017-05-28 19:12:33','outgoing_issue_date' => '2017-05-28','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-BG-20','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-05-28 19:13:57','outgoing_serial_number' => '20'),
            array('id' => '22','institution_id' => '35','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'For Releasing Retention Amount','template_id' => '4','signature_user_id' => '1','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p style="text-align:justify">We, the undersigned, would like to request you to release our retention money of amount Rs. 37921.30. We also request to refund any deposits or retentions money to our bank account as mentioned below if possible.</p>

<p style="text-align:justify"><strong>Bank Details</strong><br />
A/C Name: Young Minds Creation (P) Ltd<br />
Bank A/C No: 02801030250337, Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</p>

<p style="text-align:justify">Please be kind to send us an email with transfer details so that we can track the transfer.</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-05-30','deleted_at' => NULL,'created_at' => '2017-05-30 16:21:38','outgoing_issue_date' => '2017-05-30','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-BG-21','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-05-30 16:22:07','outgoing_serial_number' => '21'),
            array('id' => '23','institution_id' => '26','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Payment Request','template_id' => '3','signature_user_id' => '3','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p style="text-align:justify">With reference to contract signed with Young Minds Creations Pvt. Ltd on 6 March, 2017<strong>&nbsp;</strong>for providing the consulting service for &ldquo;<strong>Market Information System (MIS) of construction materials for earthquake affected districts</strong>&rdquo;, we have finished all tasks as per the contract. We, hereby, submit our Tax Invoice and request you to kindly release the payment at earliest.</p>

<p style="text-align:justify">We also request to make the payment to our bank account if possible.</p>

<p style="text-align:justify"><strong>Bank Details</strong><br />
A/C Name: Young Minds Creation (P) Ltd<br />
Bank A/C No: 02801030250337, Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</p>

<p style="text-align:justify"><strong>Attached with this letter:</strong><br />
Scanned Invoice (Original Documents will be dropped while collecting the cheque)</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-05-31','deleted_at' => NULL,'created_at' => '2017-05-31 17:23:41','outgoing_issue_date' => '2017-05-31','created_by_user_id' => '1','issued_by' => '1','outgoing_issue_number' => '1617-PRQ-22','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-05-31 17:29:55','outgoing_serial_number' => '22'),
            array('id' => '24','institution_id' => '5','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Quotation for the Website Development Upgradation and OnSite Website Data Entry Support and Maintenance','template_id' => '1','signature_user_id' => '1','outgoing_document_content' => '<p>Dear Sir/Madam,<br />
We, the undersigned, offer to provide the consulting services for <strong>&ldquo;Website Development Upgradation and OnSite Website Data Entry Support &amp; Maintenance&rdquo; </strong>in accordance with your Request for Quotation and our Quotation as per TOR.</p>

<table align="left" border="1" cellpadding="0" cellspacing="0" class="Table" style="border:1px solid #333333; width:100%">
	<tbody>
		<tr>
			<td style="background-color:#dddddd; width:70%"><strong>PARTICULARS</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>AMOUNT IN NPR</strong></td>
		</tr>
		<tr>
			<td>Website Upgradation</td>
			<td style="text-align:right">1,50,000.00</td>
		</tr>
		<tr>
			<td>1 Year Data Entry and Support (Total Visits 12)</td>
			<td style="text-align:right">50,000.00</td>
		</tr>
		<tr>
			<td>Training and Support to Website Admin</td>
			<td style="text-align:right">&nbsp;</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>Sub Total</strong></td>
			<td style="background-color:#dddddd; text-align:right">2,00,000.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>VAT13%</strong></td>
			<td style="background-color:#dddddd; text-align:right">26,000.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>Total</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>2,26,000.00</strong></td>
		</tr>
		<tr>
			<td colspan="2">In Words: Two Lakhs Twenty Six Thousands Rupees Only</td>
		</tr>
		<tr>
			<td colspan="2">Note: Quotation is only valid for 2 weeks.</td>
		</tr>
	</tbody>
</table>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-06-06','deleted_at' => NULL,'created_at' => '2017-06-06 13:48:43','outgoing_issue_date' => '2017-06-06','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-QTE-23','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-06-06 13:52:45','outgoing_serial_number' => '23'),
            array('id' => '25','institution_id' => '36','department_name' => '2','folder_id'=>'0','outgoing_document_subject' => 'Request for Tender Purchase','template_id' => '6','signature_user_id' => '4','outgoing_document_content' => '<p>Dear Sir/Madame,</p>

<p>We, the undersigned, would like to request for &nbsp;the RFP Document/ Tender for following details:<br />
<br />
CCTV Supply and &nbsp;Installation.</p>

<p>&nbsp;</p>

<p>Enclosed with this letter are</p>

<ol>
	<li>Company Registration</li>
	<li>VAT Certificate</li>
	<li>Latest Tax Clearance</li>
</ol>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-06-09','deleted_at' => NULL,'created_at' => '2017-06-09 17:33:58','outgoing_issue_date' => '2017-06-09','created_by_user_id' => '1','issued_by' => '1','outgoing_issue_number' => '1617-TDR-24','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-06-09 17:34:22','outgoing_serial_number' => '24'),
            array('id' => '26','institution_id' => '37','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Quotation for Logo & Brand (TVET 090617)','template_id' => '1','signature_user_id' => '1','outgoing_document_content' => '<p>Dear Sir/Madam,<br />
We, the undersigned, offer to provide the services for <strong>&ldquo;</strong>Quotation for Logo &amp; Brand (TVET 090617)<strong>&rdquo; </strong>in accordance with your Request for Quotation and our Quotation as per TOR.</p>

<table align="left" border="1" cellpadding="0" cellspacing="0" class="Table" style="border:1px solid #333333; width:100%">
	<tbody>
		<tr>
			<td style="background-color:#dddddd; width:70%"><strong>PARTICULARS</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>AMOUNT IN NPR</strong></td>
		</tr>
		<tr>
			<td>Logo Design</td>
			<td style="text-align:right">50,000.00</td>
		</tr>
		<tr>
			<td>Stationery (letterhead, business cards, email signature)</td>
			<td style="text-align:right">50,000.00</td>
		</tr>
		<tr>
			<td>Brochure</td>
			<td style="text-align:right">25,000.00</td>
		</tr>
		<tr>
			<td>Workshop File Folder</td>
			<td style="text-align:right">25,000.00</td>
		</tr>
		<tr>
			<td>PowerPoint Template (editable)</td>
			<td style="text-align:right">25,000.00</td>
		</tr>
		<tr>
			<td>Banners (2 Versions)</td>
			<td style="text-align:right">25,000.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>Sub Total</strong></td>
			<td style="background-color:#dddddd; text-align:right">2,00,000.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>VAT13%</strong></td>
			<td style="background-color:#dddddd; text-align:right">26,000.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>Total</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>2,26,000.00</strong></td>
		</tr>
		<tr>
			<td colspan="2">In Words: Two Lakhs Twenty Six Thousands Rupees Only</td>
		</tr>
		<tr>
			<td colspan="2">Note: Quotation is only valid for 30 days from the date of issue.</td>
		</tr>
	</tbody>
</table>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-06-11','deleted_at' => NULL,'created_at' => '2017-06-11 14:22:21','outgoing_issue_date' => '2017-06-11','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-QTE-25','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-06-11 16:01:25','outgoing_serial_number' => '25'),
            array('id' => '27','institution_id' => '35','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Refund Bid Security Deposit','template_id' => '4','signature_user_id' => '1','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p>We, the undersigned, would like to request to release our BidBod Deposit of Rs. 19,000.00 submitted to AEPC for different projects as mentioned below.</p>

<p>- ReTender of Disaster Recovery&nbsp; (DR) Hosting and&nbsp; Annual Maintenance (Rs. 9,000)<br />
- ReTender of IT Annual&nbsp; Maintenance Contract&nbsp; for AEPC/NRREP (Rs. 10,000)</p>

<p style="text-align:justify">We also request to refund any deposits or retentions money to our bank account as mentioned below if possible.</p>

<p style="text-align:justify"><strong>Bank Details</strong><br />
A/C Name: Young Minds Creation (P) Ltd<br />
Bank A/C No: 02801030250337, Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-06-11','deleted_at' => NULL,'created_at' => '2017-06-11 16:11:17','outgoing_issue_date' => '2017-06-11','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-BG-26','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-06-11 16:11:47','outgoing_serial_number' => '26'),
            array('id' => '28','institution_id' => '3','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Project Completion','template_id' => '8','signature_user_id' => '1','outgoing_document_content' => '<p>With reference to visit made by PoU official from 2017-06-04 to&nbsp;2017-06-07, we, hereby, acknowledge that all processess in the system was successfully explained and during this observation some important and minor changes were requested and has also been taken care off.</p>

<p>We have finished the project as per the ToR and feedback provided by PoU officials. Please kindly check and provide necessary feedback on this. We will then visit PoU in person for deployment.</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-06-11','deleted_at' => NULL,'created_at' => '2017-06-11 16:55:26','outgoing_issue_date' => '2017-06-11','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-PRJ-27','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-06-11 16:55:33','outgoing_serial_number' => '27'),
            array('id' => '29','institution_id' => '7','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Update mobile number and email address to your database','template_id' => '17','signature_user_id' => '1','outgoing_document_content' => '<p>We, the undersigned, would like to request you to kindly add following mobile and email address to your database for our account with Account No: 02801030250337, NIBL, New Baneshwor Branch, Kathmandu and Internet Banking Username: 028YOUNG. This mobile number and email address shall be primarily used for online banking and transfer purpose and thus, please assure needed changes at your end.</p>

<p>Mobile Number: 9851151706<br />
Email: abhi@youngminds.com.np</p>

<p>Thank you.</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-06-12','deleted_at' => NULL,'created_at' => '2017-06-12 18:37:22','outgoing_issue_date' => '2017-06-12','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-REQB-28','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-06-12 18:38:24','outgoing_serial_number' => '28'),
            array('id' => '30','institution_id' => '6','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'For Mid-Term Presentation and Work Progress Demo','template_id' => '18','signature_user_id' => '1','outgoing_document_content' => '<p>With reference to contract signed on 2017-05-31, for Unidentified Dead Body Managenrent Data Base and Missing Person Data Base Software (PHQ/CID/RE912073-74lOl), we have made some progress in the development of &quot; Unidentified Dead Body Management Data Base and Missing person Data Base Software&quot;. We, thus, would like to request availability of your committee members on below mentioned date of time for mid-term presentation and demo on the progress. We aim to collect some necessary feedbacks to proceed ahead with the built.</p>

<p>Date: 2017-06-16<br />
Time: 11:00 AM<br />
Venue: CID, Nepal Police Headquarter, Kathmandu</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-06-13','deleted_at' => NULL,'created_at' => '2017-06-13 15:54:22','outgoing_issue_date' => '2017-06-13','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-PPT-29','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-06-13 16:15:51','outgoing_serial_number' => '29'),
            array('id' => '31','institution_id' => '3','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'System Deployed','template_id' => '8','signature_user_id' => '1','outgoing_document_content' => '<p>With reference to letter recieved on 2017-06-12 with number 491/073/074 from Pokhara University, we, hereby, confirm that the system has been successfully deployed remotely from our office to your server and has also been tested.</p>

<p>We are sending two of our team members (Mr. Shreedhar Marasini, Mr. Srijan Karki) to help you understand deliverables and finished product and also provide you with technical and manegerial training. The team members will be visiting your office on 18-June directly from the Airport.</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-06-16','deleted_at' => NULL,'created_at' => '2017-06-18 00:18:02','outgoing_issue_date' => '2017-06-16','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-PRJ-30','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-06-18 13:13:11','outgoing_serial_number' => '30'),
            array('id' => '32','institution_id' => '16','department_name' => '2','folder_id'=>'0','outgoing_document_subject' => 'Regarding Quotation for Hosting and online vacancy System ','template_id' => '1','signature_user_id' => '3','outgoing_document_content' => '<p>Dear Sir/Madam,<br />
We, the undersigned, offer to provide the consulting services for <strong>&ldquo;Hosting and Online Vacancy System&rdquo; </strong>in accordance with your Request for Quotation and our Quotation as per TOR.</p>

<table align="left" border="1" cellpadding="0" cellspacing="0" class="Table" style="border:1px solid #333333; width:100%">
	<tbody>
		<tr>
			<td style="background-color:#dddddd; width:70%"><strong>PARTICULARS</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>AMOUNT IN NPR</strong></td>
		</tr>
		<tr>
			<td>Hosting for six month</td>
			<td style="text-align:right">48000.00</td>
		</tr>
		<tr>
			<td>Online Vacancy System</td>
			<td style="text-align:right">40,000.00</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:right">&nbsp;</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>Sub Total</strong></td>
			<td style="background-color:#dddddd; text-align:right">88000.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>VAT13%</strong></td>
			<td style="background-color:#dddddd; text-align:right">11,440.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>Total</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>99,440.00</strong></td>
		</tr>
		<tr>
			<td colspan="2">In Words: Ninety Nine Thousand Four Hundred and Forty &nbsp;Rupees Only</td>
		</tr>
	</tbody>
</table>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-06-18','deleted_at' => NULL,'created_at' => '2017-06-18 15:14:43','outgoing_issue_date' => '2017-06-18','created_by_user_id' => '1','issued_by' => '1','outgoing_issue_number' => '1617-QTE-31','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-06-18 15:16:21','outgoing_serial_number' => '31'),
            array('id' => '33','institution_id' => '39','department_name' => '2','folder_id'=>'0','outgoing_document_subject' => 'Request for Tender/Bid Document Purchase','template_id' => '6','signature_user_id' => '4','outgoing_document_content' => '<p>Dear Sir/Madame,</p>

<p>We, the undersigned, would like to request for the Purchase of Tender/Bid Document for &quot;Vacancy Announcement and Online Application Registration System&quot;</p>

<p>Enclosed with this letter are</p>

<ol>
	<li>Company Registration</li>
	<li>VAT Certificate</li>
	<li>Latest Tax Clearance</li>
</ol>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-06-19','deleted_at' => NULL,'created_at' => '2017-06-19 18:21:24','outgoing_issue_date' => '2017-06-19','created_by_user_id' => '1','issued_by' => '1','outgoing_issue_number' => '1617-TDR-32','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-06-19 18:21:35','outgoing_serial_number' => '32'),
            array('id' => '34','institution_id' => '3','department_name' => '2','folder_id'=>'0','outgoing_document_subject' => 'Payment Request (4th Installment)','template_id' => '3','signature_user_id' => '3','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p style="text-align:justify">With reference to contract signed with Young Minds Creations Pvt. Ltd on <strong>7-Aug-2016&nbsp;</strong>for providing the consulting service for &ldquo;<strong>ePOU Exam Management Software</strong>&rdquo;, we have finished all tasks as per the ToR and have already deployed the system to POU Server. We, hereby, submit our Tax Invoice for 4th of 5 Installments and request you to kindly release the payment at earliest.</p>

<p style="text-align:justify">We also request to make the payment to our bank account if possible.</p>

<p style="text-align:justify"><strong>Bank Details</strong><br />
A/C Name: Young Minds Creation (P) Ltd<br />
Bank A/C No: 02801030250337, Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-06-20','deleted_at' => NULL,'created_at' => '2017-06-20 15:52:47','outgoing_issue_date' => '2017-06-20','created_by_user_id' => '1','issued_by' => '1','outgoing_issue_number' => '1617-PRQ-33','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-06-20 15:54:02','outgoing_serial_number' => '33'),
            array('id' => '35','institution_id' => '31','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Work Experience Letter','template_id' => '5','signature_user_id' => '2','outgoing_document_content' => '<p>This is to certify that <strong>Ms. Nirmala Shrestha</strong>, daughter of <strong>Mr. Theak Lal Shrestha</strong> was a full time developer at Young Minds Creation (P) Ltd. Her summary details for job are as mentioned below.</p>

<p><strong>SUMMARY: </strong><br />
Job Position: Sr. Software Programmer<br />
Job Description: Programming, work with team, interact with clients for requirement/built verification etc.<br />
Date of Join: 5-June-2016<br />
Date of Resignation: 26-June-2017<br />
Salary: Rs. 25,000.00 per month<br />
Performance: Good.</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-06-26','deleted_at' => NULL,'created_at' => '2017-06-26 20:29:55','outgoing_issue_date' => '2017-06-26','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-HR-34','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-06-26 20:30:19','outgoing_serial_number' => '34'),
            array('id' => '37','institution_id' => '27','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Deadline Extension','template_id' => '12','signature_user_id' => '1','outgoing_document_content' => '<p>With reference to contract signed with Exam Control Division of Institute of Engineering and Young Minds Creation Pvt. Ltd for &quot;Online Examination Form Registration and Processing Module&quot;, we hereby, acknowledge you that, we are unable to deliver the project within the deadline because of some issues in executig the development and implementation of the project.</p>

<p>We understand that ECD-IoE has already spend some time in this and yet, with apology, we request you to kindly extend the deadline by 2 month.</p>

<p><strong>Attachment</strong>: Software Readiness Measurement</p>
','outgoing_file_uploads' => '14985427478.docx','outgoing_document_date' => '2017-06-27','deleted_at' => NULL,'created_at' => '2017-06-27 15:37:27','outgoing_issue_date' => '2017-06-27','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-EXT-35','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-06-27 15:37:46','outgoing_serial_number' => '35'),
            array('id' => '38','institution_id' => '41','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'iCat.com.np Domain Registration','template_id' => '19','signature_user_id' => '1','outgoing_document_content' => '<p>We, the undersigned, would like to request you to register domain name as iCat.com.np. We have already filled online form.</p>

<p><strong>Who we are?</strong><br />
We are website, software designing and development company.</p>

<p><strong>Why?</strong><br />
We are in process to lauch an ecommerce web portal to sell clothing options.</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-06-27','deleted_at' => NULL,'created_at' => '2017-06-27 18:34:16','outgoing_issue_date' => '2017-06-27','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-DOM-36','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-06-27 18:34:35','outgoing_serial_number' => '36'),
            array('id' => '39','institution_id' => '1','department_name' => '2','folder_id'=>'0','outgoing_document_subject' => 'Regarding Quotation for Intranet System Upgradation and Support','template_id' => '1','signature_user_id' => '3','outgoing_document_content' => '<p>Dear Sir/Madam,<br />
We, the undersigned, offer to provide the consulting services for <strong>&ldquo;Intranet System Upgradation and Support&rdquo; </strong>in accordance with your Request for Quotation and our Quotation as per TOR.</p>

<table align="left" border="1" cellpadding="0" cellspacing="0" class="Table" style="border:1px solid #333333; width:100%">
	<tbody>
		<tr>
			<td style="background-color:#dddddd; width:70%"><strong>PARTICULARS</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>AMOUNT IN NPR</strong></td>
		</tr>
		<tr>
			<td>&nbsp; Intranet System Upgradation and Support</td>
			<td style="text-align:right">4,32,000 .00</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:right">&nbsp;</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>Sub Total</strong></td>
			<td style="background-color:#dddddd; text-align:right">4,32,000 .00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>VAT13%</strong></td>
			<td style="background-color:#dddddd; text-align:right">56,160.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>Total</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>4,88,160.00</strong></td>
		</tr>
		<tr>
			<td colspan="2">In Words: Four Lakhs Eighty Eight Thousand One Hundred and Sixty Rupees Only</td>
		</tr>
	</tbody>
</table>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-06-30','deleted_at' => NULL,'created_at' => '2017-06-30 20:05:45','outgoing_issue_date' => '2017-06-30','created_by_user_id' => '1','issued_by' => '1','outgoing_issue_number' => '1617-QTE-37','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-06-30 20:06:58','outgoing_serial_number' => '37'),
            array('id' => '40','institution_id' => '42','department_name' => '2','folder_id'=>'0','outgoing_document_subject' => 'Payment Request','template_id' => '3','signature_user_id' => '3','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p style="text-align:justify">With reference to contract signed with Young Minds Creations Pvt. Ltd on 2074/02/03<strong>&nbsp;</strong>for providing the consulting service for &ldquo;<strong>IP Camera Installation and Monitoring system development</strong>&rdquo;, we have finished all tasks as per the contract. We, hereby, submit our Tax Invoice and request you to kindly release the payment at earliest.</p>

<p style="text-align:justify">We also request to make the payment to our bank account if possible.</p>

<p style="text-align:justify"><strong>Bank Details</strong><br />
A/C Name: Young Minds Creation (P) Ltd<br />
Bank A/C No: 02801030250337, Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</p>
','outgoing_file_uploads' => '14990764312.jpeg','outgoing_document_date' => '2017-07-03','deleted_at' => NULL,'created_at' => '2017-07-03 19:47:34','outgoing_issue_date' => '2017-07-03','created_by_user_id' => '1','issued_by' => '1','outgoing_issue_number' => '1617-PRQ-38','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-07-03 19:52:54','outgoing_serial_number' => '38'),
            array('id' => '41','institution_id' => '7','department_name' => '2','folder_id'=>'0','outgoing_document_subject' => 'Payrol Advise/Salary Sheet','template_id' => '10','signature_user_id' => '1','outgoing_document_content' => '<div style="margin-top:30px">
<p>Dear Sir,<br />
Please debit our account for Young Minds Creation(P) Ltd at your branch with account number <strong>02801030250337</strong> and creditrespective amount to respective account number as mentioned below for the salary settlement.<br />
&nbsp;</p>

<p><strong>Salary for the period of :</strong>&nbsp;2017-06 June (२०७४ जेष्ठ १८ - २०७४ अषाढ १६)</p>

<table>
	<thead>
		<tr>
			<th>SN.</th>
			<th>Name</th>
			<th>Account No.</th>
			<th>Amount (Rs.)</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>1</td>
			<td>Puja Kumari Sah</td>
			<td>02805080379540</td>
			<td>&nbsp;7,399.00</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Santosh Dhungana</td>
			<td>02805080381611</td>
			<td>11,880.00</td>
		</tr>
		<tr>
			<td>3</td>
			<td>
			<table>
				<tbody>
					<tr>
						<td>Romin Maharjan</td>
						<td>&nbsp;</td>
						<td>
						<form action="http://hr.youngminds.com.np/employees/114/toggleBankDefault/49" method="POST">&nbsp;</form>
						</td>
					</tr>
				</tbody>
			</table>
			</td>
			<td>00405080033143</td>
			<td>29,700.00</td>
		</tr>
		<tr>
			<td>4</td>
			<td>Shristi Maharjan</td>
			<td>00405080346214</td>
			<td>11,892.00</td>
		</tr>
		<tr>
			<td>5</td>
			<td>Srijan Karki</td>
			<td>02805080369190</td>
			<td>24,750.00</td>
		</tr>
		<tr>
			<td>6</td>
			<td>Suraj Bhattarai</td>
			<td>02805080382229</td>
			<td>6,864.00</td>
		</tr>
		<tr>
			<td>7</td>
			<td>Sushil Timilsina</td>
			<td>02805080374002</td>
			<td>6,600.00</td>
		</tr>
		<tr>
			<th colspan="3">Total</th>
			<th>99,085.00</th>
		</tr>
		<tr>
			<td colspan="4"><strong>In Words : Ninety</strong>&nbsp;Nine Thousand&nbsp; Eighty Five Only.</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<p>&nbsp;</p>
</div>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-07-04','deleted_at' => NULL,'created_at' => '2017-07-04 16:37:12','outgoing_issue_date' => '2017-07-04','created_by_user_id' => '1','issued_by' => '1','outgoing_issue_number' => '1617-SS-39','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-07-04 18:11:23','outgoing_serial_number' => '39'),
            array('id' => '42','institution_id' => '6','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Interim Presentation','template_id' => '18','signature_user_id' => '2','outgoing_document_content' => '<p>With reference to contract signed on 17-Jestha-2074, we have finished the project and thus would like to show entire progress in the development of &quot;Unidentified Dead Body Management Data Base and Missing person Data Base Software&quot;. We, thus, would like to request availability of your committee members on below mentioned date of time for interim presentation on the progress.</p>

<p>Date: 03-July-2017<br />
Time: 11:00 AM<br />
Venue: CID, Nepal Police Headquarter, Kathmandu</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-07-02','deleted_at' => NULL,'created_at' => '2017-07-04 22:04:44','outgoing_issue_date' => '2017-07-03','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-PPT-40','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-07-04 22:11:52','outgoing_serial_number' => '40'),
            array('id' => '46','institution_id' => '3','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Payment Request','template_id' => '3','signature_user_id' => '1','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p style="text-align:justify">With reference to contract signed with Young Minds Creations Pvt. Ltd on 7-Aug-2016 for providing the consulting service for &ldquo;<strong>ePOU Exam Management Software</strong>&rdquo;, we finished third phase of the contract and therefore, had submited our 3rd Tax Invoice issued on 2016-OCT-27 with Invoice No: 007 for 30% of the contract amount i.e. Rs. 4,56,000+VAT.</p>

<p style="text-align:justify">We also request to make the payment to our bank account if possible.</p>

<p style="text-align:justify"><strong>Bank Details</strong><br />
A/C Name: Young Minds Creation (P) Ltd<br />
Bank A/C No: 02801030250337, Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</p>

<p style="text-align:justify"><strong>Attachment:</strong><br />
Attested Copy of the Invoice 007</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-07-05','deleted_at' => NULL,'created_at' => '2017-07-05 16:12:23','outgoing_issue_date' => '2017-07-05','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-PRQ-41','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-07-05 16:13:08','outgoing_serial_number' => '41'),
            array('id' => '43','institution_id' => '6','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Project Completion','template_id' => '8','signature_user_id' => '2','outgoing_document_content' => '<p>With respect to contract signed on 17-Jestha-2074 in between Young Minds Creation Pvt. Ltd and CID, Nepal Police Headquarter for the development of &quot;Unidentified Dead Body Management Data Base and Missing person Data Base Software&quot;, we, hereby, acknowledge that we have finished the software and made necessary updates to system as requested during the interim presentation. We are submiting all deliverables along with this letter as required in the ToR.</p>

<p><strong>Attachments (with this letter)</strong>:</p>

<ol>
	<li>Completion Reports</li>
	<li>Deliverables</li>
	<li>For Knowledge Transfer and Training Committment</li>
	<li>Payment Request Letter</li>
	<li>Tax Invoice</li>
</ol>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-07-06','deleted_at' => NULL,'created_at' => '2017-07-05 14:12:12','outgoing_issue_date' => '2017-07-06','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-PRJ-42','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-07-05 21:23:51','outgoing_serial_number' => '42'),
            array('id' => '44','institution_id' => '6','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'For Knowledge Transfer and Training Committment ','template_id' => '20','signature_user_id' => '2','outgoing_document_content' => '<p>With reference to contract signed on 17-Jestha-2074 in between Young Minds Creation Pvt. Ltd and CID, Nepal Police Headquarter for the development of "Unidentified Dead Body Management Data Base and Missing/Found person Data Base Software", we, hereby, request you to kindly provide us participants for the knowlede transfer and training for the development software. We would also bring to your attention that we have a contract with CID for next 1 year support.</p>

<p>We commit to provide neccessary training within the period of 1 year whenever the trainee availability is made. Please be kind to provide us with necessary information to conduct the training within this period.</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-07-06','deleted_at' => NULL,'created_at' => '2017-07-05 14:31:10','outgoing_issue_date' => '2017-07-06','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-TRN-43','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-07-05 21:24:04','outgoing_serial_number' => '43'),
            array('id' => '45','institution_id' => '6','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Payment Request','template_id' => '3','signature_user_id' => '2','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p style="text-align:justify">With reference to contract signed with Young Minds Creations Pvt. Ltd on 17-Jestha-2074 for providing the consulting service for the development of &ldquo;Unidentified Dead Body Management Data Base and Missing/Found person Data Base Software&rdquo;, we have made all deliverables as per the contract. We, hereby, submit our Tax Invoice and request you to kindly release the payment at earliest.</p>

<p style="text-align:justify">We also request to make the payment to our bank account if possible.</p>

<p style="text-align:justify"><strong>Bank Details</strong><br />
A/C Name: Young Minds Creation (P) Ltd<br />
Bank A/C No: 02801030250337, Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-07-06','deleted_at' => NULL,'created_at' => '2017-07-05 14:57:30','outgoing_issue_date' => '2017-07-06','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-PRQ-44','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-07-05 21:24:14','outgoing_serial_number' => '44'),
            array('id' => '47','institution_id' => '6','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Capacity buiding of in-house Officers','template_id' => '20','signature_user_id' => '2','outgoing_document_content' => '<p>With reference to contract signed on 17-Jestha-2074 in between Young Minds Creation Pvt. Ltd and CID, Nepal Police Headquarter for the development of &quot;Unidentified Dead Body Management Data Base and Missing/Found person Data Base Software&quot;, we, hereby, request you to kindly provide us participants for the capacity building of in-house technical officers for smooth operation of the developed software.</p>

<p>&nbsp;</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-07-02','deleted_at' => NULL,'created_at' => '2017-07-07 15:33:03','outgoing_issue_date' => '2017-07-02','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-TRN-39','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-07-07 15:33:16','outgoing_serial_number' => '45'),
            array('id' => '48','institution_id' => '27','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Reasons for Deadline Extension','template_id' => '12','signature_user_id' => '2','outgoing_document_content' => '<p>With reference to letter recieved on 6-July-2017 with reference number 1021 issued by Exam Control Division of Institute of Engineering, we hereby, provide following reasons for not being able to finish the project in the time.</p>

<ol>
	<li>Our Managing Director Shreedhar Marasini had a terrible bus accident as a result of which he had to stay in Hospital with his wife for more than 6 months. Due to this, most of the projects that he was following were dumped on existing resources as a result of which different projects were consecutively delayed.</li>
	<li>There were some unexpected short-notice resignations which caused imbalance in the production as a result of which follow up and close coordination with your team was severely disturbed which resulted in bad progress.</li>
	<li>The development was being done with an aim to allow any newer modules to be integrated in the system very easily, when needed in the future. But this made the development process slower and the changes implementation started taking longer time.</li>
</ol>

<p>Due to closing financial year, we would like to request for presentation on 17-July-2017 despite of your request to be made within this week due to several pre-engagement.</p>

<p>We assure that we will deliver the project within the extended deadline. Shreedhar Marasini will be the project manager(coordinator) to complete with in the extended deadline. We will colosely work with IoE project coordinator verifying every module one by one. We have given the higher priority for this project. We assure that we will complete this project in extended deadline.</p>

<p>&nbsp;</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-07-09','deleted_at' => NULL,'created_at' => '2017-07-12 20:49:09','outgoing_issue_date' => '2017-07-09','created_by_user_id' => '2','issued_by' => '2','outgoing_issue_number' => '1617-EXT-46','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-07-12 23:16:30','outgoing_serial_number' => '46'),
            array('id' => '50','institution_id' => '3','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Regarding the Support Staff','template_id' => '20','signature_user_id' => '2','outgoing_document_content' => '<p>Dear Sir</p>

<p>&nbsp;We have completed the Software development, User level Training, Managerial Training and Techchincal Training successfully. As per the ToR now we are going to provide one technical person for 3 months to help and support your testing and implmentation staffs. Ms Rachana Kc will be available for 3 months in your office from Aug 4, 2017.</p>

<p>We hope university will cooperate with her so that she can help the testing staff regarding the flow of the system. She will also guide University software testing staff so that they can test the systme properly. In case of any errors or bugs she will report Kathmandu Office and our team will fix the issues.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-02','deleted_at' => NULL,'created_at' => '2017-08-02 21:25:48','outgoing_issue_date' => '2017-08-02','created_by_user_id' => '2','issued_by' => '2','outgoing_issue_number' => '1617-TRN-47','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-02 21:29:08','outgoing_serial_number' => '47'),
            array('id' => '49','institution_id' => '7','department_name' => '2','folder_id'=>'0','outgoing_document_subject' => 'Regarding the Bank statement, and Balance Confirmation','template_id' => '21','signature_user_id' => '1','outgoing_document_content' => '<p>Dear Sir/Madam,<br />
Please provide us the Bank Statements starting from 16th July 2016 to 16th July 2017, and also provide us&nbsp;the&nbsp;balance confirmation of the account currently being operated in our bank on&nbsp; the date 16 th July 2017.<br />
&nbsp;</p>

<p>We have given power of attorney to Puja kumari sah&nbsp;to do this work.<br />
<br />
The details of our bank account are given below:<br />
Account Name:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Account NO:<br />
1. Young Minds creation Pvt. LTD.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;02801030250337<br />
&nbsp; &nbsp; Current Account NPR<br />
2. Young MInds Creation PVt Ltd-1&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;02801030255660<br />
&nbsp; &nbsp; &nbsp;Current Account NPR<br />
3&nbsp; Young MInds Creation Pvt Ltd CALL&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;02802030250375<br />
&nbsp; &nbsp;Saving Account NPR<br />
4. Young Minds Creation Pvt Ltd Quarterly Overdraft&nbsp; &nbsp;02859020250085<br />
&nbsp; &nbsp; Overdraft Account NPR<br />
5. Young Minds Creation Pvt Ltd USD&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;02801010250030<br />
&nbsp; &nbsp; Current Account USD</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-07-17','deleted_at' => NULL,'created_at' => '2017-07-17 16:05:19','outgoing_issue_date' => '2017-07-17','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-BS-47','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-10 17:38:18','outgoing_serial_number' => '47'),
            array('id' => '51','institution_id' => '27','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Quotation for Website Development','template_id' => '1','signature_user_id' => '2','outgoing_document_content' => '<p>Dear Sir/Madam,<br />
We, the undersigned, offer to provide the consulting services for <strong>&ldquo;Website Development&rdquo; </strong>in accordance with your Request for Quotation and our Quotation as per TOR.</p>

<table align="left" border="1" cellpadding="0" cellspacing="0" class="Table" style="border:1px solid #333333; width:100%">
	<tbody>
		<tr>
			<td style="background-color:#dddddd; width:70%"><strong>PARTICULARS</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>AMOUNT IN NPR</strong></td>
		</tr>
		<tr>
			<td>Website Development</td>
			<td style="text-align:right">1,50,000.00</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:right">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:right">&nbsp;</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>Sub Total</strong></td>
			<td style="background-color:#dddddd; text-align:right">1,50,000.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>VAT13%</strong></td>
			<td style="background-color:#dddddd; text-align:right">19,500.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>Total</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>1,69,500.00</strong></td>
		</tr>
		<tr>
			<td colspan="2">In Words: One Lakh Sixtynine Thousands Five Hundreds Rupees Only</td>
		</tr>
		<tr>
			<td colspan="2">Note: Quotation is only valid for 2 weeks.</td>
		</tr>
	</tbody>
</table>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-14','deleted_at' => NULL,'created_at' => '2017-08-10 17:51:32','outgoing_issue_date' => '2017-08-02','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-QTE-47','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-10 17:51:54','outgoing_serial_number' => '47'),
            array('id' => '52','institution_id' => '4','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Refund Security, Deposit and Retention Money','template_id' => '4','signature_user_id' => '2','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p>We, the undersigned, would like to request to release our Bank Guarantee/ Deposit for Ethical Review System.</p>

<p style="text-align:justify">We also request to refund any deposits or retentions money to our bank account as mentioned below if possible.</p>

<p style="text-align:justify"><strong>Bank Details</strong><br />
A/C Name: Young Minds Creation (P) Ltd<br />
Bank A/C No: 02801030250337, Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-10','deleted_at' => NULL,'created_at' => '2017-08-10 18:07:20','outgoing_issue_date' => '2017-08-10','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1718-BG-48','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-10 18:08:07','outgoing_serial_number' => '48'),
            array('id' => '54','institution_id' => '1','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Refund Performance/ Bid Bond Deposit','template_id' => '4','signature_user_id' => '2','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p>We, the undersigned, would like to request to release our Bid/ Performance Bond Cash Deposit for the contract signed on 2073-04-02&nbsp;for the upgradation of <strong>Citizenship Information Management System</strong>.</p>

<p style="text-align:justify">We also request to <strong>refund any deposits </strong>(to our bank account as mentioned below if possible).</p>

<p style="text-align:justify"><strong>Bank Details</strong><br />
A/C Name: Young Minds Creation (P) Ltd<br />
Bank A/C No: 02801030250337, Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-10','deleted_at' => NULL,'created_at' => '2017-08-10 18:18:55','outgoing_issue_date' => '2017-08-10','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1718-BG-49','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-10 19:27:15','outgoing_serial_number' => '49'),
            array('id' => '55','institution_id' => '1','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Refund Retention Money','template_id' => '4','signature_user_id' => '2','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p>We, the undersigned, would like to request to release our Retention Money for the contract signed on 2073-04-02&nbsp;for the upgradation of <strong>Citizenship Information Management System</strong></p>

<p style="text-align:justify">We also request to refund all deposits or retentions money to our bank account as mentioned below if possible.</p>

<p style="text-align:justify"><strong>Bank Details</strong><br />
A/C Name: Young Minds Creation (P) Ltd<br />
Bank A/C No: 02801030250337, Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-10','deleted_at' => NULL,'created_at' => '2017-08-10 18:45:08','outgoing_issue_date' => '2017-08-10','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1718-BG-50','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-10 19:30:12','outgoing_serial_number' => '50'),
            array('id' => '59','institution_id' => '8','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Bank Guarantee Release','template_id' => '4','signature_user_id' => '2','outgoing_document_content' => '<p>With reference&nbsp; to tender submited to Civil Aviation Authority Nepal, a bid bond with below details was submited.</p>

<p><strong>Issued by Bank: </strong>Nepal Investment Bank<br />
<strong>Bank Guarantee No: </strong>028GUABB17-0001<br />
<strong>Amount:</strong> Rs. 50,000.00<br />
<strong>Issue Date:</strong> 31-03-2017</p>

<p>We,&nbsp; the&nbsp; undersigned,&nbsp; would&nbsp; like&nbsp; to&nbsp; request&nbsp; to&nbsp; release&nbsp; our&nbsp; Bank&nbsp; Guarantee since the tender was not awarded to us.</p>

<p><strong>CC: </strong></p>

<ol>
	<li>Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</li>
</ol>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-10','deleted_at' => NULL,'created_at' => '2017-08-10 19:19:12','outgoing_issue_date' => '2017-08-10','created_by_user_id' => '1','issued_by' => '1','outgoing_issue_number' => '1718-BG-51','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-10 19:35:24','outgoing_serial_number' => '51'),
            array('id' => '58','institution_id' => '44','department_name' => '2','folder_id'=>'0','outgoing_document_subject' => 'Refund Security, Deposit and Retention Money','template_id' => '4','signature_user_id' => '2','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p>We, the undersigned, would like to request to release our Bank Guarantee/ Deposit with number 49702385&nbsp;submited on 2073-11-19&nbsp;for<strong> Tender Purchased</strong>.</p>

<p style="text-align:justify">We also request to refund any deposits or retentions money to our bank account as mentioned below if possible.</p>

<p style="text-align:justify"><strong>Bank Details</strong><br />
A/C Name: Young Minds Creation (P) Ltd<br />
Bank A/C No: 02801030250337, Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-10','deleted_at' => NULL,'created_at' => '2017-08-10 19:14:04','outgoing_issue_date' => '2017-08-10','created_by_user_id' => '1','issued_by' => '1','outgoing_issue_number' => '1718-BG-52','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-10 20:00:48','outgoing_serial_number' => '52'),
            array('id' => '57','institution_id' => '43','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Release Bank Guarantee and Refund Retention Money ','template_id' => '4','signature_user_id' => '2','outgoing_document_content' => '<p>We, the undersigned, would like to request to release our Bank Guarantee/ Deposit with number <strong>001GUABB16-0819</strong>&nbsp;submited on November 21, 2016&nbsp;for the execution of <strong>Development and Implementation of Road Accident Information Management System</strong>.</p>

<p style="text-align:justify">We also request to refund any deposits or retentions money to our bank account as mentioned below if possible.</p>

<p style="text-align:justify"><strong>Bank Details</strong><br />
A/C Name: Young Minds Creation (P) Ltd<br />
Bank A/C No: 02801030250337, Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-10','deleted_at' => NULL,'created_at' => '2017-08-10 19:01:10','outgoing_issue_date' => '2017-08-10','created_by_user_id' => '1','issued_by' => '1','outgoing_issue_number' => '1718-BG-53','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-10 20:00:57','outgoing_serial_number' => '53'),
            array('id' => '56','institution_id' => '35','department_name' => '2','folder_id'=>'0','outgoing_document_subject' => 'Refund Security, Deposit and Retention Money','template_id' => '4','signature_user_id' => '2','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p>We, the undersigned, would like to request to release our Bank Guarantee/ Deposit with number 001GUABB16-0727&nbsp;submited on October 26, 2016&nbsp;for the execution of<strong> Procurement of CREF Document Management and Digital Archiving</strong>.</p>

<p style="text-align:justify">We also request to refund any deposits or retentions money to our bank account as mentioned below if possible.</p>

<p style="text-align:justify"><strong>Bank Details</strong><br />
A/C Name: Young Minds Creation (P) Ltd<br />
Bank A/C No: 02801030250337, Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-10','deleted_at' => NULL,'created_at' => '2017-08-10 18:51:17','outgoing_issue_date' => '2017-08-10','created_by_user_id' => '1','issued_by' => '1','outgoing_issue_number' => '1718-BG-54','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-10 20:01:08','outgoing_serial_number' => '54'),
            array('id' => '60','institution_id' => '26','department_name' => '2','folder_id'=>'0','outgoing_document_subject' => 'Payment Request','template_id' => '3','signature_user_id' => '3','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p style="text-align:justify">With reference to contract signed with Young Minds Creations Pvt. Ltd on 21 April, 2017<strong>&nbsp;</strong>for providing the consulting service for &ldquo;<strong>Development of MIS of Construction materials for earthquake affected districts</strong>&rdquo;, we have finished all tasks as per the contract. We, hereby, submit our Tax Invoice and request you to kindly release the payment at earliest.</p>

<p style="text-align:justify">We also request to make the payment to our bank account if possible.</p>

<p style="text-align:justify"><strong>Bank Details</strong><br />
A/C Name: Young Minds Creation (P) Ltd<br />
Bank A/C No: 02801030250337, Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</p>
','outgoing_file_uploads' => '15024247382.jpeg','outgoing_document_date' => '2017-08-11','deleted_at' => NULL,'created_at' => '2017-08-11 13:57:19','outgoing_issue_date' => '2017-08-11','created_by_user_id' => '1','issued_by' => '1','outgoing_issue_number' => '1718-PRQ-55','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-11 14:03:20','outgoing_serial_number' => '55'),
            array('id' => '61','institution_id' => '38','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'AMC Payment Request','template_id' => '3','signature_user_id' => '3','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p style="text-align:justify">With reference to contract signed with Young Minds Creations Pvt. Ltd on <strong>Jan-01-2017 </strong>for providing the Annual Maintenance&nbsp; Service for &ldquo;<strong>GESIDB</strong>&rdquo;, We&nbsp; will provide support, training and other services as per the contract till contract period. We, hereby, submit our Tax Invoice and request you to kindly release the payment at earliest.</p>

<p style="text-align:justify">We also request to make the payment to our bank account if possible.</p>

<p style="text-align:justify"><strong>Bank Details</strong><br />
A/C Name: Young Minds Creation (P) Ltd<br />
Bank A/C No: 02801030250337, Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-13','deleted_at' => NULL,'created_at' => '2017-08-13 13:14:33','outgoing_issue_date' => '2017-07-17','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1718-PRQ-56','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-13 14:51:34','outgoing_serial_number' => '56'),
            array('id' => '53','institution_id' => '6','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Bank Guarantee Release','template_id' => '4','signature_user_id' => '2','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p>With reference to contract signed on 2072-02-24 for the consultancy service of the development of <strong>Secured Web Based Case File Digitization System</strong>, we acknowledge that contract tenure has expired.</p>

<p>We, the undersigned, would like to request to release our Performance Bank Guarantee with following details</p>

<p><strong>Issued by Bank</strong>: Nepal Investment Bank<br />
<strong>Bank Guarantee No</strong>: 028GUAPB15-0004<br />
<strong>Amount</strong>: Rs. 2,07,637.50<br />
<strong>Issue Date</strong>: 23-06-2015</p>

<p><strong>CC: Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu</strong></p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-10','deleted_at' => NULL,'created_at' => '2017-08-10 18:16:18','outgoing_issue_date' => '2017-08-10','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1718-BG-57','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-13 15:09:04','outgoing_serial_number' => '57'),
            array('id' => '62','institution_id' => '9','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Bank Guarantee Release','template_id' => '4','signature_user_id' => '2','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p>With reference to contract signed for the<strong> Need Assessment for Hospital Information Management System</strong>, we acknowledge that contract tenure has expired and the contract terms has been met.</p>

<p>We, the undersigned, would like to request to release our Performance Bank Guarantee with following details</p>

<p><strong>Issued by Bank</strong>: Nepal Investment Bank<br />
<strong>Bank Guarantee No</strong>: 028GUAPB16-0001<br />
<strong>Amount</strong>: Rs. 10,000.00<br />
<strong>Issue Date</strong>: 01-04-2016</p>

<p><strong>CC: Nepal Investment Bank Ltd.</strong></p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-13','deleted_at' => NULL,'created_at' => '2017-08-13 15:22:00','outgoing_issue_date' => '2017-08-13','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1718-BG-58','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-13 15:22:19','outgoing_serial_number' => '58'),
            array('id' => '63','institution_id' => '6','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'For Annual Maintenance Contract','template_id' => '25','signature_user_id' => '2','outgoing_document_content' => '<p>With reference to contract signed on 2072-02-24 for the consultancy service of the development of <strong>Secured Web Based Case File Digitization System</strong>, we hereby, would like to inform you that the two years support term which was part of the contract will expire within this fiscal year 2073-2074. During this support period, we have helped in following ways</p>

<ol>
	<li>Assuring in the uptime of the system at the software level</li>
	<li>Assisting in data backup and coordinating with CID officials for that</li>
	<li>Fixing any errors or bugs that incurred in the system</li>
	<li>Optimizing the system for better experience and use</li>
	<li>Making minor changes in the system to adapt user&#39;s needs from different police units to help them work with the sytem in more easier way</li>
</ol>

<p>We, thus, request you to sign Anual Maintenance Contract (AMC) for ongoing support and maintenance for the system for next fiscal year.</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-07-01','deleted_at' => NULL,'created_at' => '2017-08-13 15:56:38','outgoing_issue_date' => '2017-07-01','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1718-AMC-59','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-13 15:56:50','outgoing_serial_number' => '59'),
            array('id' => '64','institution_id' => '4','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Email Hosting and Support','template_id' => '1','signature_user_id' => '2','outgoing_document_content' => '<p>Dear Sir/Madam,<br />
We, the undersigned, offer to provide the consulting services for <strong>&ldquo;Email Hosting &amp; Support&rdquo; </strong>in accordance with your Request for Quotation and our Quotation as per TOR.</p>

<table align="left" border="1" cellpadding="0" cellspacing="0" class="Table" style="border:1px solid #333333; width:100%">
	<tbody>
		<tr>
			<td style="background-color:#dddddd; width:70%"><strong>PARTICULARS</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>AMOUNT IN NPR</strong></td>
		</tr>
		<tr>
			<td>NHRC.gov.np Email Hosting for 12 months</td>
			<td style="text-align:right">2,65,000.00</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:right">2,65,000.00</td>
		</tr>
		<tr>
			<td>xxxxxxxxxxxxxxxxxx</td>
			<td style="text-align:right">2,65,000.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>Sub Total</strong></td>
			<td style="background-color:#dddddd; text-align:right">34,450.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>VAT13%</strong></td>
			<td style="background-color:#dddddd; text-align:right">34,450.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>Total</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>2,99,450.00</strong></td>
		</tr>
		<tr>
			<td colspan="2">In Words: xxxxxxxxxxxxx Rupees Only</td>
		</tr>
		<tr>
			<td colspan="2">Note: Quotation is only valid for 2 weeks.</td>
		</tr>
	</tbody>
</table>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-07-16','deleted_at' => NULL,'created_at' => '2017-08-13 17:53:07','outgoing_issue_date' => '2017-07-16','created_by_user_id' => '1','issued_by' => '1','outgoing_issue_number' => '1718-QTE-59','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-13 18:28:24','outgoing_serial_number' => '59'),
            array('id' => '65','institution_id' => '45','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Website Design and Development ','template_id' => '1','signature_user_id' => '2','outgoing_document_content' => '<p>Dear Sir/Madam,<br />
We, the undersigned, offer to provide the consulting services for <strong>&ldquo;Website Design and Development&rdquo; </strong>in accordance with your Request for Quotation.Please find the attached PDF file for more features, functionalites and other details.</p>

<table align="left" border="1" cellpadding="0" cellspacing="0" class="Table" style="border:1px solid #333333; width:100%">
	<tbody>
		<tr>
			<td style="background-color:#dddddd; width:70%"><strong>PARTICULARS</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>AMOUNT IN NPR</strong></td>
		</tr>
		<tr>
			<td>Website Design and Development</td>
			<td style="text-align:right">80,000.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>Sub Total</strong></td>
			<td style="background-color:#dddddd; text-align:right">80,000.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>VAT13%</strong></td>
			<td style="background-color:#dddddd; text-align:right">10,400.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>Total</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>90,400.00</strong></td>
		</tr>
		<tr>
			<td colspan="2">In Words: Ninty Thousands and Four Hundres Rupees Only</td>
		</tr>
		<tr>
			<td colspan="2">Note: Quotation is only valid for 2 weeks.</td>
		</tr>
	</tbody>
</table>
','outgoing_file_uploads' => '15028554715.pdf','outgoing_document_date' => '2017-08-15','deleted_at' => NULL,'created_at' => '2017-08-15 16:52:24','outgoing_issue_date' => '2017-08-15','created_by_user_id' => '2','issued_by' => '2','outgoing_issue_number' => '1718-QTE-60','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-16 13:38:44','outgoing_serial_number' => '60'),
            array('id' => '66','institution_id' => '6','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Trainees for the Training','template_id' => '20','signature_user_id' => '2','outgoing_document_content' => '<p>With reference to contract signed on 17-Jestha-2074 in between Young Minds Creation Pvt. Ltd and CID, Nepal Police Headquarter for the development of &quot;Unidentified Dead Body Management Data Base and Missing/Found person Data Base Software&quot;, we, hereby, request you to kindly provide us participants on 2074-04-27 for the knowlede transfer and training for the developed software.</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-07','deleted_at' => NULL,'created_at' => '2017-08-16 22:10:18','outgoing_issue_date' => '2017-08-07','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1718-TRN-61','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-16 22:41:20','outgoing_serial_number' => '61'),
            array('id' => '67','institution_id' => '6','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Retention Money Release Request','template_id' => '27','signature_user_id' => '2','outgoing_document_content' => '<p>Dear Sir/ Madam,<br />
We, the undersigned, would like to request the retention money held in your organization since the tenure and contract terms have already been met. The summary details on the retention money is as mentioned below.</p>

<p><strong>Contract:</strong> Secured Web Based Case File Digitization System<br />
<strong>Contract signed on: </strong> 2072-02-24</p>

<p>Please note that all the taxes for the issued invoice has already been cleared off.</p>

<p><strong>Attachment:</strong> Tax Clearance Certificate 2071/2072</p>
','outgoing_file_uploads' => '15028875720.jpeg','outgoing_document_date' => '2017-08-15','deleted_at' => NULL,'created_at' => '2017-08-16 22:17:05','outgoing_issue_date' => '2017-08-15','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1718-RET-62','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-16 22:41:42','outgoing_serial_number' => '62'),
            array('id' => '68','institution_id' => '6','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Training Conducted Successfully','template_id' => '20','signature_user_id' => '2','outgoing_document_content' => '<p>With reference to contract signed on 17-Jestha-2074 in between Young Minds Creation Pvt. Ltd and CID, Nepal Police Headquarter for the development of &quot;<strong>Unidentified Dead Body Management Data Base and Missing/Found person Data Base Software</strong>&quot;, we have successfully conducted training as required by the ToR on <strong>2074-04-27</strong>.</p>

<p><strong>Attachments</strong>: Trainee&#39;s Attendance</p>
','outgoing_file_uploads' => '15028881428.pdf','outgoing_document_date' => '2017-08-16','deleted_at' => NULL,'created_at' => '2017-08-16 22:40:42','outgoing_issue_date' => '2017-08-15','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1718-TRN-63','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-16 22:41:57','outgoing_serial_number' => '63'),
            array('id' => '69','institution_id' => '26','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Deadline Extension','template_id' => '12','signature_user_id' => '2','outgoing_document_content' => '<p>With reference to contract signed in between Young Minds Creation Pvt. Ltd and Practical Action for &quot;Development of Market Information System and Mobile APP&quot;, we hereby, acknowledge you that, some more time is required by Practical Action Team to figure out the finalization of this project. Thus, we request to extend the deadline till 11-08-2017.</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-06-15','deleted_at' => NULL,'created_at' => '2017-08-16 22:54:51','outgoing_issue_date' => '2017-06-15','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-EXT-64','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-16 22:56:00','outgoing_serial_number' => '64'),
            array('id' => '70','institution_id' => '46','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'About Abhijit Gupta visit to Hong Kong','template_id' => '28','signature_user_id' => '2','outgoing_document_content' => '<p>&nbsp;</p>

<p>&nbsp;</p>

<p>Mr. Abhijit Gupta is a &nbsp;founder and director of Young Minds Creation PVT ltd. He is visiting Hong Kong frequently for meeting and&nbsp; business development with our Hong Kong Partner. &nbsp;OP Hub Solutions Limited has invited Mr. Gupta for business meeting. So we would like to recommend him for Hong Kong Visa process. Neccesary company documents are herewith.</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-17','deleted_at' => NULL,'created_at' => '2017-08-17 14:20:17','outgoing_issue_date' => '2017-08-17','created_by_user_id' => '2','issued_by' => '2','outgoing_issue_number' => '1718-VISAREC-65','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-17 14:24:34','outgoing_serial_number' => '65'),
            array('id' => '71','institution_id' => '45','department_name' => '4','folder_id'=>'0','outgoing_document_subject' => 'Regarding Quotation for Networking and Maintenance ','template_id' => '1','signature_user_id' => '2','outgoing_document_content' => '<p>Dear Sir/Madam,<br />
We, the undersigned, offer to provide the consulting services for <strong>&ldquo;Networking and Maintenance</strong>&nbsp;<strong>&rdquo; </strong>in accordance with your Request for Quotation and our Quotation as per discussion.</p>

<table align="left" border="1" cellpadding="0" cellspacing="0" class="Table" style="border:1px solid #333333; width:100%">
	<tbody>
		<tr>
			<td style="background-color:#dddddd; width:70%"><strong>PARTICULARS</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>AMOUNT IN NPR</strong></td>
		</tr>
		<tr>
			<td>Networking and Maintenance&nbsp;</td>
			<td style="text-align:right">61,000.00</td>
		</tr>
		<tr>
			<td>
			<p><strong>Accessories-</strong><br />
			Switch- Tp-link (24 potr 10/100 Mbps)- 1 Unit<br />
			Network Cable-Jdkee- 2 Unit<br />
			Network socket- 15 Unit<br />
			Rj 45- &nbsp;50 Unit<br />
			Miscellanieous (Pin, Listy and Tape) - As per Need<br />
			Planning and Implementation&nbsp;<br />
			Wiring Charge</p>
			</td>
			<td style="text-align:right">&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align:right"><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Service Charge</strong></td>
			<td style="text-align:right">20,000.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>Sub Total</strong></td>
			<td style="background-color:#dddddd; text-align:right">81,000.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>VAT13%</strong></td>
			<td style="background-color:#dddddd; text-align:right">10,530.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>Total</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>91,530.00</strong></td>
		</tr>
		<tr>
			<td colspan="2">In Words:Ninety One Thousand Five Hundred Thirty Rupees Only.</td>
		</tr>
		<tr>
			<td colspan="2">Note: Quotation is only valid for 2 weeks.</td>
		</tr>
	</tbody>
</table>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-17','deleted_at' => NULL,'created_at' => '2017-08-17 17:31:27','outgoing_issue_date' => '2017-08-17','created_by_user_id' => '4','issued_by' => '4','outgoing_issue_number' => '1718-QTE-66','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-17 18:10:48','outgoing_serial_number' => '66'),
            array('id' => '72','institution_id' => '16','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Regarding Approval of online Eservice Coroporate Login.','template_id' => '29','signature_user_id' => '3','outgoing_document_content' => '<p>Dear Sir,</p>

<p>We, the undersigned, would like to request you to kindly approve Corpoate login account in eservice.nlk.org.np. We have filled up the form with our office information. The online service will be easy to view the office staff account information. So we would like to request to approve the account.</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-18','deleted_at' => NULL,'created_at' => '2017-08-18 13:52:00','outgoing_issue_date' => '2017-08-18','created_by_user_id' => '2','issued_by' => '2','outgoing_issue_number' => '1718-REQST-67','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-18 13:53:25','outgoing_serial_number' => '67'),
            array('id' => '73','institution_id' => '14','department_name' => '4','folder_id'=>'0','outgoing_document_subject' => 'Request for the TDS voucher','template_id' => '26','signature_user_id' => '2','outgoing_document_content' => '<p><span style="font-size:12.0pt">We the undersigned would like to request for the TDS Voucher of this company for the audit purpose for fiscal year 2073/74.<br />
Invoice No.: 002&nbsp;amounting 1,80,000+ VAT</span></p>

<p><span style="font-size:12.0pt">We remain,<br />
Yours Sincerely,</span></p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-18','deleted_at' => NULL,'created_at' => '2017-08-18 14:39:26','outgoing_issue_date' => '2017-08-18','created_by_user_id' => '4','issued_by' => '4','outgoing_issue_number' => '1718-TDS-68','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-18 15:00:40','outgoing_serial_number' => '68'),
            array('id' => '74','institution_id' => '3','department_name' => '4','folder_id'=>'0','outgoing_document_subject' => 'Request for the TDS voucher','template_id' => '26','signature_user_id' => '4','outgoing_document_content' => '<p><span style="font-size:12.0pt">We the undersigned would like to request for the TDS Voucher of this company for the audit purpose for fiscal year 2073/74.<br />
Invoice No.: 004 amounting 3,80,000+ VAT</span></p>

<p><span style="font-size:12.0pt">We remain,<br />
Yours Sincerely,</span></p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-18','deleted_at' => NULL,'created_at' => '2017-08-18 15:03:50','outgoing_issue_date' => '2017-08-18','created_by_user_id' => '4','issued_by' => '4','outgoing_issue_number' => '1718-TDS-69','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-18 15:05:31','outgoing_serial_number' => '69'),
            array('id' => '75','institution_id' => '3','department_name' => '4','folder_id'=>'0','outgoing_document_subject' => 'Request for the TDS voucher','template_id' => '26','signature_user_id' => '4','outgoing_document_content' => '<p><span style="font-size:12.0pt">We the undersigned would like to request for the TDS Voucher of this company for the audit purpose for fiscal year 2073/74.<br />
Invoice No.: 007&nbsp;amounting 4,56,000+ VAT</span></p>

<p><span style="font-size:12.0pt">We remain,<br />
Yours Sincerely,</span></p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-18','deleted_at' => NULL,'created_at' => '2017-08-18 15:07:19','outgoing_issue_date' => '2017-08-18','created_by_user_id' => '4','issued_by' => '4','outgoing_issue_number' => '1718-TDS-70','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-18 15:08:22','outgoing_serial_number' => '70'),
            array('id' => '76','institution_id' => '5','department_name' => '4','folder_id'=>'0','outgoing_document_subject' => 'Request for the TDS voucher','template_id' => '26','signature_user_id' => '4','outgoing_document_content' => '<p><span style="font-size:12.0pt">We the undersigned would like to request for the TDS Voucher of this company for the audit purpose for fiscal year 2073/74.<br />
Invoice No.: 013&nbsp;&nbsp;amounting 6,33,500+ VAT</span></p>

<p><span style="font-size:12.0pt">We remain,<br />
Yours Sincerely,</span></p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-18','deleted_at' => NULL,'created_at' => '2017-08-18 15:11:03','outgoing_issue_date' => '2017-08-18','created_by_user_id' => '4','issued_by' => '4','outgoing_issue_number' => '1718-TDS-71','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-18 15:12:05','outgoing_serial_number' => '71'),
            array('id' => '77','institution_id' => '24','department_name' => '4','folder_id'=>'0','outgoing_document_subject' => 'Request for the TDS voucher','template_id' => '26','signature_user_id' => '4','outgoing_document_content' => '<p><span style="font-size:12.0pt">We the undersigned would like to request for the TDS Voucher of this company for the audit purpose for fiscal year 2073/74.<br />
Invoice No.: 016 - amounting - 2,62,000+ VAT</span></p>

<p><span style="font-size:12.0pt">We remain,<br />
Yours Sincerely,</span></p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-18','deleted_at' => NULL,'created_at' => '2017-08-18 15:22:59','outgoing_issue_date' => '2017-08-18','created_by_user_id' => '4','issued_by' => '4','outgoing_issue_number' => '1718-TDS-72','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-18 15:25:37','outgoing_serial_number' => '72'),
            array('id' => '80','institution_id' => '47','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => ' No Objection Letter for Mrs Pooja Dhakal Paudel','template_id' => '30','signature_user_id' => '2','outgoing_document_content' => '<p>This is to certify that Mrs. Pooja Dhakal Paudel is an employee at Young Mind Creations Pvt. Ltd. and is working as a Senior Software Developer since March 2014. In this position her major duties and responsibilities are coding, testing, database design, team coordination, client communications and other software development activities.</p>

<p>Mrs. Pooja has applied leave for Forty Days to visit Germany to meet her Husband, who is in Germany.Our organization has no objection regarding her visit to Germany. Her leave for the Germany visit has been sanctioned for forty days from&nbsp; 01, Sept&nbsp; 2017 to 10 ,Oct 2017. On Expiry of leave she would report for duty on Oct 11, 2017.</p>

<p>If you have any questions regarding Mrs. Pooja Dhakal Paudel, please contact our office at +97714115132</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-21','deleted_at' => NULL,'created_at' => '2017-08-21 14:17:01','outgoing_issue_date' => '2017-08-21','created_by_user_id' => '2','issued_by' => '2','outgoing_issue_number' => '1718-LEAVEAP-73','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-22 01:41:08','outgoing_serial_number' => '73'),
            array('id' => '81','institution_id' => '47','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Regarding Annual Salary','template_id' => '31','signature_user_id' => '2','outgoing_document_content' => '<p>Mrs. Pooja Dhakal Paudel is a full time&nbsp; employee of&nbsp; Young Minds Creation Pvt Ltd since March 2014. She is working&nbsp; as a&nbsp; Sr. Software Developer. &nbsp;Her gross &nbsp;salary is NRs.&nbsp; 6,60,000.00 per annum. which is equivalent to&nbsp; &euro; 5509.65(Five Thousands Five Hundred Nine and 65 cent) &nbsp;as per 21 Aug, 2017 exchange rate.</p>

<p>&nbsp;</p>

<p style="text-align:justify"><span style="font-size:12.0pt">If you have any questions regarding Ms. Pooja Dhakal Paudel, please contact our office.</span></p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-21','deleted_at' => NULL,'created_at' => '2017-08-21 15:09:11','outgoing_issue_date' => '2017-08-21','created_by_user_id' => '2','issued_by' => '2','outgoing_issue_number' => '1718-EMPV-74','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-22 01:42:00','outgoing_serial_number' => '74'),
            array('id' => '82','institution_id' => '27','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Project Completion Letter.','template_id' => '8','signature_user_id' => '2','outgoing_document_content' => '<p>With reference to contract signed between Young Minds Creation Pvt. Ltd and Institure of Engineering(IoE) for the Online Exam Registration System. The project has been completed and deployed IOE Server within extended deadline.</p>

<p>We would like to request you to kindly schedule the Final Presetaion to demonstrate the completed software.</p>

<p><strong>Attachments (with this letter)</strong>: Final software source code with manuals in a Disc</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-24','deleted_at' => NULL,'created_at' => '2017-08-24 19:27:35','outgoing_issue_date' => '2017-08-24','created_by_user_id' => '2','issued_by' => '2','outgoing_issue_number' => '1718-PRJ-75','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-27 14:34:58','outgoing_serial_number' => '75'),
            array('id' => '84','institution_id' => '49','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Quotation  : Verify the compliance of deliverable aganist the TOR/Contract','template_id' => '1','signature_user_id' => '2','outgoing_document_content' => '<p>Dear Sir/Madam,<br />
We, the undersigned, offer to provide the consulting services for <strong>&ldquo;Verify the compliance of deliverable aganist the TOR/Contract&rdquo; </strong>in accordance with your Request for Quotation and our Quotation as per TOR.</p>

<table align="left" border="1" cellpadding="0" cellspacing="0" class="Table" style="border:1px solid #333333; width:100%">
	<tbody>
		<tr>
			<td style="background-color:#dddddd; width:70%"><strong>PARTICULARS</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>AMOUNT IN NPR</strong></td>
		</tr>
		<tr>
			<td>Verfication the Deliveralbe aganist the ToR/Contract</td>
			<td style="text-align:right">2,10,000.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>VAT13%</strong></td>
			<td style="background-color:#dddddd; text-align:right">27,300.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>Total</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>2,37,300.00</strong></td>
		</tr>
		<tr>
			<td colspan="2">In Words: Two Lakh Thiry Seven Thousand and Three Hundred Rupees Only.</td>
		</tr>
		<tr>
			<td colspan="2">Note: Quotation is only valid for 2 weeks.</td>
		</tr>
	</tbody>
</table>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-29','deleted_at' => NULL,'created_at' => '2017-08-29 17:26:58','outgoing_issue_date' => '2017-08-29','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1718-QTE-76','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-30 15:54:23','outgoing_serial_number' => '76'),
            array('id' => '85','institution_id' => '17','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Response for SAPDC/KTM-12/PCD-70/2017-347','template_id' => '8','signature_user_id' => '1','outgoing_document_content' => '<p>With reference to letter received on 17-Aug-2017 with reference number SAPDC/KTM-12/PCD-70/2017-347 from SJVN Arun-3 Power Development Company (P) Ltd, we hereby acknowledge that the design of the website was finished long time back. The development of website followed standard System Analysis and Design menthod where we sent final design on 31-May-2017 and it was approved over the email on 30-Aug-2017 after 3 months time. Thus, we finished the website as per the approval and also provided necessary training to your officials to be able to use the website.</p>

<p>Later, when we presented the website to CEO, he requested us to follow a complete new layout, color and concept. We also considered those comments and updated your website which is currently visible in your current server at http://sapdc.org.np/SJVN/Index/.</p>

<p>Again, when we presented it, we were again asked to develop a complete new website. Since we already have finished the website, we would like to request you kindly provide comment on this. We will not be able to keep working on new designs over and over.</p>

<p>We acknowlege that we have always been patient and dedicated towards this project despite of the over work that we have been doing. We request you to provide us with final comments on the website and help us close this project and settle outstanding payments on it soon.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p><strong>Attachments (with this letter)</strong>: Old Emails for your reference</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-08-30','deleted_at' => NULL,'created_at' => '2017-08-30 15:54:04','outgoing_issue_date' => '2017-08-29','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1718-PRJ-77','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-08-30 15:54:41','outgoing_serial_number' => '77'),
            array('id' => '86','institution_id' => '7','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Salary August','template_id' => '10','signature_user_id' => '2','outgoing_document_content' => '<div style="margin-top:30px">
<p>Dear Sir,<br />
Please debit our account for Young Minds Creation(P) Ltd at your branch with account number <strong>02801030250337</strong> and creditrespective amount to respective account number as mentioned below for the salary settlement.</p>

<table class="Table" style="width:80%">
	<thead>
		<tr>
			<td><strong>SN.</strong></td>
			<td><strong>Name</strong></td>
			<td><strong>Account No.</strong></td>
			<td><strong>Amount (Rs.)</strong></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>1</td>
			<td>Puja Kumari Sah</td>
			<td>02805080379540</td>
			<td>4,348.00</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Rachana KC</td>
			<td>04205080258302</td>
			<td>11,892.00</td>
		</tr>
		<tr>
			<td>3</td>
			<td>Santosh Dhungana</td>
			<td>02805080381611</td>
			<td>5,365.00</td>
		</tr>
		<tr>
			<td>4</td>
			<td>Shristi Maharjan</td>
			<td>00405080346214</td>
			<td>11,125.00</td>
		</tr>
		<tr>
			<td>5</td>
			<td>Srijan Karki</td>
			<td>02805080369190</td>
			<td>23,153.00</td>
		</tr>
		<tr>
			<td>6</td>
			<td>Suraj Bhattarai</td>
			<td>02805080382229</td>
			<td>7,920.00</td>
		</tr>
		<tr>
			<td>7</td>
			<td>Sushil Timilsina</td>
			<td>02805080374002</td>
			<td>24,750.00</td>
		</tr>
		<tr>
			<td colspan="3"><strong>Total </strong></td>
			<td><strong>88553.00</strong></td>
		</tr>
	</tbody>
</table>
In Words : Eighty Eight Thousands Five hundred and Fifty Three Only.</div>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-09-08','deleted_at' => NULL,'created_at' => '2017-09-08 12:34:41','outgoing_issue_date' => '2017-09-08','created_by_user_id' => '2','issued_by' => '2','outgoing_issue_number' => '1718-SS-78','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-09-08 13:52:19','outgoing_serial_number' => '78'),
            array('id' => '87','institution_id' => '50','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Quotation Website Design and Development','template_id' => '1','signature_user_id' => '2','outgoing_document_content' => '<p>Dear Sir/Madam,<br />
We, the undersigned, offer to provide the consulting services for <strong>&ldquo;Website Design, Development and Hosting Solution&rdquo; </strong>in accordance with your Request for Quotation and our Quotation as per TOR.</p>

<table align="left" border="1" cellpadding="0" cellspacing="0" class="Table" style="border:1px solid #333333; width:100%">
	<tbody>
		<tr>
			<td style="background-color:#dddddd; width:70%"><strong>PARTICULARS</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>AMOUNT IN NPR</strong></td>
		</tr>
		<tr>
			<td>Website Design, Development and Hosting Solution</td>
			<td style="text-align:right">1,00,000.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>VAT13%</strong></td>
			<td style="background-color:#dddddd; text-align:right">13,000.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>Total</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>1,13,000.00</strong></td>
		</tr>
		<tr>
			<td colspan="2">In Words: One Lakh and Thirteen Thousands&nbsp; Rupees Only</td>
		</tr>
		<tr>
			<td colspan="2">Note: Quotation is only valid for 2 weeks.</td>
		</tr>
	</tbody>
</table>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-09-08','deleted_at' => NULL,'created_at' => '2017-09-08 18:23:21','outgoing_issue_date' => '2017-09-08','created_by_user_id' => '2','issued_by' => '2','outgoing_issue_number' => '1718-QTE-79','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-09-08 18:24:33','outgoing_serial_number' => '79'),
            array('id' => '88','institution_id' => '39','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Request for new SIM Card','template_id' => '29','signature_user_id' => '2','outgoing_document_content' => '<p>&nbsp;</p>

<p>Dear Sir,</p>

<p>&nbsp;</p>

<p>Subject : Request for New SIM Card.</p>

<p>My mobile phone is lost yesterday. So I would like to request to block the lost mobile&#39;s SIM card and provide the new SIM card.</p>

<p>Mobile Number : 985115705</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-09-11','deleted_at' => NULL,'created_at' => '2017-09-11 16:16:00','outgoing_issue_date' => '2017-09-11','created_by_user_id' => '2','issued_by' => '2','outgoing_issue_number' => '1718-REQST-80','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-09-11 16:18:42','outgoing_serial_number' => '80'),
            array('id' => '89','institution_id' => '50','department_name' => '2','folder_id'=>'0','outgoing_document_subject' => 'Payment Request','template_id' => '3','signature_user_id' => '3','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p style="text-align:justify">With reference to contract signed with Young Minds Creations Pvt. Ltd.<strong>&nbsp;</strong>for providing the consulting service for &ldquo;<strong>Website Design, Development and Hosting Solution</strong>&rdquo;, we have finished all tasks as per the contract. We, hereby, submit our Tax Invoice and request you to kindly release the payment at earliest.</p>

<p style="text-align:justify">We also request to make the payment to our bank account if possible.</p>

<p style="text-align:justify"><strong>Bank Details</strong><br />
A/C Name: Young Minds Creation (P) Ltd<br />
Bank A/C No: 02801030250337, Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-09-13','deleted_at' => NULL,'created_at' => '2017-09-13 16:05:03','outgoing_issue_date' => '2017-09-13','created_by_user_id' => '1','issued_by' => '1','outgoing_issue_number' => '1718-PRQ-81','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-09-13 16:08:37','outgoing_serial_number' => '81'),
            array('id' => '90','institution_id' => '16','department_name' => '2','folder_id'=>'0','outgoing_document_subject' => 'Payment Request','template_id' => '3','signature_user_id' => '3','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p style="text-align:justify">With reference to contract signed with Young Minds Creations Pvt. Ltd on 2074-02-01<strong>&nbsp;</strong>for providing the consulting service for &ldquo;<strong>Web Based e-Servics Software System Support</strong>&rdquo;, we have finished all tasks as per the contract. We, hereby, submit our Tax Invoice and request you to kindly release the payment at earliest.</p>

<p style="text-align:justify">We also request to make the payment to our bank account if possible.</p>

<p style="text-align:justify"><strong>Bank Details</strong><br />
A/C Name: Young Minds Creation (P) Ltd<br />
Bank A/C No: 02801030250337, Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-09-13','deleted_at' => NULL,'created_at' => '2017-09-13 16:14:18','outgoing_issue_date' => '2017-09-13','created_by_user_id' => '1','issued_by' => '1','outgoing_issue_number' => '1718-PRQ-82','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-09-13 16:14:30','outgoing_serial_number' => '82'),
            array('id' => '91','institution_id' => '52','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Quotation for Server Manageable Antivirus for 60 Computer','template_id' => '1','signature_user_id' => '1','outgoing_document_content' => '<p>Dear Sir/Madam,<br />
We, the undersigned, offer to provide the consulting services for <strong>&ldquo;Server Manageable Antivirus for 60 Computer&rdquo; </strong>in accordance with your Request for Quotation and our Quotation as per TOR.</p>

<table align="left" border="1" cellpadding="0" cellspacing="0" class="Table" style="border:1px solid #333333; width:100%">
	<tbody>
		<tr>
			<td style="background-color:#dddddd; width:70%"><strong>PARTICULARS</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>AMOUNT IN NPR</strong></td>
		</tr>
		<tr>
			<td>Server Manageable Antivirus for 60 Computer (Rs. 1500/user Annually)</td>
			<td style="text-align:right">90,000.00</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:right">&nbsp;</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>Sub Total</strong></td>
			<td style="background-color:#dddddd; text-align:right">90,000.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>VAT13%</strong></td>
			<td style="background-color:#dddddd; text-align:right">11,700.00</td>
		</tr>
		<tr>
			<td style="background-color:#dddddd; text-align:right"><strong>Total</strong></td>
			<td style="background-color:#dddddd; text-align:right"><strong>Rs. 1,01,700.00</strong></td>
		</tr>
		<tr>
			<td colspan="2">In Words: Rupees One Lakh One Thousands Seven Hundreds Only</td>
		</tr>
		<tr>
			<td colspan="2">Note: Quotation is only valid for 2 weeks.</td>
		</tr>
	</tbody>
</table>

<p>.</p>

<p>&nbsp;</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-09-20','deleted_at' => NULL,'created_at' => '2017-09-22 15:17:27','outgoing_issue_date' => '2017-09-20','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1718-QTE-83','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-09-22 15:34:51','outgoing_serial_number' => '83'),
            array('id' => '93','institution_id' => '7','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Salary Sept 2017','template_id' => '10','signature_user_id' => '2','outgoing_document_content' => '<div style="margin-top:30px">Dear Sir,<br />
Please debit our account for Young Minds Creation(P) Ltd at your branch with account number <strong>02801030250337</strong> and creditrespective amount to respective account number as mentioned below for the salary settlement.
<table border="1" cellspacing="0" class="MsoTableGrid" style="border-collapse:collapse; border:solid black 1.0pt">
	<tbody>
		<tr>
			<td style="width:.7in">SN</td>
			<td style="width:189.0pt">Name</td>
			<td style="width:119.7pt">Account</td>
			<td style="width:119.7pt">Amount</td>
		</tr>
		<tr>
			<td style="width:.7in">1</td>
			<td style="width:189.0pt">Puja Kumari Sah</td>
			<td style="width:119.7pt">02805080379540</td>
			<td style="width:119.7pt">1,850.00</td>
		</tr>
		<tr>
			<td style="width:.7in">2</td>
			<td style="width:189.0pt">Rachana KC</td>
			<td style="width:119.7pt">04205080258302</td>
			<td style="width:119.7pt">11,892.00</td>
		</tr>
		<tr>
			<td style="width:.7in">3</td>
			<td style="width:189.0pt">Shristi Maharjan</td>
			<td style="width:119.7pt">00405080346214</td>
			<td style="width:119.7pt">6,937.00</td>
		</tr>
		<tr>
			<td style="width:.7in">4</td>
			<td style="width:189.0pt">Srijan Karki</td>
			<td style="width:119.7pt">02805080369190</td>
			<td style="width:119.7pt">45,333.00</td>
		</tr>
		<tr>
			<td style="width:.7in">5</td>
			<td style="width:189.0pt">Sunita Tamang</td>
			<td style="width:119.7pt">02105080069605</td>
			<td style="width:119.7pt">19,800.00</td>
		</tr>
		<tr>
			<td style="width:.7in">6</td>
			<td style="width:189.0pt">Suraj Bhattarai</td>
			<td style="width:119.7pt">02805080382229</td>
			<td style="width:119.7pt">7,920.00</td>
		</tr>
		<tr>
			<td style="width:.7in">7</td>
			<td style="width:189.0pt">Sushil Timilsina</td>
			<td style="width:119.7pt">02805080374002</td>
			<td style="width:119.7pt">45,333.00</td>
		</tr>
		<tr>
			<td style="width:.7in">8</td>
			<td style="width:189.0pt">Pooja Dhakal</td>
			<td style="width:119.7pt">00905080272292</td>
			<td style="width:119.7pt">34,475.00</td>
		</tr>
		<tr>
			<td colspan="3" style="width:359.1pt"><strong>Total</strong></td>
			<td style="width:119.7pt"><strong>1,73,540.00</strong></td>
		</tr>
	</tbody>
</table>
In Words : One Lakh Seventy Three Thousand Five hundred Forty. &nbsp; &nbsp;</div>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-09-24','deleted_at' => NULL,'created_at' => '2017-09-24 18:58:15','outgoing_issue_date' => '2017-09-24','created_by_user_id' => '2','issued_by' => '2','outgoing_issue_number' => '1718-SS-84','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-09-24 19:18:16','outgoing_serial_number' => '84'),
            array('id' => '92','institution_id' => '53','department_name' => '4','folder_id'=>'0','outgoing_document_subject' => 'Request for ToR','template_id' => '29','signature_user_id' => '4','outgoing_document_content' => '<p>&nbsp;</p>

<p>Dear Sir,</p>

<p>Swabalamban Laghubitta Bikas Bank</p>

<p>Baluwatar,Kathmandu</p>

<p>&nbsp;</p>

<p>Subject : Request for ToR.</p>

<p>&nbsp;</p>

<p>As per your, E-mail we would like to ask the TOR for HR System. The System will be easy to view the office staff information. So we would like to request to ToR for your concern.</p>

<p>&nbsp;</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-09-22','deleted_at' => NULL,'created_at' => '2017-09-22 17:12:11','outgoing_issue_date' => '2017-09-22','created_by_user_id' => '2','issued_by' => '2','outgoing_issue_number' => '1718-REQST-85','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-09-25 20:22:11','outgoing_serial_number' => '85'),
            array('id' => '94','institution_id' => '17','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Bank Guarantee Release against managers cheque','template_id' => '4','signature_user_id' => '2','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p>With reference to contract terminated on 28/08/2017for the &quot;Design of Corporate Website for SJVN Arun-3&quot;, we would like to request to create a bank guarantee release letter for the said contract. we have attached managers cheque (Ref. 144102NPPR) for the said claim amount.</p>

<p><strong>BG Issued by Bank</strong>: Nepal Investment Bank</p>

<p><strong>Bank Guarantee No</strong>: 028GUAPB17-0001<br />
<strong>Amount</strong>: Rs. 13,000.00<br />
<strong>Issue Date</strong>: 21-02-2017</p>

<p>&nbsp;</p>

<p><strong>CC</strong>: Nepal Investment Bank Ltd</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-09-17','deleted_at' => NULL,'created_at' => '2017-09-25 20:16:55','outgoing_issue_date' => '2017-09-17','created_by_user_id' => '2','issued_by' => '2','outgoing_issue_number' => '1718-BG-86','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-09-26 14:49:49','outgoing_serial_number' => '86'),
            array('id' => '96','institution_id' => '31','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Work Experience Letter','template_id' => '5','signature_user_id' => '1','outgoing_document_content' => '<p>This is to certify that Mr. Srijan Karki, son of Mr. Sanjaya Karki was a full time developer at Young Minds Creation (P) Ltd. His summary details for job are as mentioned below.</p>

<p><strong>SUMMARY: </strong><br />
Job Position: Mid. PHP Programmer<br />
Job Description: Programming and Development, Meeting clients and coordinating with other team members, enhance production.<br />
Date of Join: 3-Feb-2016<br />
Date of Resignation: 13-Oct-2017 with a pre-notice given one month back.<br />
Salary: NPR 30,000 per month<br />
Performance: Good.</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-10-12','deleted_at' => NULL,'created_at' => '2017-10-12 14:57:34','outgoing_issue_date' => '2017-10-12','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1718-HR-87','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-10-12 14:58:51','outgoing_serial_number' => '87'),
            array('id' => '97','institution_id' => '31','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Rank Promotion ','template_id' => '32','signature_user_id' => '2','outgoing_document_content' => '<p>We are pleased to inform you, Mr. Srijan Karki that you have been promoted to Mid. PHP Programmer and your new position will be in effect from 1-May-2017. Your job responsibilities includes tasks as mentioned below.</p>

<p><strong>Senior Programmer Job Duties:</strong></p>

<ul>
	<li>Accomplishes programming project requirements by coaching programmers.</li>
	<li>Meets programming standards by following production, productivity, quality, and customer-service standards; identifying work process improvements; implementing new technology.</li>
	<li>Arranges program specifications by confirming logical sequence and flowcharts; researching and employing established operations.</li>
	<li>Verifies program operation by confirming tests.</li>
	<li>Updates job knowledge by participating in educational opportunities; reading professional publications; maintaining personal networks.</li>
	<li>Accomplishes department and organization mission by completing related results as needed.</li>
</ul>

<p><strong>Congratulations and all the best. Do good be good. </strong></p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-04-21','deleted_at' => NULL,'created_at' => '2017-10-12 15:06:17','outgoing_issue_date' => '2017-04-21','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1617-APP-21','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-10-12 15:10:02','outgoing_serial_number' => '21'),
            array('id' => '98','institution_id' => '7','department_name' => '1','folder_id'=>'0','outgoing_document_subject' => 'Bank Guarantee Release','template_id' => '4','signature_user_id' => '1','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p>With reference to contract signed for the Design of Corporate Website, we acknowledge that contract tenure has expired.</p>

<p>We, the undersigned, would like to request to release our Performance Bank Guarantee with following details</p>

<p><strong>Issued by Bank</strong>: Nepal Investment Bank<br />
<strong>Bank Guarantee No</strong>: 028GUAPB17-0001<br />
<strong>Amount</strong>: Rs. 13,000.00<br />
<strong>Issue Date</strong>: 21-02-2017</p>

<p><strong>Attachment</strong>: Authorization letter from the party.</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-10-12','deleted_at' => NULL,'created_at' => '2017-10-12 15:44:37','outgoing_issue_date' => '2017-10-12','created_by_user_id' => '3','issued_by' => '3','outgoing_issue_number' => '1718-BG-88','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-10-12 15:44:47','outgoing_serial_number' => '88'),
            array('id' => '99','institution_id' => '27','department_name' => '2','folder_id'=>'0','outgoing_document_subject' => 'Payment Request','template_id' => '3','signature_user_id' => '3','outgoing_document_content' => '<p>Dear Sir/Madam,</p>

<p style="text-align:justify">With reference to contract signed with Young Minds Creations Pvt. Ltd on 2016-12-20<strong>&nbsp;</strong>for providing the consulting service for &ldquo;<strong>Online Examination Form Registration and Processing Module</strong>&rdquo;, we have finished all tasks as per the contract. We, hereby, submit our 3rd&nbsp; Tax Invoice and request you to kindly release the payment at earliest.</p>

<p style="text-align:justify">We also request to make the payment to our bank account if possible.</p>

<p style="text-align:justify"><strong>Bank Details</strong><br />
A/C Name: Young Minds Creation (P) Ltd<br />
Bank A/C No: 02801030250337, Nepal Investment Bank Ltd, New Baneshwor Branch, Kathmandu, Nepal</p>
','outgoing_file_uploads' => '','outgoing_document_date' => '2017-10-15','deleted_at' => NULL,'created_at' => '2017-10-15 16:57:13','outgoing_issue_date' => '2017-10-15','created_by_user_id' => '1','issued_by' => '1','outgoing_issue_number' => '1718-PRQ-89','outgoing_registration_number' => '','outgoing_registration_date' => NULL,'updated_at' => '2017-10-15 16:58:10','outgoing_serial_number' => '89')
        );



        
        DB::table('dms_outgoing_documents')->insert($letters);
    
    }
}
