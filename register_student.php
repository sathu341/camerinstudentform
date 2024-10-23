<?php
include('./databaseConfig.php');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $qualification = $_POST['qualification'];
    $joindate = $_POST['joindate'];
    $coursename = $_POST['coursename'];
    $enddate = $_POST['enddate'];
    $parentname = $_POST['parentname'];
    $parentcontact = $_POST['parentcontact'];
    $status = $_POST['status'];
    
    // File upload handling
    $studentphoto = $_FILES['studentphoto'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($studentphoto["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the image file is valid
    $check = getimagesize($studentphoto["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (5MB maximum)
    if ($studentphoto["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only JPG, JPEG, and PNG formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
        $uploadOk = 0;
    }

    // If everything is fine, upload the file and save to the database
    if ($uploadOk == 1) {
        if (move_uploaded_file($studentphoto["tmp_name"], $target_file)) {
            // Insert form data into the database
            $sql = "INSERT INTO students (firstname, lastname, email, phonenumber, qualification, joindate, coursename,enddate, parentname, parentcontact, studentphoto)
                    VALUES ('$firstname', '$lastname', '$email', '$phonenumber', '$qualification', '$joindate', '$coursename', $enddate, '$parentname', '$parentcontact', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully. Student photo uploaded.<br>";
                echo "<h3>Student Details:</h3>";
                echo "First Name: $firstname<br>";
                echo "Last Name: $lastname<br>";
                echo "Email: $email<br>";
                echo "Phone Number: $phonenumber<br>";
                echo "Qualification: $qualification<br>";
                echo "Join Date: $joindate<br>";
                echo "Course Name: $coursename<br>";
                echo "Course Duration: $courseduration months<br>";
                echo "Parent Name: $parentname<br>";
                echo "Parent Contact Number: $parentcontact<br>";
                echo "Photo: <img src='$target_file' width='100'><br>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Close the database connection
$conn->close();
?>
