<?php
session_start();
require_once('database.php'); // Ensure this includes your database connection

$username_admin = "";
$new_password_admin = "";
$message = "";

// Fetch user data if an ID is provided (for initial form display or after update)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch current user data
    $query = "SELECT username_admin FROM admins WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $username_admin);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_admin = $_POST['username_admin'];
    $new_password_admin = $_POST['password_admin'];

    if (empty($new_password_admin)) {
        // Update only the username if the password is not provided
        $query = "UPDATE admins SET username_admin = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "si", $username_admin, $id);
            $success = mysqli_stmt_execute($stmt);

            if ($success) {
                $message = "Admin username updated successfully.";
            } else {
                $message = "Error updating admin: " . mysqli_error($conn);
            }
        } else {
            $message = "Prepare statement failed: " . mysqli_error($conn);
        }
    } else {
        // Update both the username and password
        $query = "UPDATE admins SET username_admin = ?, password_admin = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssi", $username_admin, $new_password_admin, $id);
            $success = mysqli_stmt_execute($stmt);

            if ($success) {
                $message = "Admin updated successfully.";

                // Update session if the user updates their own username or password
                if (isset($_SESSION['username_admin']) && $_SESSION['username_admin'] === $username_admin) {
                    $_SESSION['username_admin'] = $username_admin;
                }
            } else {
                $message = "Error updating admin: " . mysqli_error($conn);
            }
        } else {
            $message = "Prepare statement failed: " . mysqli_error($conn);
        }
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        
        .form-container {
            width: 300px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        .form-container h2 {
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 15px;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: calc(100% - 40px); /* Adjust width to accommodate the eye icon */
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group .password-container {
            position: relative;
        }
        
        .form-group .password-container input {
            padding-right: 40px; /* Space for the eye icon */
        }
        
        .form-group .eye-icon {
            position: absolute;
            right: 30px;
            top: 40px;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 16px;
        }
        
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
        }
        
        .form-group button:hover {
            background-color: #0056b3;
        }

        .form-group a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }

        .form-group a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Admin</h2>
        <?php if (!empty($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="POST">
            <div class="form-group">
                <label for="username_admin">Username:</label>
                <input type="text" id="username_admin" name="username_admin" value="<?php echo htmlspecialchars($username_admin); ?>">
            </div>
            <div class="form-group password-container">
                <label for="password_admin">New Password:</label>
                <input type="password" id="password_admin" name="password_admin" value="<?php echo htmlspecialchars($new_password_admin); ?>">
                <i class="fas fa-eye eye-icon" onclick="togglePassword()"></i> <!-- Font Awesome eye icon -->
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Change password</button>
                <a href="dashboard.php?page=admin">Go back to my settings</a>
            </div>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password_admin');
            const eyeIcon = document.querySelector('.eye-icon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
