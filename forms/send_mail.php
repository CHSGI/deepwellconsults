<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Check if all fields are filled
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        
        // Email recipient (Replace with your own email)
        $to = "alabssouls@gmail.com";
        
        // Set email headers
        $headers = "From: $name <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        // Email body
        $emailBody = "
        <html>
        <head>
            <title>$subject</title>
        </head>
        <body>
            <h2>New Contact Message</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Message:</strong></p>
            <p>$message</p>
        </body>
        </html>
        ";

        // Send email
        if (mail($to, $subject, $emailBody, $headers)) {
            echo "Message sent successfully!";
        } else {
            echo "Failed to send the message. Please try again.";
        }

    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request.";
}
?>
