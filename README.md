Recurly CSV Import
==================

This PHP script will import subscription data into Recurly from CSV files.  The recurly PHP library (https://github.com/recurly/recurly-client-php) is also needed for this script to operate.

The script will need to be UPDATED to include your Recurly API key as well as the location of the CSV file with which you are working, and the preferred timezone.  Make sure to properly configure your CSV file fields on each line where indicated. 

Step 1 creates your user accounts, step 2 adds the billing information to those accounts and step 3 creates the actual subscriptions.

It's easiest to run the script via the command line:

```php
php Create_Recurly_Accounts.php
```