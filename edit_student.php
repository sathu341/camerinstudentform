<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "student_registration");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the student record
    $sql = "SELECT * FROM students WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $coursename = $_POST['coursename'];
    $status = $_POST['status'];

    // Update student data
    $sql = "UPDATE students SET firstname='$firstname', lastname='$lastname', email='$email', phonenumber='$phonenumber', coursename='$coursename',status='$status' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    header('Location: view_students.php');
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>
    <h2>Edit Student Details</h2>

    <form action="edit_student.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" value="<?php echo $row['firstname']; ?>"><br><br>

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" value="<?php echo $row['lastname']; ?>"><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $row['email']; ?>"><br><br>

        <label for="phonenumber">Phone Number:</label>
        <input type="text" name="phonenumber" value="<?php echo $row['phonenumber']; ?>"><br><br>

        <label for="coursename">Course Name:</label>
        <input type="text" name="coursename" value="<?php echo $row['coursename']; ?>"><br><br>
        
        <label for="status">Status:</label>
        <textarea rows="5" cols="34" name="status">
            <?php echo $row['status']; ?>
        </textarea><br><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
