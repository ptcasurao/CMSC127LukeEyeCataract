Things to take note of when testing the UI:

UI makes use of Bootstrap & JQuery
- bootstrap and jquery are temporarily linked online, therefore, for the page to work completely, internet access is needed
- bootstrap and jquery files will be downloaded and added into the UI after it has been finalized

UI uses PHP-mysql extensions for processing MYSQL commands
- for php versions without mysql extensions; php version must be updated with this extension for the UI sql commands to work

UI current working features (to be improved)
- Add records into database via Forms
- Check records from database (simple table, no other ordering choices yet)
- Delete records from database (click 'see more' or 'see full details' then check lower left of new page for delete option)

Other Remarks
-change this part of the code to own setup
...
//INITIALIZE
$server = "localhost";  //own database server name
$username = "root"; //own database username
$password = "...";  //own database password
$database = "...";  //own database name
...

