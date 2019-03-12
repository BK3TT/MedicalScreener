# Medical Screener

This project gives dummy functionality what a Medical Screener could look like in the future, it's mainly made to look good on Mobile with it looking the same in Desktop view. As the Project should mainly run on Smaller devices due to the majority of people having them.

The project is built with VueJS and PHP, this based project is a very good skeleton to get started with a Medical Screener system

### Build Time:

- **Research Time to Learn more about VueJS:** 5 hours
- **PHP Code:** 2 hours
- **Frontend:** 6 hours

### Features

- Home page
- Fill out Survey 
- Completion page ('Shows not qualified') due to this being a dummy project
- Chatbox (LiveZilla Plugin)
- Sign in
- Register
- User Profile (Updating data)

### Required to set up project 

- Node 
- Npm 
- Git
- Local Server with Database

### Setup

First you will need to clone the repo

 ```git clone https://github.com/BK3TT/MedicalScreener.git```
 
Next you will need to follow the following steps:
 
 - Add: ```medical-screener.sql``` to your local database
 - Add: LiveZilla (https://www.livezilla.net/home/en/) - Make sure you take the LiveZilla folder and then when you have your localhost running go to localhost/livezilla and follow install instructions
 
 - Run: go inside frontend folder from terminal and do ```npm install``` this should install the node modules required for project
 - Run: ```npm run dev``` you should have the project up and running
 
 ### Things to check
 
 - Run: ```backend example: http://localhost/``` and ```frontend example: http://localhost:8080/``` - Make sure that the frontend and backend are running on different ports, makes it easier if they're running on seperate domains or sub domains
 
 - From LiveZilla make sure you add the update code which gets provided inside /frontend/index.html the code should look similar to:
 
```<script type="text/javascript" id="lzdefsc" src="//localhost/livezilla/script.php?id=lzdefsc" defer></script>```

- If LiveZilla is set up correctly, you should datatables starting with ```lz_``` in local database

##### Built by: Christopher Beckett
