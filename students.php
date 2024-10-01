<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel= "stylesheet" href="style.css" >
</head>
<body>

<!-- <div class="Header">
<h1>Student Admission Details</h1>
</div> -->
<?php
include("include.php");
?>

    <div>  
        <h2>list of Students</h2>        
        <?php
        if(!empty($_SESSION['students']))
        { ?>
        <form method="post">
         <table border="1" cellspacing="0">
            <tr>
                <th> Student Id</th>
                <th>Student Name</th>
                <th>Age</th>
                <th>Year of Enrollment</th>
                <th> Action</th>
            </tr> 
            <?php
        foreach($_SESSION['students'] as $index => $student){
            echo "<tr>";
            echo "<td>".($index +1)."</td>";
         echo isset( $student['Name']) ? "<td>". $student['Name'] . "</td>": "<td>N/A</td>";
         echo isset($student['Age']) ? "<td>" . $student['Age'] . "</td>" : "<td>N/A</td>";
         echo isset($student['Year']) ? "<td>". $student['Year'] . "</td>" : "<td>N/A</td>";
        echo "<td>
            <button type='submit', name='deleteRecord' value='$index'><i class='fa fa-trash'></i></button>
            <button type='submit', name='editRecord' value='$index'><i class='fa fa-edit'></i></button>
            <button name='viewRecord' onclick='viewStudent(".$index.")'><i class='fa fa-eye'></i></button>
        </td>";

         echo "</tr>";
            
        }    
            ?>
    </table>
    </form>
    <div class="overlay_background" id="overlay"> </div>
    <div id="cardDetails" class="cardDetailed" >
        <i class="fa fa-times " style="float:right; cursor:pointer;" onclick=closeCard();> </i>
        <h2 id="studentName"></h2>
        <p id="studentAge"></p>
        <p id="enrollmentYear"></p>
    </div>

    <?php 
    if(isset($_SESSION['message'])){
        echo "<span class='Span' id='message'>".$_SESSION['message']."</span>";
    }

} ?>
<?php
    if (isset($_POST['editRecord'])){
       // print_r($_POST['editRecord']);
        $studentRecord = $_SESSION['students'][$_POST['editRecord']];
    }
    ?>

    <br><br><br><br>
    <h2>Add Student Record</h2>
    <form method="post" >
        <label>Student Name </label><br>
        <input type="text" name="name" value="<?php echo isset($studentRecord['Name'])? $studentRecord['Name']: " ";?>" placeholder="Enter Student name" required><br> <br>
        <label>Student Age </label><br>
        <input type="number" name="age" value="<?php echo isset($studentRecord['Age'])? $studentRecord['Age']: " ";?>" placeholder="Enter Student age" required><br><br>
        <label>Enrolled in </label><br>
        <input type="text" name="year" value="<?php echo isset($studentRecord['Year'])? $studentRecord['Year']: " ";?>" placeholder="Enter Enrollment year" required><br><br>
        <?php
        if(isset($_POST['editRecord']))
        {
            ?>
            
            <button type="submit" name="updateRecord" value="<?php echo $_POST['editRecord'] ?>"> Update </button>

        <?php
        }
        else{ ?>

            <button type="submit" name="addRecord">Add</button>

        <?php } 
        ?>
    </form>
    
    <!-- </div> -->
<script href="script.js">
    
</script>
    <script>
        function viewStudent(id){
            event.preventDefault();
            var studentData = JSON.parse('<?php echo json_encode($_SESSION['students']); ?>');
            console.log(studentData);
            if(studentData[id]){
                document.getElementById("overlay").style.display='flex';
                document.getElementById("cardDetails").style.display='flex';
                document.getElementById("studentName").innerHTML=studentData[id].Name;
                document.getElementById("studentAge").innerHTML=studentData[id].Age;
                document.getElementById("enrollmentYear").innerHTML=studentData[id].Year;
            }
        }
    </script>
    <?php  unset($_SESSION['message']); ?>
<body>
</html>