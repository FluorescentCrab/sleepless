Setting up the project:
1.Download Xampp on your device
2.Install it and make it compatible for running python files ( ref : https://www.youtube.com/watch?v=cFAcFP3Di6s )
3.Start Xampp and in it start the apache and mySql servers
4.In your browser open 'http://localhost/phpmyadmin/' 
5. Make a new sql database named 'test' and create a table named 'registration' inside of it 
6.Assign in it 11 columns (id,fullName,rollNo,program,year,mobileNo1,mobileNo2,dol,cov,rtp,status)
7.Copy the files from github and paste them in 'C:\xampp\php\www' and 'C:\xampp\htdocs'.
8.Now restart the servers and open 'http://localhost/index.html'

For Student :
1.Go to 'http://localhost/index.html' and in that click on the student portal button
2.Fill the form appropriately
3.To check Status of your application , return to index and click of 'Check Application Status'
4.Fill your id number and then you will get your status

For Warden :
1.Go to 'http://localhost/index.html' and in that click on the warden portal button
2.Type in your login details 
3.You will then open the database page where you can edit the pending status of students in accept and reject
4.Then you will Click on Send mail , It will send email to the people whose application is accept or reject
(Accepted people will get email saying accept and Rejected people will get email saying reject)
5.Then you will return to index

For Security :
1.The student will get an qr code on email and they to mandatorly have to show it to the security while leaving
2.After scanning it the security will get be able to see the data of the student which he can cross-check and also check the status of the application

