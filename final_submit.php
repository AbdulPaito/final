<?php

// Database connection
$servername = "localhost";
$username = "your_db_username";
$password = "your_db_password";
$dbname = "tesda"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start(); // Ensure session is started

// Collect session data from previous pages
$username = isset($_SESSION['username']) ? $conn->real_escape_string($_SESSION['username']) : '';
$profile_image = isset($_SESSION['profile_image']) ? $_SESSION['profile_image'] : '';
$imageUpload = isset($_SESSION['imageUpload']) ? $_SESSION['imageUpload'] : '';

// Handle file uploads
$upload_dir = 'Upload-image/';
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
    $profile_image = $upload_dir . basename($_FILES['profile_image']['name']);
    if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $profile_image)) {
        echo "Error uploading image.";
        exit;
    }
}

if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] == 0) {
    $imageUpload = $upload_dir . basename($_FILES['imageUpload']['name']);
    if (!move_uploaded_file($_FILES['imageUpload']['tmp_name'], $imageUpload)) {
        echo "Error uploading image.";
        exit;
    }
}

// Prepare SQL statement to update form data into the database
$sql = "UPDATE users SET 
    profile_image = ?, 
    uli_number = ?, 
    entry_date = ?, 
    last_name = ?, 
    first_name = ?, 
    middle_name = ?, 
    address_number_street = ?, 
    address_barangay = ?, 
    address_district = ?, 
    address_city_municipality = ?, 
    address_province = ?, 
    address_region = ?, 
    email_facebook = ?, 
    contact_no = ?, 
    nationality = ?, 
    sex = ?, 
    civil_status = ?, 
    employment_status = ?, 
    month_of_birth = ?, 
    day_of_birth = ?, 
    year_of_birth = ?, 
    age = ?, 
    birthplace_city_municipality = ?, 
    birthplace_province = ?, 
    birthplace_region = ?, 
    educational_attainment = ?, 
    parent_guardian_name = ?, 
    parent_guardian_address = ?, 
    classification = ?, 
    disability = ?, 
    cause_of_disability = ?, 
    taken_ncae = ?, 
    where_ncae = ?, 
    when_ncae = ?, 
    qualification = ?, 
    scholarship = ?, 
    privacy_disclaimer = ?, 
    applicant_signature = ?, 
    date_accomplished = ?, 
    registrar_signature = ?, 
    date_received = ?, 
    imageUpload = ?, 
    status = ?, 
    registration_complete = ? 
    WHERE username = ?";

// Prepare and bind
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("sssssssssssssssssssssssssssssssssssssssssssss", 
    $profile_image, $uli_number, $entry_date, $last_name, $first_name, $middle_name,
    $address_number_street, $address_barangay, $address_district,
    $address_city_municipality, $address_province, $address_region,
    $email_facebook, $contact_no, $nationality, $sex, $civil_status, $employment_status, $month_of_birth, $day_of_birth, $year_of_birth, $age, $birthplace_city_municipality, $birthplace_province, $birthplace_region,
    $educational_attainment, $parent_guardian_name, $parent_guardian_address, $classification, $disability, $cause_of_disability,
    $taken_ncae, $where, $when, $qualification, $scholarship,
    $privacy_disclaimer, $applicant_signature,
    $date_accomplished, $registrar_signature, $date_received, $imageUpload,
    $status, $registration_complete, $username
);

// Execute the statement
if ($stmt->execute()) {
    echo "Registration updated successfully!";
    header('Location: login.php');
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();

// Clear session data
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
?>
