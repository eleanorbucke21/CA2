# CCT RENTAL #

CCT Rental is a fictitous movie rental website. 

:open_file_folder: [Github Repository](https://github.com/eleanorbucke21/CA2)

---
**TABLE OF CONTENTS**
* [User Stories](#user-stories)
* [Features](#features)
    * [Navigation Bar](#navigation-bar)
    * [Footer](#footer)
    * [Index](#index-page)
    * [Movie Detail](#movie-detail-page)
    * [Register](#register)
    * [Login](#login)
    * [Logout](#logout)
    * [Admin-Page](#admin-page)
* [Typography and Color Scheme](#typography-and-color-scheme)
    * [Font](#font)
    * [Color Scheme](#color-scheme)
* [USER EXPERIENCE](#user-experience)
    * [Agile](#agile)
* [Technologies](#technologies)
    * [Languages Used](#languages-used)
    * [Technologies Used](#technologies-used)
    * [Databases Used](#databases-used)
    * [Programmes and Applications Used](#programmes-and-applications-used)
* [Testing](#testing)
    * [Responsiveness](#responsiveness)
* [Manual Testing](#manual-testing)
    * [Test Cases](#test-cases)
    * [Full Testing](#full-testing)
* [Bugs, Errors & Solutions](#bugs-found-during-testing-and-development-phase)
    * [Solved Bugs](#solved-bugs)
 * [Content](#ucontentu)

---
### User Stories

## Navigation Bar(Not Logged In)
- As a user I want to be able to tell what the website is about.
- As a user I want to be able to register.
- As a user I want to be able to login. 
- As a user I want to see the products.
- As a user I want to see available movies. 

## Navigation Bar(Logged In)
- As a user I want to be able to logout.
- As a user I want to be able to access my profile.

## Footer
- As a user I want to see the github link.
- As a user I want to see the instagram link.
- As a user I want to see the facebook link.

## Index Page
- As a user I want to be able to see the movies available.

## Movie Detail Page(Not logged in)
- As a user I want to see the actors.
- As a user I want to see the plot of the movie.
- As a user I want to see the movie poster.
- As a user I want to see the movie trailer.

## Movie Detail Page (Logged In)
- As a user I want to see the actors.
- As a user I want to see the plot of the movie.
- As a user I want to see the movie poster.
- As a user I want to see the movie trailer.
- As a user I want to be able to see the book now button. 

## Register
- As a user I want to be able to register.

## Login
- As a user I want to be able to login.

## Logout
- As a user I want to be able to logout.

## Admin Page
- As an admin I want to be able to add the movie.
- As an admin I want to be able to edit a movie
- As an admin I want to be able to delete a movie.

# Features
## Navigation Bar (Not Logged In)
- Featured at the top of the page with the name of the website on the left.
- It contains the links for user account and genre. 
- The navigation bar also has a login.
- The navbar also features a genre button with a drop down link to various genre links. 
- The navigation is also responsive to smaller screens with a toggle option on the navbar, which hides the links till tapped.

## Navigation Bar (User Logged In)
- Featured at the top of the page with the name of the website on the left.
- It contains the links for profile and log out button. 
- The navbar also features a genre button with a drop down link to various genre links. 
- The navigation is also responsive to smaller screens with a toggle option on the navbar, which hides the links till tapped.

## Navigation Bar (Admin Logged In)
- Featured at the top of the page with the name of the website on the left.
- It contains the links for profile, admin page and log out button. 
- The navbar also features a genre button with a drop down link to various genre links. 
- The navigation is also responsive to smaller screens with a toggle option on the navbar, which hides the links till tapped.

## Footer
- The footer has a link to facebook.
- The footer has a link to Twitter.
- The footer has a link to my github

## Main Page
- Displays all the movies on a grid.
- Movie images are responsive across devices.

## Register
- The register page has a form.
- The form displays the details needed.
- If username is already in use it will ask you to fill out form again.
- Once you register you are re-directed to home page.

## Login
- The login page has a form.
- The form displays where to type name and password.
- If a user enters the incorrect username they will recieve an error.

## Logout
- After clicking <i>signout</i> they are redirected to the home page.

## Movie Detail
<u><strong>When user is  not logged in:</strong></u>
- The movie information is displayed.
- The movie poster is displayed.
- The movie trailer is displayed.

<u><strong>When user is logged in:</strong></u>
- The user can book the movie.

# Typography and Color Scheme

## <u>Font</u>
The fonts used in this project are:
- [Roberto Condensed](https://fonts.google.com/specimen/Roboto+Condensed?query=Condensed).

## <u>Color Scheme</u>
    Thed color scheme used was Bootstrap5 

# User Experience

### Agile
I implemented agile methodology when creating this website. The link to the project board can be found [here](https://github.com/users/eleanorbucke21/projects/14/views/1).

# <strong>Technologies</strong>
### <u>Languages used</u>
- [HTML](https://en.wikipedia.org/wiki/HTML5) - Add content and formatting to web page.
- [CSS](https://en.wikipedia.org/wiki/CSS) - Add styling and colours to web page.
- [JavaScript](https://en.wikipedia.org/wiki/JavaScript) - Add interactive features 
to web page.
- [PHP](https://www.php.net/) - create websites, applications, customer relationship management systems and more.

### <u>Technologies Used</u>
- [Bootstrap4 - v5.0.2](https://getbootstrap.com/docs/5.0/getting-started/introduction/) was used as the frontend framework.
- [XAMPP](https://www.apachefriends.org/) was used  to test the code locally on my laptop.

### <u>Databases Used</u>
- [MySQL](https://www.mysql.com/) was used to store the data in tables. 

### <u>Programmes and Applications Used</u>
- [Github](https://github.com/) - used to host the project files and host webpage onto the internet.
- [Fontawesome](https://fontawesome.com/) - to insert icons in the website to make site more visually appealing and easy to navigate.
- [Google Fonts](https://fonts.google.com/) - used to import fonts in the style.css stylesheet.

---

# **TESTING**

---

## Responsiveness
[Am I Responsive?](http://ami.responsivedesign.is/#) was used to check responsiveness of the site pages across different devices.
 
 The site has been tested on various sizes such as those listed below.
 
 <strong>Mobile:</strong>
 375x667 / 360x740 / 412x915 / 414x896
 
 <strong>Tablet:</strong>
 768x1024 / 820x1180 / 912x1368 
 
<strong>Monitor:</strong>
 1280x1024 / 1600x900 / 2560x1440 / 3440x1440

<br>

## Manual Testing
Browser Compatibility:

Browser | Outcome | Pass/Fail 
 --- | --- | ---
Google Chrome | No appearance, responsiveness nor functionality issues.| Pass
Safari | No appearance, responsiveness nor functionality issues. | Pass
Microsoft Edge | No appearance, responsiveness nor functionality issues. | Pass
Firefox | No appearance, responsiveness nor functionality issues. | Pass

<br>

Device compatibility:

Device | Outcome | Pass/Fail
--- | --- | ---
Laptop | No appearance, responsiveness nor functionality issues. | Pass
ipad mini | No appearance, responsiveness nor functionality issues. | Pass
Lenovo M1 Tab | No appearance, responsiveness nor functionality issues. | Pass
Samsung s20 | No appearance, responsiveness nor functionality issues. | Pass
iphone 12 pro | No appearance, responsiveness nor functionality issues. | Pass

## Test cases
 ### Navigation Bar<strong> (Not logged in)</strong>
 
| Input                                   | Output                             | Pass/Fail |
|-----------------------------------------|------------------------------------|-----------|
| Clicked on Logo in navigation bar       | It refreshed the page              | Pass      |
| Clicked on Login button in navigation bar | It brought me to login page       | Pass      |
| Clicked on Genre                        | The dropdown list appeared        | Pass      |
| Clicked on Comedy                       | Filtered movies to comedies        | Pass      |
| Clicked on Fantasy                      | Filtered movies to fantasies       | Pass      |
| Clicked on Crime                        | Filtered movies to crimes          | Pass      |
| Clicked on Drama                        | Filtered movies to dramas          | Pass      |
| Clicked on Music                        | Filtered movies to music           | Pass      |
| Clicked on Adventure                    | Filtered movies to adventures      | Pass      |
| Clicked on History                      | Filtered movies to history         | Pass      |
| Clicked on Thriller                     | Filtered movies to thrillers       | Pass      |
| Clicked on Animation                    | Filtered movies to animations      | Pass      |
| Clicked on Family                       | Filtered movies to family          | Pass      |
| Clicked on Mystery                      | Filtered movies to mystery         | Pass      |
| Clicked on Biography                    | Filtered movies to biographies     | Pass      |
| Clicked on Action                       | Filtered movies to action          | Pass      |
| Clicked on Film-Noir                    | Filtered movies to film-noir       | Pass      |
| Clicked on Romance                      | Filtered movies to romances        | Pass      |
| Clicked on Sci-Fi                       | Filtered movies to sci-fi          | Pass      |
| Clicked on War                          | Filtered movies to war             | Pass      |
| Clicked on Western                      | Filtered movies to westerns        | Pass      |
| Clicked on Horror                       | Filtered movies to horror          | Pass      |
| Clicked on Musical                      | Filtered movies to musicals        | Pass      |
| Clicked on Sport                        | Filtered movies to sports          | Pass      |


<br>

 ### Navigation Bar<strong> (Logged in)</strong>
 
| Input                                   | Output                             | Pass/Fail |
|-----------------------------------------|------------------------------------|-----------|
| Clicked on Logo in navigation bar       | It refreshed the page              | Pass      |
| Clicked on My Profile button in navigation bar | It brought me to profile page| Pass     |
| Clicked on Logout button in navigation bar | It logged me out and brought to index page | Pass      |
| Clicked on Genre                        | The dropdown list appeared         | Pass      |
| Clicked on Comedy                       | Filtered movies to comedies        | Pass      |
| Clicked on Fantasy                      | Filtered movies to fantasies       | Pass      |
| Clicked on Crime                        | Filtered movies to crimes          | Pass      |
| Clicked on Drama                        | Filtered movies to dramas          | Pass      |
| Clicked on Music                        | Filtered movies to music           | Pass      |
| Clicked on Adventure                    | Filtered movies to adventures      | Pass      |
| Clicked on History                      | Filtered movies to history         | Pass      |
| Clicked on Thriller                     | Filtered movies to thrillers       | Pass      |
| Clicked on Animation                    | Filtered movies to animations      | Pass      |
| Clicked on Family                       | Filtered movies to family          | Pass      |
| Clicked on Mystery                      | Filtered movies to mystery         | Pass      |
| Clicked on Biography                    | Filtered movies to biographies     | Pass      |
| Clicked on Action                       | Filtered movies to action          | Pass      |
| Clicked on Film-Noir                    | Filtered movies to film-noir       | Pass      |
| Clicked on Romance                      | Filtered movies to romances        | Pass      |
| Clicked on Sci-Fi                       | Filtered movies to sci-fi          | Pass      |
| Clicked on War                          | Filtered movies to war             | Pass      |
| Clicked on Western                      | Filtered movies to westerns        | Pass      |
| Clicked on Horror                       | Filtered movies to horror          | Pass      |
| Clicked on Musical                      | Filtered movies to musicals        | Pass      |
| Clicked on Sport                        | Filtered movies to sports          | Pass      |

<br>

### Footer Bar
 
| Input | Output | Pass/Fail |
|--- | --- | --- |
|  Clicked on Instagram icon. | It opened [Instagram](https://www.instagram.com/?hl=en) in a new page.| Pass
|  Clicked on Facebook icon. | It opened [facebook](https://www.facebook.com/) in a new page.| Pass
|  Clicked on Github icon. | It opened my [github](https://github.com/eleanorbucke21). | Pass

<br>

### Index/Movie Display

| Input                | Output              | Pass/Fail |
|----------------------|---------------------|-----------|
| Clicked movie image | It opened to the movie | Pass |

<br>

### Login Page

| Input                  | Output                                | Pass/Fail |
|------------------------|---------------------------------------|-----------|
| Entered valid username | Username field accepts input           | Pass      |
| Entered valid password | Password field accepts input           | Pass      |
| Clicked login button   | Redirects to user profile if successful login | Pass      |
| Entered invalid username | Error message displayed              | Pass      |
| Entered invalid password | Error message displayed              | Pass      |

<br>

### Registration Page

| Input                           | Output                                       | Pass/Fail |
|---------------------------------|----------------------------------------------|-----------|
| Entered valid username         | Username field accepts input                 | Pass      |
| Entered valid email address    | Email field accepts input                    | Pass      |
| Entered valid password         | Password field accepts input                 | Pass      |
| Clicked register button        | Redirects to login page if registration successful | Pass      |
| Entered existing username      | Error message displayed for duplicate username | Pass      |
| Entered existing email address| Error message displayed for duplicate email   | Pass      |

<br>

### Booking Page Form

| Input                           | Output                                       | Pass/Fail |
|---------------------------------|----------------------------------------------|-----------|
| Entered valid full name         | Full name field accepts input                | Pass      |
| Entered valid email address    | Email field accepts input                    | Pass      |
| Entered valid date             | Date field accepts input                     | Pass      |
| Submitted form with valid data | Redirects to confirmation page if successful booking | Pass      |
| Submitted form with invalid or missing data | Displays appropriate error messages for missing or invalid data | Pass      |
| Captcha verification           | Displays and verifies the Captcha correctly  | Pass      |


---

# Content

### Files Used
- [Film Json](https://github.com/erik-sytnyk/movies-list/blob/master/db.json)

### Tutorials
- [PHP Login](https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php)