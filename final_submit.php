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
$user = isset($_SESSION['username']) ? $conn->real_escape_string($_SESSION['username']) : '';

// Handle file uploads
$upload_dir = 'Upload-image/';
$profile_image = '';
$imageUpload = '';

if (isset($_SESSION['profile_image'])) {
    $profile_image = $_SESSION['profile_image'];
}

if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
    $profile_image = $upload_dir . basename($_FILES['profile_image']['name']);
    if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $profile_image)) {
        echo "Error uploading image.";
        exit;
    }
}

if (isset($_SESSION['imageUpload'])) {
    $imageUpload = $_SESSION['imageUpload'];
}

if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] == 0) {
    $imageUpload = $upload_dir . basename($_FILES['imageUpload']['name']);
    if (!move_uploaded_file($_FILES['imageUpload']['tmp_name'], $imageUpload)) {
        echo "Error uploading image.";
        exit;
    }
}

// Collect session data from previous pages
$uli_number = isset($_SESSION['uli_number']) ? $conn->real_escape_string($_SESSION['uli_number']) : '';
$entry_date = isset($_SESSION['entry_date']) ? $conn->real_escape_string($_SESSION['entry_date']) : '';
$last_name = isset($_SESSION['last_name']) ? $conn->real_escape_string($_SESSION['last_name']) : '';
$first_name = isset($_SESSION['first_name']) ? $conn->real_escape_string($_SESSION['first_name']) : '';
$middle_name = isset($_SESSION['middle_name']) ? $conn->real_escape_string($_SESSION['middle_name']) : '';
$address_number_street = isset($_SESSION['address_number_street']) ? $conn->real_escape_string($_SESSION['address_number_street']) : '';
$address_barangay = isset($_SESSION['address_barangay']) ? $conn->real_escape_string($_SESSION['address_barangay']) : '';
$address_district = isset($_SESSION['address_district']) ? $conn->real_escape_string($_SESSION['address_district']) : '';
$address_city_municipality = isset($_SESSION['address_city_municipality']) ? $conn->real_escape_string($_SESSION['address_city_municipality']) : '';
$address_province = isset($_SESSION['address_province']) ? $conn->real_escape_string($_SESSION['address_province']) : '';
$address_region = isset($_SESSION['address_region']) ? $conn->real_escape_string($_SESSION['address_region']) : '';
$email_facebook = isset($_SESSION['email_facebook']) ? $conn->real_escape_string($_SESSION['email_facebook']) : '';
$contact_no = isset($_SESSION['contact_no']) ? $conn->real_escape_string($_SESSION['contact_no']) : '';
$nationality = isset($_SESSION['nationality']) ? $conn->real_escape_string($_SESSION['nationality']) : '';

// Use implode only if the variable is an array
$sex = isset($_SESSION['sex']) ? (is_array($_SESSION['sex']) ? implode(', ', $_SESSION['sex']) : $_SESSION['sex']) : '';
$civil_status = isset($_SESSION['civil_status']) ? (is_array($_SESSION['civil_status']) ? implode(', ', $_SESSION['civil_status']) : $_SESSION['civil_status']) : '';
$employment_status = isset($_SESSION['employment_status']) ? $conn->real_escape_string($_SESSION['employment_status']) : '';
$month_of_birth = isset($_SESSION['month_of_birth']) ? $conn->real_escape_string($_SESSION['month_of_birth']) : '';
$day_of_birth = isset($_SESSION['day_of_birth']) ? $conn->real_escape_string($_SESSION['day_of_birth']) : '';
$year_of_birth = isset($_SESSION['year_of_birth']) ? $conn->real_escape_string($_SESSION['year_of_birth']) : '';
$age = isset($_SESSION['age']) ? $conn->real_escape_string($_SESSION['age']) : '';
$birthplace_city_municipality = isset($_SESSION['birthplace_city_municipality']) ? $conn->real_escape_string($_SESSION['birthplace_city_municipality']) : '';
$birthplace_province = isset($_SESSION['birthplace_province']) ? $conn->real_escape_string($_SESSION['birthplace_province']) : '';
$birthplace_region = isset($_SESSION['birthplace_region']) ? $conn->real_escape_string($_SESSION['birthplace_region']) : '';
$educational_attainment = isset($_SESSION['educational_attainment']) ? (is_array($_SESSION['educational_attainment']) ? implode(', ', $_SESSION['educational_attainment']) : $_SESSION['educational_attainment']) : '';
$parent_guardian_name = isset($_SESSION['parent_guardian_name']) ? $conn->real_escape_string($_SESSION['parent_guardian_name']) : '';
$parent_guardian_address = isset($_SESSION['parent_guardian_address']) ? $conn->real_escape_string($_SESSION['parent_guardian_address']) : '';
$classification = isset($_SESSION['classification']) ? (is_array($_SESSION['classification']) ? implode(', ', $_SESSION['classification']) : $_SESSION['classification']) : '';
$disability = isset($_SESSION['disability']) ? (is_array($_SESSION['disability']) ? implode(', ', $_SESSION['disability']) : $_SESSION['disability']) : '';
$cause_of_disability = isset($_SESSION['cause_of_disability']) ? (is_array($_SESSION['cause_of_disability']) ? implode(', ', $_SESSION['cause_of_disability']) : $_SESSION['cause_of_disability']) : '';
$taken_ncae = isset($_SESSION['taken_ncae']) ? $conn->real_escape_string($_SESSION['taken_ncae']) : '';
$where = isset($_SESSION['where']) ? $conn->real_escape_string($_SESSION['where']) : '';
$when = isset($_SESSION['when']) ? $conn->real_escape_string($_SESSION['when']) : '';
$qualification = isset($_SESSION['qualification']) ? $conn->real_escape_string($_SESSION['qualification']) : '';
$scholarship = isset($_SESSION['scholarship']) ? $conn->real_escape_string($_SESSION['scholarship']) : '';
$privacy_disclaimer = isset($_SESSION['privacy_disclaimer']) ? $conn->real_escape_string($_SESSION['privacy_disclaimer']) : '';
$applicant_signature = isset($_POST['applicant_signature']) ? $conn->real_escape_string($_POST['applicant_signature']) : '';
$date_accomplished = isset($_POST['date_accomplished']) ? $conn->real_escape_string($_POST['date_accomplished']) : '';
$registrar_signature = isset($_POST['registrar_signature']) ? $conn->real_escape_string($_POST['registrar_signature']) : '';
$date_received = isset($_POST['date_received']) ? $conn->real_escape_string($_POST['date_received']) : '';
$status = ''; // Add default value or update as needed
$registration_complete = 1; // Add default value or update as needed

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

// Prepare the statement
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Statement preparation failed: " . $conn->error);
}

// Bind parameters (all are strings except for file paths which are also strings)
$stmt->bind_param("sssssssssssssssssssssssssssssssssssssssssssss", 
    $profile_image, 
    $uli_number, 
    $entry_date, 
    $last_name, 
    $first_name, 
    $middle_name, 
    $address_number_street, 
    $address_barangay, 
    $address_district, 
    $address_city_municipality, 
    $address_province, 
    $address_region, 
    $email_facebook, 
    $contact_no, 
    $nationality, 
    $sex, 
    $civil_status, 
    $employment_status, 
    $month_of_birth, 
    $day_of_birth, 
    $year_of_birth, 
    $age, 
    $birthplace_city_municipality, 
    $birthplace_province, 
    $birthplace_region, 
    $educational_attainment, 
    $parent_guardian_name, 
    $parent_guardian_address, 
    $classification, 
    $disability, 
    $cause_of_disability, 
    $taken_ncae, 
    $where,
    $when, 
    $qualification, 
    $scholarship, 
    $privacy_disclaimer, 
    $applicant_signature, 
    $date_accomplished, 
    $registrar_signature, 
    $date_received, 
    $imageUpload, 
    $status, 
    $registration_complete, 
    $user
);

// Execute the statement
if ($stmt->execute()) {
    echo "Registration complete and data updated successfully.";
    header('Location: login.php');
} else {
    echo "Error updating record: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();


// Clear session data
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
?>