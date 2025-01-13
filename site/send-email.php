


<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $city_from = $_POST['city_from'] ?? '';
    $city_to = $_POST['city_to'] ?? '';
    $departure_date = $_POST['departure_date'] ?? '';
    $return_date = $_POST['return_date'] ?? 'Not specified';
    $adults = $_POST['adults'] ?? '1';
    $children = $_POST['children'] ?? '0';
    $services = isset($_POST['services']) ? implode(", ", $_POST['services']) : 'No services selected';
    $comments = $_POST['comments'] ?? 'No additional comments provided';

    // Validate required fields
    if (empty($full_name) || empty($email) || empty($phone) || empty($city_from) || empty($city_to) || empty($departure_date)) {
        echo "<script>alert('Please fill out all required fields.'); window.history.back();</script>";
        exit;
    }

    // Email details
    $toEmail = "info@rofimtravels.com"; // Replace with your actual recipient email
    $subject = "New Travel Inquiry from $full_name";
    $message = "
    A new travel inquiry has been submitted:

    Full Name: $full_name
    Email: $email
    Phone: $phone
    From: $city_from
    To: $city_to
    Departure Date: $departure_date
    Return Date: $return_date
    Adults: $adults
    Children: $children
    Services Selected: $services

    Additional Comments:
    $comments
    ";

    $headers = "From: no-reply@rofimtravels.com\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send the email
    if (mail($toEmail, $subject, $message, $headers)) {
        echo "<script>alert('Thank you! Your inquiry has been successfully submitted.'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Failed to send your inquiry. Please try again later.'); window.history.back();</script>";
    }
} else {
    header("Location: index.html");
    exit;
}
?>
