<?php

use Illuminate\Database\Seeder;

class TemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dms_templates')->truncate();
        $rows = [
            [
                'document_category_id' => '9',
                'template_name' => 'Business Letter',
                'template_subject'=>'Business letter subject',
                'template_short_name' => 'bus-let',
                'template_content' => '
                

                <p><strong>Writer&#39;s Contact Information</strong></p>

<p><strong>Date</strong></p>

<p><strong>Recipient&#39;s Contact Information</strong></p>

<p><strong>Salutation</strong></p>

<p><strong>Body of Letter</strong><br />
When writing a business letter, keep it simple and focused, so the purpose of your letter is clear. Use the first paragraph to introduce yourself.&nbsp;The second and third paragraphs will explain why you are writing and what you are requesting from the reader.&nbsp;End your letter by thanking the reader for considering your request.</p>

<p><strong>Closing</strong></p>

<p><em>Your signature&nbsp;</em></p>

<p>Your Typed Signature</p>
                
                
                
                '
            ],
            [
                'document_category_id' => '10',
                'template_name' => 'Cover Letter',
                'template_subject'=>'Cover letter subject',

                'template_short_name' => 'Cov-let',
                'template_content' => '
                   <p><strong>Your Contact Information</strong></p>

<p><strong>Date</strong></p>

<p><strong>Employer&#39;s Contact Information</strong></p>

<p><strong>Salutation</strong></p>

<p><strong>Body of Letter</strong><br />
Include information on the job you are applying for, why you are a good fit for the position, and how you will follow up. Take the time to match your qualifications to the job. Use your closing paragraph to thank the employer for their consideration.</p>

<p><strong>Closing</strong></p>

<p><em>Your signature&nbsp;</em></p>

<p>Your Typed Signature</p>
                '
            ],
            [
                'document_category_id' => '11',
                'template_name' => 'Job Acceptance Letter',
                'template_subject'=>'Job Acceptance letter subject',

                'template_short_name' => 'Job-acpt',
                'template_content' => '
                   <p><strong>Your Contact Information</strong></p>

<p><strong>Date</strong></p>

<p><strong>Employer&#39;s Contact Information</strong></p>

<p><strong>Salutation</strong></p>

<p><strong>Body of Letter</strong><br />
Include information on the job you are applying for, why you are a good fit for the position, and how you will follow up. Take the time to match your qualifications to the job. Use your closing paragraph to thank the employer for their consideration.</p>

<p><strong>Closing</strong></p>

<p><em>Your signature&nbsp;</em></p>

<p>Your Typed Signature</p>
                '
            ],
            [
                'document_category_id' => '12',
                'template_name' => 'reference Letter',
                'template_subject'=>'Reference letter subject',

                'template_short_name' => 'ref-let',
                'template_content' => '
                   <p><strong>Salutation</strong></p>

<p><strong>Body of Letter</strong><br />
The first paragraph of the reference letter describes how you know the person you are recommending and why you are qualified to provide a recommendation.&nbsp;The second and third paragraphs of the letter provide information on why the person is qualified for a job or graduate school, what they can offer, and why you are endorsing them.&nbsp;</p>

<p>The next paragraph should state that you &quot;highly recommend&quot; or &quot;strongly recommend&quot; the individual.</p>

<p>The final paragraph contains an offer to provide more information. Include an email address and a phone number within the paragraph. Also, include your phone number and email address in the return address section of your letter or your signature if you are sending an email reference.</p>

<p><strong>Closing&nbsp;</strong>(printed letter)</p>

<p><em>Your signature&nbsp;</em><br />
<br />
Your Typed Signature</p>
                '
            ],
            [
                'document_category_id' => '5',
                'template_name' => 'rental Contract',
                'template_subject'=>'Rental letter subject',

                'template_short_name' => 'rent',
                'template_content' => '
                   <p><strong>Agreement to Hold Property</strong></p>

<p>&nbsp;</p>

<p>___________________________ (hereafter &quot;Landlord&quot;) and ___________________________ (hereafter &quot;Tenant&quot;) hereby agree to the following concerning the Property at&nbsp;<strong>{location}</strong>:</p>

<p>The Tenant, having been accepted for a&nbsp;<strong>{amount of time}</strong>&nbsp;lease on the Property, will pay the Landlord a deposit of&nbsp;<strong>{amount}</strong>.</p>

<p>Once the Landlord has received the deposit, the Landlord will hold the aforementioned Property until&nbsp;<strong>{date}</strong>. When the Tenant takes possession of the Property, the deposit will be applied toward his/her rent.</p>

<p>If the Tenant has not taken possession of the Property for any reason by the date listed here, the deposit will be considered forfeit and be retained by the Landlord in its entirety.</p>

<p>Should the Landlord delay the move-in date, the deposit as listed above will cover the additional days.</p>

<p>In witness to their agreement to the terms of this contract, the parties affix their signatures below:</p>

<p>____________________________________<br />
Landlord, signature &amp; date</p>

<p>____________________________________<br />
Tenant, signature &amp; date</p>
                '
            ],
            [
                'document_category_id' => '6',
                'template_name' => ' Bartending Contract',
                'template_subject'=>'Bartending letter subject',

                'template_short_name' => 'bartend',
                'template_content' => '
                   <p><strong>Bartending Contract</strong></p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p>__________________________ (hereafter &quot;Bartender&quot;) and ___________________________ (hereafter &quot;Client&quot;) hereby agree to the following for the&nbsp;<strong>{event}</strong>&nbsp;event:</p>

<p>The Bartender will be hired for the event on&nbsp;<strong>{date(s)}</strong>&nbsp;from&nbsp;<strong>{time}</strong>&nbsp;to&nbsp;<strong>{time}</strong>&nbsp;at a cost of&nbsp;<strong>{hourly wage or lump sum}</strong>. The Bartender may also be requested to continue services from&nbsp;<strong>{time}</strong>&nbsp;to&nbsp;<strong>{time}</strong>, for which he/she will be paid&nbsp;<strong>{hourly or total amount}</strong>.</p>

<p>The Bartender will receive a retainer of&nbsp;<strong>{amount}</strong>&nbsp;to secure services for this event. Should the Client cancel the event within&nbsp;<strong>{amount of time}</strong>&nbsp;before the services are required, the Bartender will receive&nbsp;<strong>{amount}</strong>.</p>

<p>The&nbsp;<strong>{Bartender/Client}</strong>&nbsp;will be solely responsible for the acquisition of&nbsp;<strong>{liquor license, location permits, etc.}</strong>&nbsp;for the event. The&nbsp;<strong>{Bartender/Client}</strong>&nbsp;will provide the following beers, ciders, liquors, and wines:&nbsp;<strong>{List}</strong>.</p>

<p>The&nbsp;<strong>{Bartender/Client}</strong>&nbsp;will provide the necessary equipment (kegs, taps, pourers, glassware, etc.).</p>

<p>The Bartender&nbsp;<strong>{will/will not}</strong>&nbsp;be permitted to set out a tip jar/accept tips.</p>

<p>The Bartender will be responsible for ensuring that no underage patrons purchase or consume alcohol from the bar. The Bartender will&nbsp;<strong>{only sell to those with wrist bands, card anyone who looks underage, etc.}</strong>. The Bartender will also use his/her discretion to cease serving patrons who are visibly intoxicated, behaving inappropriately, or who are a danger to themselves or others.</p>

<p>The&nbsp;<strong>{Bartender/Client}</strong>&nbsp;will be responsible for set-up and tear-down.</p>

<p>The&nbsp;<strong>{Bartender/Client}</strong>&nbsp;will not be held responsible for damages to equipment or products during the normal course of the event.</p>

<p>In witness to their agreement to the terms of this contract, the parties affix their signatures below:</p>

<p>____________________________________</p>

<p>Bartender, signature &amp; date</p>

<p>Address___________________________</p>

<p>City, state, ZIP________________________</p>

<p>____________________________________</p>

<p>Contractor, signature &amp; date</p>

<p>Address___________________________</p>

<p>City, state, ZIP _____________________</p>
                '
            ],
            [
                'document_category_id' => '7',
                'template_name' => ' House Keeping Contract',
                'template_subject'=>'House Keeping subject',

                'template_short_name' => 'houselkeep',
                'template_content' => '
                <p>On this day,&nbsp;<strong>{date}</strong>,&nbsp;<strong>{Housekeeper Name}</strong>&nbsp;(hereafter &quot;Housekeeper&quot;) and&nbsp;<strong>{Client Name}</strong>&nbsp;(hereafter &quot;Client&quot;)agree to the following work order, which will begin&nbsp;<strong>{date}</strong>&nbsp;and end&nbsp;<strong>{date/at a time to be determined later}</strong>:</p>

<p>SCHEDULE</p>

<p>The Housekeeper will have a flexible schedule according to his/her own agenda. However, he/she will be required to fulfill all duties on&nbsp;<strong>{list of possible days}</strong>&nbsp;at&nbsp;<strong>{time windows}</strong>.</p>

<p>The Client will be responsible for informing the Housekeeper if any day/time windows become unavailable due to events or visitors.</p>

<p>The Housekeeper will make every attempt to avoid interrupting or interfering with normal household activity while fulfilling his/her duties.</p>

<p>DUTIES</p>

<p>The Housekeeper agrees to fulfill the following duties on every visit:</p>

<ul>
	<li><strong>{List of duties}</strong></li>
</ul>

<p>The Housekeeper agrees to fulfill the following duties on every other visit:</p>

<ul>
	<li><strong>{List of duties}</strong></li>
</ul>

<p>The Client will have the right to inspect and monitor these duties to ensure that they are being performed satisfactorily. The Client will be free to make requests or suggestions. If the work does not consistently meet the Client&#39;s satisfaction, this contract is subject to termination.</p>

<p>EQUIPMENT</p>

<p>The&nbsp;<strong>{Client/Housekeeper}</strong>&nbsp;will supply all cleaning materials and equipment for the duties listed above. Any further materials that are required must be approved by the Client before purchase.</p>

<p>PAYMENT</p>

<p>The Client will pay the Housekeeper on a&nbsp;<strong>{daily/weekly/monthly, etc.}</strong>&nbsp;basis in the amount of&nbsp;<strong>{monetary amount}</strong>&nbsp;per&nbsp;<strong>{hour/day/task, etc.}</strong>.</p>

<p>If the Client fails to pay this amount in full, interest at a rate of&nbsp;<strong>{rate}</strong>&nbsp;will be added to the next payment period. If the Client consistently fails to make payments, this contract is subject to termination.</p>

<p>In witness to their agreement to the terms of this contract, the parties affix their signatures below:</p>

<p>____________________________________</p>

<p>Housekeeper, signature &amp; date</p>

<p>Address___________________________</p>

<p>City, state, ZIP________________________</p>

<p>____________________________________</p>

<p>Client, signature &amp; date</p>

<p>Address___________________________</p>

<p>City, state, ZIP________________________</p>
                
                
                   '
            ],
            [
                'document_category_id' => '8',
                'template_name' => ' Job Contract',
                'template_subject'=>'Job contract subject',

                'template_short_name' => 'job-con',
                'template_content' => '<p><strong>Change Order</strong></p>

<p>&nbsp;</p>

<p>On this day, _____________________, __________________________ (hereafter &quot;Contractor&quot;) and __________________________________ (hereafter &quot;Client&quot;) agree to the following amendments to the work order contract signed _________________.</p>

<table>
	<tbody>
		<tr>
			<th>Change</th>
			<th>&nbsp;&nbsp;</th>
			<th>Additional Cost</th>
			<th>&nbsp;&nbsp;</th>
			<th>Additional Time</th>
			<th>&nbsp;&nbsp;</th>
			<th>Approval Initials</th>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</tbody>
</table>

<p>IN WITNESS WHEREOF, the parties have signed this Agreement as of the date first set forth above.</p>

<p>____________________________________</p>

<p>Client, signature &amp; date</p>

<p>Address___________________________</p>

<p>City, state, ZIP________________________</p>

<p>____________________________________</p>

<p>Contractor, signature &amp; date</p>

<p>Address___________________________</p>

<p>City, state, ZIP _____________________</p>  '
            ],

        ];
        DB::table('dms_templates')->insert($rows);
    }
}
