<?php

// Header to avoid CORS Problem
header('Access-Control-Allow-Origin: *');
 

// Check if the "len" parameter is provided in the query string
if (isset($_GET['len'])) {
    $length = intval($_GET['len']);
    if ($length > 0) {
        
        // Generate a random password of $length 
        // Calling Required Function
        $password = generateRandomPassword($length);

        // Return the data in JSON format So that file can be accesssable
        header('Content-Type: application/json');
        
        //Showing the array if direct call the api in browser
        echo json_encode(array('password' => $password));
    } else {
        // Return an error if the "len" parameter is invalid
        http_response_code(400);
        echo json_encode(array('error' => 'Invalid "len" parameter'));
    }
} else {
    // Return an error if the "len" parameter is not provided
    http_response_code(400);
    echo json_encode(array('error' => 'Missing "len" parameter'));
}


//Fucntion to Genarate Password
function generateRandomPassword($length) {
    // Define the characters that can be used in the password
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%&*_+=';

    // Initialize the password variable
    $password = '';

    // Generate the password by selecting random characters from the character set
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    // Return the generated password
    return $password;
}

?>