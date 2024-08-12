<?php
// Step 1: Establish database connection
$host = 'localhost';  // Replace with your host
$user = ' ';   // Replace with your database username
$password = ' '; // Replace with your database password
$database = 'tesda'; // Replace with your database name

$connection = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 2: Execute query to fetch data
$query = "SELECT * FROM users";
$result = mysqli_query($connection, $query);

// Check if query execution was successful
if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        /* General section styling */
        #profile-section {
            position: relative;
            padding: 15px;
            width: auto;
            margin-top: -36px;
            margin-left: -35px;
        }

        /* Heading styling */
        #profile-section h1 {
            text-align: center;
            background: #1182fa;
            color: #fff;
            padding: 20px 0;
            margin: 0;
        }

        /* Paragraph styling */
        #profile-section p {
            font-size: 1.2em;
            color: #666;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Table styling */
        .profile-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        .profile-table th,
        .profile-table td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .profile-table th {
            background: #f9f9f9;
        }

        .profile-table tr:nth-child(even) {
            background: #f9f9f9;
        }

        .profile-table tr:hover {
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
        
        /* Dropdown styling */
        .status-select {
            width: 100%;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.status-select').change(function() {
                var status = $(this).val();
                var id = $(this).data('id');
                
                $.ajax({
                    url: 'update_status.php',
                    type: 'POST',
                    data: { id: id, status: status },
                    success: function(response) {
                        console.log('Status updated successfully:', response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating status:', error);
                    }
                });
            });
        });
    </script>
</head>
<body>

<section id="profile-section">
    <h1>Profile</h1>
    <table class="profile-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>COURSE</th>
                <th>STATUS</th>
                <th>EDIT</th>
                <th>DELETE</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $counter = 1;
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $counter++; ?></td>
                    <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['qualification']); ?></td>
                    <td>
                        <select class="status-select" data-id="<?php echo $row['id']; ?>">
                        <option value="Pending" <?php echo ($row['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                            <option value="Enroll" <?php echo ($row['status'] == 'Enroll') ? 'selected' : ''; ?>>Enroll</option>
                            <option value="Graduate" <?php echo ($row['status'] == 'Graduate') ? 'selected' : ''; ?>>Graduate</option>
                            <option value="Drop" <?php echo ($row['status'] == 'Drop') ? 'selected' : ''; ?>>Drop</option>
                            
                        </select>
                    </td>
                    <td><a class="edit-button" href="edit-profile.php?id=<?php echo $row['id']; ?>">Edit</a></td>
                    <td><a class="delete-button" href="delete-profile.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                </tr>
            <?php
                    }
                }
            ?>
        </tbody>
    </table>
</section>

</body>
</html>