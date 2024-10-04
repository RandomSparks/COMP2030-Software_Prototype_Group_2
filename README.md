# COMP2030-Software_Prototype_Group_2
Software prototype for Group 2 Friday 9am


## Database setup guide
First download the [factory_logs.csv](https://canvas.flinders.edu.au/courses/22311/files/3071239) and copy the path.
Start Xampp and open the mysql admin dashboard, and head to the SQL tab.
Paste the sql in the db.sql file into the sql text box and change the filepath for factory_logs.csv
```
find this line...
LOAD DATA INFILE '!!! Change this path/to/factory_logs.csv !!! Make sure you use / not \ !!!'

-- and change it to, for example:
LOAD DATA INFILE 'C:/xampp/htdocs/COMP2030-Software_Prototype_Group_2/factory_logs.csv'
```
If the SQl runs succesfully, you can go to the browse tab to inspect the data there :)

After changes to the database, you might have to run the script again (make sure to use the latest version), and it will automatically drop everything and create it again from scratch.



**Developed By**
*smul0003 basn0058 tami0009 will1941 beam0036 park0903*