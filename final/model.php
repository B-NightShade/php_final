<?php
      $dsn = "mysql:host=localhost;dbname=cs_350";
      $username = "student";
      $password = "CS350";
  
      try{
          $db = new PDO($dsn, $username, $password);
      }catch(PDOException $e){
          $msg = $e->getMessage();
          echo "<p>ERROR: $msg </p>";
      }

      function createUser(){
        $insert = "INSERT INTO cumro_users
            (username,password)
            VALUES
                (:username, :password)";
        $db = $GLOBALS['db'];
        $password = password_hash($_POST["password"],PASSWORD_DEFAULT);
        $statement = $db->prepare($insert);
        $statement->bindValue(':username', $_POST['username']);
        $statement->bindvalue(':password', $password);
        $statement->execute();
        $statement->closeCursor();
      }

      function addBook($uname){
        $db = $GLOBALS['db'];

        $query = "SELECT * FROM cumro_users WHERE username = :uname";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":uname",$uname);
        $stmt->execute();
        $row = $stmt->fetch();
        $userID = $row['userId'];
        $stmt->closeCursor();

        $insert = "INSERT INTO cumro_books
          (title,author,pageNum,finished,userID)
          VALUES
          (:title,:author,:pageNum,:finished,:userID)";
      
        $statement = $db->prepare($insert);
        $statement->bindValue(':title', $_POST['title']);
        $statement->bindValue(':author',$_POST['author']);
        $statement->bindValue(':pageNum',$_POST['pageNum']);
        $statement->bindValue(':finished',$_POST['finished']);
        $statement->bindValue(':userID',$userID);
        $statement->execute();
        $statement->closeCursor();
      }

      function getUsers(){
        $elements = array();
        $db = $GLOBALS['db'];
        $query = "SELECT * FROM cumro_users";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch();
        while($row != NULL){
            $elements[] = $row['userId'];
            $elements[] = $row['username'];
            $elements[] = $row['password'];
            $row = $stmt->fetch();
        }
        $stmt->closeCursor();
        return $elements;
      }

      function getBooks($uname){
        $elements = array();
        $db = $GLOBALS['db'];
        $query = "SELECT * FROM cumro_users WHERE username = :uname";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":uname",$uname);
        $stmt->execute();
        $row = $stmt->fetch();
        $userID = $row['userId'];
        $stmt->closeCursor();

        $query = "SELECT * FROM cumro_books WHERE userId = :userid";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':userid',$userID);
        $stmt->execute();
        $row = $stmt->fetch();
        while($row != NULL){
            $elements[] = $row['bookId'];
            $elements[] = $row['title'];
            $elements[] = $row['author'];
            $elements[] = $row['pageNum'];
            $elements[] = $row['finished'];
            $elements[] = $row['userID'];
            $row = $stmt->fetch();
        }
        $stmt->closeCursor();
        return $elements;
      }

      function getBook($bookid){
        $db = $GLOBALS['db'];
        $query = "SELECT * FROM cumro_books WHERE bookId = :bookid";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':bookid',$bookid);
        $stmt->execute();
        $row = $stmt->fetch();
        while($row != NULL){
            $elements[] = $row['bookId'];
            $elements[] = $row['title'];
            $elements[] = $row['author'];
            $elements[] = $row['pageNum'];
            $elements[] = $row['finished'];
            $elements[] = $row['userID'];
            $row = $stmt->fetch();
        }
        $stmt->closeCursor();
        return $elements;
      }

      function deleteBook($userid, $bookid, $uname){
        $db = $GLOBALS['db'];

        $query = "SELECT * FROM cumro_users WHERE username = :uname";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":uname",$uname);
        $stmt->execute();
        $row = $stmt->fetch();
        $userID = $row['userId'];
        $stmt->closeCursor();

        if($userID==$userid){
          $query = "DELETE FROM cumro_books WHERE bookId = :bookid AND userID=:userid";
          $statement = $db->prepare($query);
          $statement->bindValue(':bookid',$bookid);
          $statement->bindValue(':userid',$userid);
          $statement->execute();
          $statement->closeCursor();
        }
      }

      function checkUser($userid, $bookid, $uname){
        $db = $GLOBALS['db'];

        $query = "SELECT * FROM cumro_users WHERE username = :uname";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":uname",$uname);
        $stmt->execute();
        $row = $stmt->fetch();
        $userID = $row['userId'];
        $stmt->closeCursor();

        if($userID==$userid){
          $query = "SELECT * FROM cumro_books WHERE bookId = :bookid AND userID=:userid";
          $statement = $db->prepare($query);
          $statement->bindValue(':bookid',$bookid);
          $statement->bindValue(':userid',$userid);
          $statement->execute();
          $row = $statement->fetch();
          $statement->closeCursor();
          if($row != NULL){
            return TRUE;
          }
        }
        return FALSE;
      }

      function updateBook($userid, $bookid, $uname){
        $db = $GLOBALS['db'];

        $query = "SELECT * FROM cumro_users WHERE username = :uname";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":uname",$uname);
        $stmt->execute();
        $row = $stmt->fetch();
        $userID = $row['userId'];
        $stmt->closeCursor();

        if($userID==$userid){
          $query = "UPDATE cumro_books 
            SET title=:title,author=:author,pageNum=:pageNum,finished=:finished
             WHERE bookId = :bookid AND userID=:userid";
          $statement = $db->prepare($query);
          $statement->bindValue(':bookid',$bookid);
          $statement->bindValue(':userid',$userid);
          $statement->bindValue(':title', $_POST['title']);
          $statement->bindValue(':author',$_POST['author']);
          $statement->bindValue(':pageNum',$_POST['pageNum']);
          $statement->bindValue(':finished',$_POST['finished']);
          $statement->execute();
          $statement->closeCursor();
        }
      }

      function verify(){
        $verify = FALSE;
        $db = $GLOBALS['db'];
        $query = "SELECT * FROM cumro_users WHERE username = :username";
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $_POST['username']);
        $statement->execute();
        $row = $statement->fetch();
        if($row != NULL){
          $stored_password = $row['password'];
          $statement->closeCursor();
          $verify=password_verify($_POST['password'], $stored_password);
        }
        return $verify;
      }
?>