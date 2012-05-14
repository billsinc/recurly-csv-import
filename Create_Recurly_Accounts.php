<?php

//
//	 Recurly CSV Import - v1.1
//
//	 Used for Recurly account and subscription creation from a CSV file 
//	 containing the accounts and subscriptions list.
//
//   Author: Bill Sinclair <bill@agelio.net>
//
//   (MIT License)
//
//   Copyright (C) 2012 by Agelio Networks, Inc. 
// 
//   Permission is hereby granted, free of charge, to any person obtaining a copy
//   of this software and associated documentation files (the "Software"), to deal
//   in the Software without restriction, including without limitation the rights
//   to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
//   copies of the Software, and to permit persons to whom the Software is
//   furnished to do so, subject to the following conditions:
// 
//   The above copyright notice and this permission notice shall be included in
//   all copies or substantial portions of the Software.
// 
//   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
//   IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
//   FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
//   AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
//   LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
//   OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
//   THE SOFTWARE.


// Need Recurly PHP library
require_once('lib/recurly.php');
// Include parameter file
require_once('config.php');

// Step 1: Creating accounts
ini_set('auto_detect_line_endings', true);
$csvfile = fopen($filename,'rb');
while(!feof($csvfile)) {
	$csvarray[] = fgetcsv($csvfile);
}

echo 'Creating accounts...';
// CHANGE corresponding row numbers to match data in your CSV file
for ( $row = 1; $row++)
   		{
			$account = new Recurly_Account($csvarray[$row][0]);
			// Assumes username and email are the same field
			$account->username = $csvarray[$row][1];
			$account->email = $csvarray[$row][1];
			$account->first_name = $csvarray[$row][2];
			$account->last_name = $csvarray[$row][3];
			$account->company_name = '';
			$account->create();
			echo 'New account created for user: ' . $csvarray[$row][1] . '<br /><br />';
   		}
		echo 'Done creating accounts!';


// Step 2:  Add billing information to previously created accounts
ini_set('auto_detect_line_endings', true);
$csvfile = fopen($filename,'rb');
while(!feof($csvfile)) {
	$csvarray[] = fgetcsv($csvfile);
}

echo 'Adding billing information...';
// CHANGE corresponding row numbers to match data in your CSV file
for ( $row = 1; $row++)
   		{
			$billing_info = new Recurly_BillingInfo();
			$billing_info->account_code = $csvarray[$row][0];
			$billing_info->first_name = $csvarray[$row][2];
			$billing_info->last_name = $csvarray[$row][3];
			$billing_info->company = '';
			$billing_info->address1 = '';
			$billing_info->address2 = '';
			$billing_info->city = '';
			$billing_info->state = '';
			$billing_info->country = 'US';
			$billing_info->zip = '';
			$billing_info->phone = '';
			$billing_info->number = '';
			$billing_info->month = '';
			$billing_info->year = '';
			$billing_info->update();
			echo 'Billing information updated for account number: ' . $csvarray[$row][0] . '<br /><br />';
   		}
		echo 'Done adding billing information!';


// Step 3: Creating subscriptions
ini_set('auto_detect_line_endings', true);
$csvfile = fopen($filename,'rb');
while(!feof($csvfile)) {
	$csvarray[] = fgetcsv($csvfile);
}

echo 'Creating subscriptons...';
// CHANGE corresponding row numbers to match data in your CSV file
for ( $row = 1; $row++)
   		{
			$subscription = new Recurly_Subscription();
			$account = new Recurly_Account();
			$account->account_code = $csvarray[$row][0];
			$subscription->plan_code = '';
			$subscription->currency = 'USD';
			$subscription->add_ons = '';
			$subscription->trial_ends_at = 'Thursday, March 15, 2012 00:00:00 PM GMT-6';
			$subscription->start_at = 'Thursday, March 15, 2012 00:00:00 PM GMT-6';
			$subscription->account = $account;
			$subscription->create();
			echo 'Subscription created for account number: ' . $csvarray[$row][0] . '<br /><br />';
   		}
		echo 'Done creating subscriptions!';

echo 'All done!';		

?>