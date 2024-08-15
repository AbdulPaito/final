<?php
require_once('fpdf/fpdf.php'); // Ensure FPDF is included

session_start();

// Retrieve data from the form submission
$form_type = isset($_POST['form_type']) ? $_POST['form_type'] : '';
$form_data = $_POST; // Get all POST data

// Handle different form types
if ($form_type == 'print1') {
    // Save Print 1 data to the session
    $_SESSION['print1_data'] = $form_data;
} elseif ($form_type == 'print2') {
    // Save Print 2 data to the session
    $_SESSION['print2_data'] = $form_data;
}

// Retrieve data from session
$print1_data = isset($_SESSION['print1_data']) ? $_SESSION['print1_data'] : [];
$print2_data = isset($_SESSION['print2_data']) ? $_SESSION['print2_data'] : [];

// Create a new PDF document
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Add Print 1 data to the PDF
if (!empty($print1_data)) {
    $pdf->Cell(0, 10, 'Print 1 Data:', 0, 1);
    foreach ($print1_data as $key => $value) {
        if ($key != 'form_type') {
            $pdf->Cell(0, 10, ucfirst($key) . ': ' . htmlspecialchars($value), 0, 1);
        }
    }
}

// Add Print 2 data to the PDF
if (!empty($print2_data)) {
    $pdf->Cell(0, 10, 'Print 2 Data:', 0, 1);
    foreach ($print2_data as $key => $value) {
        if ($key != 'form_type') {
            $pdf->Cell(0, 10, ucfirst($key) . ': ' . htmlspecialchars($value), 0, 1);
        }
    }
}

// Define the file path where the PDF will be saved
$filePath = 'path/to/your/directory/combined_output.pdf'; // Adjust path as necessary

// Save the PDF to a file
$pdf->Output('F', $filePath);

// Provide a link to the saved PDF
echo "PDF has been saved. <a href='$filePath' target='_blank'>View PDF</a>";
?>
