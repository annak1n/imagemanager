Image Manager Application :
Technologies :
1) PHP 5.3
2) Mysql
3) Apache
4) JQuery

Modules :
1) User
2) Dashboard User/Admin
3) Image Manager

Folder Structure --------------------------------------------------

1) root
    a) index.php
    b) .htaccess
    c) ReadMe.txt
    d) config/
        1. database.php
        2. path.php
        3. session.php
        4. config.php
        5. include.php
    e) controllers/
        1. user.php
        2. dashboard.php
        3. images.php
        4. admin/
            a) dashboard.php
    f) models/
        1. user.php
        2. images.php
    g) views/
        1. user/
            a) login_form.php
            b) logout.php
            c) detail.php
            d) register_form.php
        2. dashboard/
            a) detail.php
            b) admin_detail.php
        3. images/
            a) upload_form.php
            b) list.php
            c) detail.php
            d) edit.php
        4. layout/
            a) main.php
            b) ajax.php
      h) core/
            a) baseController.php
            b) baseModel.php
      g) images -- user images.
      i) assets/
            a) js/
                1. login.js
                2. register.js
                
Application Setup ----------------------------------------------------

Apache Modules required :
1) URL Rewrite (- not using as of now).

PHP Modules :
1) Mysqli

Apache Virtual Host URL : dev.imagemanager.com	
Root Path : c:/users/vijay/documents/github/imagemanager

Configuration :
    
    1) Database.php - Provide database credentials.
    

Tasks Status ----------------------------------------------------------

Tasks Complete :
1) Task #1 - User Creation:
    a) Login
    b) Register - Check confirm password.
    c) Change Email - From Dashboard
    d) User Activation
    e) Send Activation Email
    f) Redirect to dashboard if user loggedin.
    g) Added Admin by admin code.

2) Task #2 - User Dashboard
    a) Display user's email address
    b) Allow user to upload an image.
    c) View all images that a user has uploaded
    d) Delete an image
    e) Redirect the user back to the dashboard after an upload or deletion
    f) Allow users to change their e-mail address

3) Task #3 - Admin Dashboard
    a) View all photos from all users.
    

Points from the test that are pending :
    1) Apply javascript validation on login, register and image upload forms.
    2) Assign Image to user.
    3) Delete image through ajax.
    4) Allow users to specify the order in which the images are displayed, and display them in that order.
    5) Admin Filter - Delete multiple images at a time.
    6) Admin Filter - View all photos from a specific user
    7) Admin Filter - Display the email address that each photo belongs to.
    8) Admin Filter - Filter multiple users at a time
    9) Admin Filter - Prevent non-admin users from accessing the page
    

@todo Optimization  :

1) Secure all the code file from direct access.
2) Create bootstrap and move application decisions from index.php to bootstrap class.