Recurly CSV Import
==================

These PHP scripts will import subscription data into Recurly from CSV files.  The recurly PHP library (https://github.com/recurly/recurly-client-php) is also needed for these scripts to operate.

The configuration file will need to be updated to include your Recurly API key as well as the location of the CSV file with which you are working, and the preferred timezone.  Make sure to properly configure your CSV file fields at the bottom of each file.  They then need to be run in order 1, 2, then 3.  Step 1 creates your user accounts, step 2 adds the billing information to those accounts and step 3 creates the actual subscriptions.