<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Directory</title>
</head>
<body>
    <a href="./index.html">New Patient</a>
    <a href="directory.php">Patient Directory</a>
    <h2>Patient Directory</h2>
    <input type="text" placeholder="Search by patient name" onKeyup="search(this)">
    <table>
        <tr>
            <th>Id</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>DOB</th>
            <th>Age</th>
            <th>Mobile</th>
            <th>Gender</th>
            <th>Extra</th>
        </tr>
        <tbody id="data">
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
                $query = "select * from patient";
                $fetch = mysqli_query($con, $query);
                if( mysqli_num_rows($fetch) == 0 ){
                    echo "<h3>No Data Found.</h3>";
                }
                while($row = mysqli_fetch_array($fetch))
                {
                    echo "<tr>
                            <td>".$row['id']."</td>
                            <td>".$row['fname']."</td>
                            <td>".$row['lname']."</td>
                            <td>".$row['dob']."</td>
                            <td>".$row['age']."</td>
                            <td>".$row['mobile']."</td>
                            <td>".$row['gender']."</td>
                            <td>".$row['extra']."</td>
                        </tr>";
                }
            }
            ?>
        </tbody>
    </table>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
    function search(element){
        var search = $(element).val();
        $("#data").find('tr').each(function (colIndex, c) {
            if( $(c).children("td:nth-child(2)").text().startsWith(search) || $(c).children("td:nth-child(3)").text().startsWith(search) ){
                $(c).show();
            }
            else{
                $(c).hide();
            }
        });
    }
</script>
</html>