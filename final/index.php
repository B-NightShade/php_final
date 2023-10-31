<?php
    session_start();
    include("style.php");
    require("model.php");
    
    $action = $_GET['action'] ?? NULL;
    $auth = $_SESSION['user_logged_in'] ?? NULL;
    $error = "";

    if($auth == NULL){
        include("topNav.php");
    }else{
        include("topNavAuth.php");
    }

    if(isset($_POST['dbAction'])){
        $dbAction = $_POST['dbAction'];
        if($dbAction == "createUser"){
            createUser();
            header('Location:index.php?action=showUsers');
        }
        if($dbAction == "login"){
            $verify = verify();
            if($verify == 1){
                $_SESSION['user_logged_in']=TRUE;
                $_SESSION['user'] = $_POST['username'];
                header('Location:index.php');
            }else{
                $error = "problem signing in!";
                $action = "login";
            }
        }
        if($dbAction == "createBook"){
            addBook($_SESSION['user']);
            header('Location:index.php?action=showBook');
        }
        if($dbAction == "updateBook"){
            $bookid = $_POST['bookid'];
            $userid = $_POST['userid'];
            $user = $_SESSION['user'];
            updateBook($userid, $bookid, $user);
            header('Location:index.php?action=showBook');
        }
    }

    if($action == NULL){
        include ("home.php");
    }
    if($action == "createUser"){
        include("createUser.php");
    }
    if($action == "showUsers"){
        $elements = getUsers();
        include("viewUser.php");
    }
    if($action == "showBook"){
        $elements=getBooks($_SESSION['user']);
        include("showBooks.php");
    }
    if($action == "login"){
        include("login.php");
    }
    if($action == "logout"){
        if($auth == NULL){
            header('Location:index.php');
        }else{
            session_unset();
            header('Location:index.php');
        }
    }
    if($action == "secret"){
        if($auth == NULL){
            header('Location:index.php');
        }else{
            include("secret.php");
        }
    }
    if($action == "createBook"){
        if($auth == NULL){
            header('Location:index.php');
        }else{
            include("createBook.php");
        }
    }
    if($action == "deleteBook"){
        if($auth == NULL){
            header('Location:index.php');
        }else{
            $bookid = $_GET['bookid'];
            $userid = $_GET['userid'];
            $user = $_SESSION['user'];
            deleteBook($userid, $bookid, $user);
            header('Location:index.php?action=showBook');
        }
    }
    if($action == "updateBook"){
        if($auth == NULL){
            header('Location:index.php');
        }else{
            $bookid = $_GET['bookid'];
            $userid = $_GET['userid'];
            $user = $_SESSION['user'];
            $rightUser = checkUser($userid, $bookid, $user);
            if($rightUser){
                $elements = getBook($bookid);
                include("updateBook.php");
            }else{
                header('Location:index.php');
            }
        }
    }
?>