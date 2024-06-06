<?php
// Code written by parth this is to check facebook and other social media crawling.
$user_agent = $_SERVER['HTTP_USER_AGENT'];

if (!empty($user_agent)) {
    // Define the file path where you want to save the User-Agent information
    $file_path = 'user_agent.txt';

    // Open the file in write mode, or create it if it doesn't exist
    $file = fopen($file_path, 'w');

    if ($file) {

if (str_contains($user_agent, 'facebookexternalhit') !== false) {
    $user_agent .= " 1";
}
if (str_contains($user_agent, 'facebook') !== false) {
    $user_agent .= " 1";
}
        // Write the User-Agent value to the file
        fwrite($file, "User-Agent: " . $user_agent);

        // Close the file
        fclose($file);

        echo "User-Agent value has been saved to $file_path";
    } else {
        echo "Unable to open the file for writing.";
    }
} else {
    echo "User-Agent not available";
}

?>