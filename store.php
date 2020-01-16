<?php

include '_header.php';

if (isset($_POST['submit'])) {

    //main logic and input data validation

    $errors = [];
    $errorMessage = '';

    $name = $_POST['name'];
    if (preg_match("/[^A-Za-z '-]/", $name)) {
        $errorMessage = "Please enter valid name!";
        array_push($errors, $errorMessage);

    }

    $birthDate = $_POST['birthDate'];

    $then = strtotime($birthDate);
    $min = strtotime('+18 years', $then);
    if (time() < $min) {
        $errorMessage = "You need to be at least 18 years old!";
        array_push($errors, $errorMessage);
    }
}

if (count($errors) < 1) {

    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTempName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowedExt = ['jpg', 'png'];


    if (in_array($fileActualExt, $allowedExt)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {

                //upload file to directory

                $fileNameNew = uniqid('', true) . '.' . $fileActualExt;
                $fileDestination = 'uploads/' . $fileNameNew;
                move_uploaded_file($fileTempName, $fileDestination);

//                $image_base64 = base64_encode(file_get_contents($fileDestination)); can also code file with base64 to store it in JSON
//                $image = 'data:image/' . $fileActualExt . ';base64,' . $image_base64;

//                prepare data for adding to JSON file
                $user = ['fullname' => $name, 'birth_date' => $birthDate, 'image' => $fileDestination];
                $json_data = json_encode($user);

                //add data to json file
                file_put_contents('users.json', $json_data);
                header("Location: displayAll.php?uploadsucces");
            } else {
                $errorMessage = "Your image is too big!";
                array_push($errors, $errorMessage);
            }
        } else {
            $errorMessage = "There was an error uploading your image!";
            array_push($errors, $errorMessage);
        }

    } else {
        $errorMessage = "You cannot upload images of this type";
        array_push($errors, $errorMessage);
    }

}
?>

<!--display error messages-->

<div style="width: 50%;  margin: 50px auto;">
    <p <?php if (count($errors) > 0) { ?>>
        <b>Please correct the following error(s):</b>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li class="alert alert-warning"> <?php echo $error; ?></li>
        <?php endforeach;
        } ?>
    </ul>
    </p>
</div>
<?php include '_footer.php'; ?>
