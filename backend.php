<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "dataphi";
$con = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else{
    if( isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["dob"]) && isset($_POST["age"])
      && isset($_POST["mobile"]) && isset($_POST["gender"]) && isset($_POST["extra"])){
        $fname = mysqli_real_escape_string($con, $_POST["fname"]);
        $lname = mysqli_real_escape_string($con, $_POST["lname"]);
        $dob = mysqli_real_escape_string($con, $_POST["dob"]);
        $age = mysqli_real_escape_string($con, $_POST["age"]);
        $mobile = mysqli_real_escape_string($con, $_POST["mobile"]);
        $gender = mysqli_real_escape_string($con, $_POST["gender"]);
        $extra = mysqli_real_escape_string($con, $_POST["extra"]);
        // validate
        if( $fname == "" || $lname == "" || preg_match('/[^A-Za-z]/', $fname) || preg_match('/[^A-Za-z]/', $lname)){
            echo json_encode('name_error');
        }
        elseif( strtotime(date('Y-m-d')) < strtotime($dob) ){
            echo json_encode('dob_error');
        }
        elseif( $dob == "" ){
            echo json_encode('date_error');
        }
        elseif( $age == "" || !is_numeric($age) || strlen($age) > 3 ){
            echo json_encode('age_error');
        }
        elseif( $mobile == "" || !is_numeric($mobile) || strlen($mobile) > 10 ){
            echo json_encode('mobile_error');
        }
        elseif( $gender != "male" && $gender != "female" ){
            echo json_encode('gender_error');
        }
        else{
            $dob = date("Y-m-d", strtotime($dob));
            $query = "INSERT INTO `patient`(`fname`, `lname`, `dob`, `age`, `mobile`, `gender`, `extra`) VALUES
                ('$fname', '$lname', '$dob', '$age', '$mobile', '$gender', '$extra')";
            if (!mysqli_query($con, $query))
            {
                echo("Error description: " . mysqli_error($con));
            }
            else{
                echo json_encode('success');
            }
        }
    }
    else{
        echo json_encode('error');
    }
}
?>