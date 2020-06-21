<?php $companyInfo=fieldByCondition('company',array('id'=>$data['company_name']),'company,company_data');
       $companyData=json_decode($companyInfo->company_data);
?>
Company Name - <?=$companyInfo->company;?> <br />
Company Website - <?=@$data['website']?$data['website']:'Not Available';?> <br />
Company Address - <?=@$companyData->address?@$companyData->address:'Not Available';?>  <br />
Assigned Tele-marketer - <?=@$data['assigned_telemarketer']?fieldByCondition('users',array('id'=>$data['assigned_telemarketer']),"CONCAT(first_name,' ',last_name) as name")->name:'Not Available';?> <br />
Referral Source - <?=@$data['referral_source']?fieldByCondition('referral_source',array('id'=>$data['referral_source']),'name')->name:'Not Available';?> <br />
Priority - <?=@$data['priority']?fieldByCondition('priority',array('id'=>$data['priority']),'priority_name')->priority_name:'Not Available'?> <br />
<br />
<b style="text-decoration: underline;">Contact Information</b><br />
Company Contact Person - <?=@$contact_data['contact_person']?> <br />
Contact Person Email - <?=@$contact_data['email']?><br />
Contact Person Phone - <?=@$contact_data['phone']?@$contact_data['phone']:'Not Available'?> <br />
Address - <?=@$contact_data['address']?@$contact_data['address']:'Not Available'?> <br />
PO Box - <?=@$contact_data['po_box']?@$contact_data['po_box']:'Not Available'?> <br />
Postal Code - <?=@$contact_data['postal_code']?@$contact_data['postal_code']:'Not Available'?><br />
City - <?=@$contact_data['city']?@$contact_data['city']:'Not Available'?> <br />
State -<?=@$contact_data['state']?@$contact_data['state']:'Not Available'?> <br />
Country - <?=$contact_data['country']?fieldByCondition('countries',array('country_id'=>$contact_data['country']),'country_name')->country_name:'Not Available';?> <br />
