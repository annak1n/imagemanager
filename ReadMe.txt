Image Manager Application :
Technologies :
1) PHP 5.3
2) Mysql
3) Apache
4) JQuery

Modules :
1) User
2) Dashboard
3) Image Manager
4) Admin Dashboard

Folder Structure :

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
                3. ....
                
        
Apache Modules required :
1) URL Rewrite
 
Apache Virtual Host URL : dev.imagemanager.com	
Root Path : c:/users/vijay/documents/github/imagemanager

@todo :

1) Secure all the code file from direct access.
2) Create bootstrap and move application decisions from index.php to bootstrap class.