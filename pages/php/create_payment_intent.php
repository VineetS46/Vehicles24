<?php
require 'vendor/autoload.php'; // Make sure you have installed the Stripe PHP library

\Stripe\Stripe::setApiKey('sk_test_51N5EO8SDb10zWUfwMY20XPKqsHn1dnEcKksHqeVxY6sf6r2heHPfDKsdmjV4rSHmshHf1Qk0gxEcbjRnroCYkh0500mSvm4wmF'); // Replace with your Stripe secret key

header('Content-Type: application/json');

try {
    // Retrieve the JSON from the request body
    $json_str = file_get_contents('php://input');
    $json_obj = json_decode($json_str);

    // Log the received JSON for debugging
    error_log("Received JSON: " . print_r($json_obj, true));

    // Create a PaymentIntent with the order amount and currency
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $json_obj->amount,
        'currency' => 'inr',
        'payment_method_types' => ['card'],
    ]);

    $output = [
        'clientSecret' => $paymentIntent->client_secret,
    ];

    echo json_encode($output);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
    // Log the error for debugging
    error_log("Error creating PaymentIntent: " . $e->getMessage());
}
?>