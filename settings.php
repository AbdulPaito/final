<?php
require_once('database.php'); // Make sure this file includes your database connection

// Handle search query
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Modify query to include search functionality
$query = "SELECT * FROM users WHERE username LIKE '%$search%' OR email LIKE '%$search%'";
$result = mysqli_query($conn, $query);

// Check if query execution was successful
if (!$result) {
    die("Database query failed."); // Handle the error appropriately
}
?>


<section id="settings-section">
    <h1>Settings</h1>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <form method="GET" action="dashboard.php">
    <input type="hidden" name="page" value="settings">
        <input type="text" name="search" placeholder="Search by username or email..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button type="submit">Search</button>
    </form>
    <table class="settings-table">
        <thead>
        <tr>
                <th><i class="fas fa-id-badge"></i> ID</th>
                <th><i class="fas fa-user"></i> Username</th>
                <th><i class="fas fa-key"></i> Password</th>
                <th><i class="fas fa-envelope"></i> Email</th>
                <th><i class="fas fa-edit"></i> Edit</th>
                <th><i class="fas fa-trash-alt"></i> Delete</th>
            </tr>

        </thead>
        <tbody>
            <?php
            $counter = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $counter++; ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><input type="password" value="<?php echo htmlspecialchars($row['password']); ?>" id="password-<?php echo $row['id']; ?>" class="password-field" readonly>
                    <i class="fas fa-eye" onclick="togglePassword(<?php echo $row['id']; ?>)" style="cursor: pointer;"></i></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><a class="edit-button" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a></td>
                    <td><a class="delete-button" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</section>


<?php
// More PHP code here if needed
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
    }

    #settings-section {   
        position: relative;
        padding: 15px;
        position: relative;
        width: auto;
        margin-top: -36px;
        margin-left: -35px;
    }

    #settings-section h1 {
        text-align: center;
        background: #1182fa;;
        color: #fff;
        padding: 20px 0;
        margin: 0;
    }

    .settings-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .settings-table th, .settings-table td {
        padding: 10px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    .settings-table th {
        background: #f4f4f9;
    }

    .settings-table tr:nth-child(even) {
        background: #f9f9f9;
    }

    .settings-table tr:hover {
        background: #f1f1f1;
    }

    .edit-button, .delete-button {
        display: inline-block;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
    }

    .edit-button {
        background: #007bff;
        color: #fff;
    }

    .edit-button:hover {
        background: #45a049;
    }

    .delete-button {
        background: #f44336;
        color: #fff;
    }

    .delete-button:hover {
        background: #e53935;
    }


         /* Search Form Styling */
form {
    display: flex;
    justify-content: right;
    margin-bottom: 20px;
    position: relative;
    top: 10px;
}

form input[type="text"] {
    width: 300px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1em;
    margin-right: 10px;
    box-sizing: border-box;
}

form button {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    background: #007bff;
    color: #fff;
    font-size: 1em;
    cursor: pointer;
    transition: background 0.3s ease;
}

form button:hover {
    background: #0056b3;
}

form input[type="text"]::placeholder {
    color: #aaa;
    font-style: italic;
}

form input[type="text"]:focus {
    border-color: #007bff;
    outline: none;
}

.password-field {
    border: none;
    background: transparent;
    font-size: 1em;
    width: auto;
    text-align: center;
    font-family: inherit;
    margin-right: 5px;
}

.password-field:focus {
    outline: none;
}

td i {
    color: black;
}

td i:hover {
    color: #0056b3;
}

</style>

<script>
function togglePassword(id) {
    var passwordField = document.getElementById('password-' + id);
    var eyeIcon = passwordField.nextElementSibling;

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
