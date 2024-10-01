<?php
session_start();
            if(!isset($_SESSION['students'])){
                $_SESSION['students']=[];
            }

// echo $_POST['deleteRecord'];
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
         if (isset($_POST['addRecord'])){

            $newStudent = array(
                'Name' => $_POST['name'],
                'Age' => $_POST['age'],
                'Year' => $_POST['year']
            );
            $_SESSION['students'][] = $newStudent;  
            $_SESSION['message']="Student record added sucessfully";
            header("Location:".$_SERVER['PHP_SELF']);
            exit();      

        }
        if(isset($_POST['deleteRecord'])){
            array_splice($_SESSION['students'], $_POST['deleteRecord'], 1);
            $_SESSION['message']="Student record deleted sucessfully";
            header("Location:".$_SERVER['PHP_SELF']);
            exit();   
        };

        if(isset($_POST['updateRecord'])){
            $index = (int)$_POST['updateRecord'];
            $updatedStudents = array(
                "Name" => $_POST['name'],
                "Age" => $_POST['age'],
                "Year" => $_POST['year']
            );
            $_SESSION['students'][$index]= $updatedStudents;
            $_SESSION['message']="Student record updated sucessfully";
        
            header('location: '.$_SERVER['PHP_SELF']);
            exit();
          }

    }

?>
