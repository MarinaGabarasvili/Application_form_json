<?php

include '_header.php';

//read from JSON file

$url = 'users.json'; // path to JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$user = json_decode($data, true); // decode the JSON


//display JSON file data
?>

    <div style="width: 50%;  margin: 50px auto;">
        <table class="table">
            <thead>
            <tr>

                <th scope="col">Full name</th>
                <th scope="col">Date of birth</th>
                <th scope="col">Image</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo $user["fullname"]; ?></td>
                <td><?php echo $user["birth_date"]; ?></td>
                <td><img src='<?php echo $user["image"] ?>' style = "height: 40px; width: 40px;"></td>
            </tr>

            </tbody>
        </table>
    </div>

<?php include '_footer.php'; ?>