<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        /* Style for action icons */
        .actions i {
            cursor: pointer;
            margin-right: 10px;
        }

        .actions i:hover {
            color: blue;
        }
    </style>
</head>
<body>
    
 <div class="container">
    <div class="row mt-3 p-2">
    <h2 class="text-center">Student List</h2>
    <h3 class="text-center">Search</h3>

    </div>
    <div class="row mt-3 border p-3">
        <div class="col">
        <form action="" method="post">
            <label  class="form-label" for="">By Name</label>
            <input type="text" class="form-control" name="byname" id="" required>
            <input class="btn btn-success" type="submit" value="ByName" name="search">
        </form>
        </div>
        <div class="col">
        <form action="" method="post">
            <label  class="form-label" for="">Join Date</label>
            <input type="text" class="form-control" name="joindate" id="" required>
            <label  class="form-label" for="">End Date</label>
            <input type="text" class="form-control" name="enddate" id="" required>
            <input class="btn btn-success" type="submit" value="ByDate" name="search">
        </form>
        </div>
       
    </div>
<div class="row mt-2 p-2 border">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Course Name</th>
                <th>Status </th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database connection

           include('./databaseConfig.php');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            if($_POST['search']=='ByName'){
                $sql = "SELECT * FROM students WHERE firstname='".$_POST['byname']."'";
                $result = $conn->query($sql);
            }
            else if($_POST['search']=='ByDate'){
                $sql = "SELECT * FROM students WHERE joindate='".$_POST['joindate']."' AND courseduration='".$_POST['courseduration']."'";
                $result = $conn->query($sql);
            }
            else{
            // Fetch student records
            $sql = "SELECT * FROM students";
            $result = $conn->query($sql);
            }

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["firstname"] . "</td>";
                    echo "<td>" . $row["lastname"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["phonenumber"] . "</td>";
                    echo "<td>" . $row["coursename"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "<td><img src='" . $row["studentphoto"] . "' width='50' height='50'></td>";
                    echo "<td class='actions'>";
                    echo "<a href='edit_student.php?id=" . $row["id"] . "'><i class='fas fa-edit'></i></a>";
                    echo "<a href='delete_student.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure?\")'><i class='fas fa-trash-alt'></i></a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No students found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
    <!-- row end -->
    </div>
    <!-- container end -->
    </div>
    <!--script bootstrap--> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
