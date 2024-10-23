<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Student Registration</title>


    <style>
        body{
            over-flow:hidden;
        }
        
.header{
    position:fixed;
    width:100%;
    display: flex;
    padding:20px;
    justify-content: space-between;
    z-index:999;
    color:#03a9f4;
    background-color: #f9f9f9;
    height: 90px;
}   
.logo{
    width:25%;
}
.logo img{
    width:100%;
}
.navs{
    width:75%;
    display: flex;
    gap:20px;
    justify-content: center;
    align-items: center;
}


   .navs a {
            padding: 10px;
            text-align: center;
            text-decoration: none;
            color: black;
            transition: all 1.5s ease-in-out;
        }
        .navs a:hover {
            border: 1px solid black;
            border-radius: 10px;
        }
        .wrapper {
            opacity: 1;
        }
    </style>
</head>
<body >
<?php echo include('./header.php'); ?>
<form class="form" style="margin-top:80px;" id="registrationForm" action="register_student.php" method="POST" enctype="multipart/form-data">
    <div class="container mt-3 bg-light p-3">
    
    <div class="row mt-3  p-3 border">
    <h2 class="text-center">Student Registration Form</h2>
    <br>
            <div class="formgroup col-lg-4">
                <label for="firstname" class="form-label">First Name:</label>
                <input type="text"  class="form-control" id="firstname" name="firstname" required>
            </div>

            <div class="formgroup col-lg-4">
                <label for="lastname" class="form-label">Last Name:</label>
                <input type="text" id="lastname"  class="form-control" name="lastname" required>
            </div>

            <div class="formgroup col-lg-4">
                <label for="parentname" class="form-label">Parent Name:</label>
                <input type="text" id="parentname" class="form-control" name="parentname" required>
            </div>
    </div>
    <div class="row mt-3 p-2 border">
            <div class="formgroup col-lg-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="formgroup col-lg-3">
                <label for="phonenumber" class="form-label">Phone Number:</label>
                <input type="text" class="form-control" id="phonenumber" name="phonenumber" required>
            </div>

            <div class="formgroup col-lg-3">
                <label for="parentcontact" class="form-label">Parent Contact Number:</label>
                <input type="text" class="form-control" id="parentcontact" name="parentcontact" required>
            </div>

            <div class="formgroup col-lg-3">
                <label for="qualification" class="form-label">Qualification:</label>
                <input type="text" id="qualification" class="form-control" name="qualification" required>
            </div>
    </div>

    <div class="row mt-3 border p-3">
            <div class="formgroup col-lg-4">
                <label for="coursename" class="form-label">Course Name:</label>
                <input type="text" class="form-control" id="coursename" name="coursename" required>
            </div>

            <div class="formgroup col-lg-4">
                <label for="joindate" class="form-label">Join Date:</label>
                <input type="date"  class="form-control" id="joindate" name="joindate" required>
            </div>
     
            <div class="formgroup col-lg-4">
                <label for="courseduration" class="form-label">Batch End Date:</label>
                <input type="date"  class="form-control" id="courseduration" name="courseduration" required>
            </div>
    </div>
    <div class="row mt-2 border p-3">
            <div class="formgroup col">
                <label for="studentphoto" class="form-label">Upload Student Photo:</label>
                <input type="file" class="form-control" id="studentphoto" name="studentphoto" accept="image/*" required>
            </div>

            <div class="formgroup col">
                <label for="status" class="form-label">Status:</label>
                <textarea name="status" class="form-control" id="status" rows="4" cols="35"></textarea>
            </div>

            <div class="formgroup col-lg-12 mt-3 p-3" align="center">
                <br>
                <button type="submit" class="btn btn-success" id="registerBtn">Register</button>
            </div>
  
    

        </div>
    </div>
   
    </form>
   

    <script>
        // Form validation function
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
      
            // Get all form fields
            const firstname = document.getElementById('firstname').value.trim();
            const lastname = document.getElementById('lastname').value.trim();
            const parentname = document.getElementById('parentname').value.trim();
            const email = document.getElementById('email').value.trim();
            const phonenumber = document.getElementById('phonenumber').value.trim();
            const parentcontact = document.getElementById('parentcontact').value.trim();
            const qualification = document.getElementById('qualification').value.trim();
            const joindate = document.getElementById('joindate').value.trim();
            const coursename = document.getElementById('coursename').value.trim();
            const courseduration = document.getElementById('courseduration').value.trim();
            const studentphoto = document.getElementById('studentphoto').value.trim();

            // Regex patterns for validation
            const phonePattern = /^[0-9]{10}$/;
            const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

            // Validate fields
            if (!firstname || !lastname || !parentname || !email || !phonenumber || !parentcontact || !qualification || !joindate || !coursename || !courseduration || !studentphoto) {
                alert("Please fill in all fields.");
                event.preventDefault();
                return;
            }

            // Email validation
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                event.preventDefault();
                return;
            }

            // Phone number validation
            if (!phonePattern.test(phonenumber)) {
                alert("Please enter a valid 10-digit phone number.");
                event.preventDefault();
                return;
            }

            // Parent contact validation
            if (!phonePattern.test(parentcontact)) {
                alert("Please enter a valid 10-digit parent contact number.");
                event.preventDefault();
                return;
            }

            // File validation for photo
            const fileInput = document.getElementById('studentphoto');
            if (fileInput.files[0] && fileInput.files[0].size > 2 * 1024 * 1024) { // 2MB limit
                alert("Student photo size should not exceed 2MB.");
                event.preventDefault();
                return;
            }

        });
    </script>
 <!--script bootstrap--> 
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
