<?php
require_once "bootstrap.php";

if (!isUserLoggedIn() && !isAdminLoggedIn()) {
    header("location: login.php");
    exit;
}

$msg = "";
$user = $_SESSION["username"];

if (isset($_FILES["fileToUpload"])) {
    $target_dir = "upload/";
    $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));

    $newFileName = $user . "_" . time() . "." . $imageFileType;
    $target_file = $target_dir . $newFileName;

    $uploadOk = 1;

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        setMsg("File is not an image.", "danger");
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        setMsg("Sorry, your file is too large.", "danger");
        $uploadOk = 0;
    }

    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        setMsg("Sorry, only JPG, JPEG, PNG & GIF files are allowed.", "danger");
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
    } else {
        $currentUserInfo = $dbh->getUserInfo($user);
        $oldImage = $currentUserInfo['fotoProfilo'];
        if ($oldImage && $oldImage != 'default.png' && file_exists($target_dir . $oldImage)) {
            unlink($target_dir . $oldImage);
        }

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            if ($dbh->updateUserImage($user, $newFileName)) {
                setMsg("image updated successfully", "success");
            } else {
                setMsg("Error updating database.", "danger");
            }
        } else {
            setMsg("Sorry, there was an error uploading your file.", "danger");
        }
    }
}

header("location: profilo.php");
?>