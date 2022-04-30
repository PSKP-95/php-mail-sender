<?php
    $uid = md5(uniqid(time()));
    $to_email = $_POST["to"];
    $subject = $_POST["subject"];

    $headers = "From: " . $_POST["from"] . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";

    $body = "--" . $uid . "\r\n";

    $contentType = "Content-type:text/plain; charset=iso-8859-1\r\n";
    if (isset($_POST["html"])) {
        $contentType = "Content-type:text/html; charset=iso-8859-1\r\n";
    }

    $body .= $contentType;
    $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $body .= $_POST["text"] . "\r\n\r\n";
    $body .= "--".$uid."\r\n";

    // Attachements
    if (isset($_FILES["files"])) {
        $total = count($_FILES['files']['name']);

        // Loop through each file
        for($i=0; $i<$total; $i++) {
            //Get the temp file path
            $filename = $_FILES["files"]["name"][$i];
            $tmpFilePath = $_FILES["files"]["tmp_name"][$i];

            $body .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
            $body .= "Content-Transfer-Encoding: base64\r\n";
            $body .= "Content-Disposition: attachment; filename=\"".basename($filename)."\"\r\n\r\n";
            $body .= chunk_split(base64_encode(file_get_contents($tmpFilePath)))."\r\n\r\n";
            $body .= "--".$uid."\r\n"; 
        }
    }
    

    $body .= "--".$uid."--";


    // echo $headers;

    if (mail($to_email, $subject, $body, $headers)) {
        echo "Email successfully sent to $to_email...";
    } else {
        echo "Email sending failed...";
    }


?>

