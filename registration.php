<?php
$host = 'localhost';  // Replace with your host
$user = '';   // Replace with your database username
$password = ''; // Replace with your database password
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
    <title>Registration Table</title>
    <style>
        /* Sets the background color for the entire page */
        body {
            font-family: Arial, sans-serif;
            background-color: white; /* Page background color */
            margin: 0;
            padding: 0;
        }

        #registration-section {
            background-color: rgba(7, 147, 235, 0.808);
            position: relative;
            padding: 15px;
            width: auto;
            margin-top: -20px;
            margin-left: -20px;
        }

        /* Header styling within the registration section */
        #registration-section h1 {
            background: #1182fa; /* Teal background for the header */
            color: white; /* White text color */
            padding: 20px;
            text-align: center;
            margin: 0;
            border-radius: 10px 10px 0 0; /* Rounded corners for top left and right */
        }

        .table-responsive {
            overflow-x: auto;
        }

        .registration-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ccc;
        }

        .registration-table th, .registration-table td {
            padding: 5px; /* Reduced padding */
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .registration-table th {
            background: white;
            font-size: larger;
        }

        .registration-table td {
            font-size: large;
        }

        .registration-table tr:nth-child(even) {
            background: #f9f9f9;
        }

        .registration-table tr:hover {
            background: #f1f1f1;
        }
        /* Style for Info button */
.info {
    display: inline-block; /* Ensures the button behaves like a block element */
    padding: 10px 20px; /* Adds padding around the text */
    margin: 5px; /* Adds margin around the button */
    background-color: #007bff; /* Blue background color */
    color: white; /* White text color */
    text-decoration: none; /* Removes underline from the link */
    border-radius: 5px; /* Rounded corners */
    font-weight: bold; /* Makes the text bold */
    transition: background-color 0.3s, color 0.3s; /* Smooth transition for hover effect */
}

/* Hover effect for Info button */
.info:hover {
    background-color: #0056b3; /* Darker blue on hover */
    color: #e9ecef; /* Light color on hover */
}


        .registration-table img {
            width: 100px; /* Adjust the width as needed */
            height: auto; /* Maintain aspect ratio */
            max-height: 100px; /* Adjust the height as needed */
            display: block; /* Ensure it behaves like a block-level element */
            margin: 0 auto; /* Center image in the cell */
        }

        /* Style for cells containing images */
        .registration-table td img {
            border-radius: 4px;
        }
    </style>
</head>
<body>
<section id="registration-section">
        <div class="container">
            <h1>Registration</h1>
            <div class="table-responsive">
                <table class="registration-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID Picture</th>
                            <th>First Name</th>
                            <th>Info</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $counter = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $counter++; ?></td>
                            <td><img src="<?= htmlspecialchars($row['profile_image']) ?>" alt="Profile Image"></td>
                            <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                            <td><a class="info" href="info.php?id=<?php echo $row['id']; ?>">Info</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>
</html>