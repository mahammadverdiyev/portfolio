<?php

if (isset($_POST)) {
    $message = "";

    if (isset($_FILES['file'])) {
        $fileName = $_FILES['file']['name'];
        $fileType = $_FILES['file']['type'];
        $fileError = $_FILES['file']['error'];
        $fileContent = file_get_contents($_FILES['file']['tmp_name']);

        if ($fileError == UPLOAD_ERR_OK) {
            $message = "OK";
            $destination = "../uploads/".$fileName;
            move_uploaded_file($_FILES['file']['tmp_name'],$destination);
            include "../database.php";
            $con->query("update users set avatar = '$fileName' where id = 1 limit 1");

        } else {
            switch ($fileError) {
                case UPLOAD_ERR_FORM_SIZE:
                case UPLOAD_ERR_INI_SIZE:
                    $message = 'Error when trying to upload a file that exceeds the allowed size.';
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $message = 'Error: did not finish the action of uploading the file.';
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $message = 'Error: no file was uploaded.';
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $message = 'Error: server not configured for file upload.';
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $message = 'Error: possible failure to write the file.';
                    break;
                default:
                    $message = 'Error: file upload not completed.';
                    break;
            }

        }
    } else {
        $message = "File is not uploaded";
    }


    echo json_encode(array(
        'error' => true,
        'message' => $message,
    ));
}

?>