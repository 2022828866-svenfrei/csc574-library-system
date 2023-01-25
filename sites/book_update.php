<!DOCTYPE html>
<html>

<head>
    <title>Add Book</title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css"> <!--link to mystyle.css -->
    <link rel="stylesheet" type="text/css" href="css/userstyle.css"> <!--link to userstyle.css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>

<body>
    <script>
        function reloadAsGet(id, msg) {
            var loc = window.location;
            window.location = loc.protocol + '//' + loc.host + loc.pathname + '?ID=' + id;
            alert(msg);
        }
    </script>

    <?php
    require("repositories/library-repository.php");
    require("repositories/cookie-repository.php");

    $errorMessage = "";

    $name = "";
    $category = "";
    $desc = "";
    $date = "";
    $place = "";
    $author = "";
    $isbn = "";
    $image = "";
    $price = "";

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET['ID'];

        try {
            $book = getBookDetail($id);
        } catch (Exception $ex) {
            $errorMessage += "<br>Issue fetching borrowing data!";
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        $status = 'error'; 
        if(!empty($_FILES["image"]["name"])) { 
            // Get file info 
            $fileName = basename($_FILES["image"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
             
            // Allow certain file formats 
            $allowTypes = array('jpg','png','jpeg','gif'); 
            // Check file size
            if ($_FILES["image"]["size"] < 500000) {
                if(in_array($fileType, $allowTypes)){ 
                    $id = $_POST["id"];
                    $name = $_POST["name"];
                    $category = $_POST["category"];
                    $desc = $_POST["desc"];
                    $date = $_POST["date"];
                    $place = $_POST["place"];
                    $author = $_POST["author"];
                    $isbn = $_POST["isbn"];
                    $price = $_POST["price"];
                    $file_tmp = $_FILES['image']['tmp_name'];
                    $newImgName = $name .".".$fileType;     
                    $file_destination = 'images/uploads/' . $newImgName;


                    try {
                    // Insert image content into database 
                        $updateSuccessful = updateBook($name, $category, $desc, $date, $place, $author, $isbn, $newImgName, $price);

                        if ($updateSuccessful) {
                            move_uploaded_file($file_tmp, $file_destination);
                            echo "<script>reloadAsGet(" . $id . ", 'Book (" .  $name . ") successfully updated');</script>"; // reload page with js command with GET request
                            echo "Book ($name) successfully updated"; // reload page with js command
                        } else {
                            $errorMessage = "The insert was unsuccesful, please try again.";
                        }
                    } catch (Exception $ex) {
                        $errorMessage = $ex->getMessage();
                    }
                }else{ 
                    $errorMessage = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
                }
            } else {
                $errorMessage = 'Sorry, your image is too large.';
            }
        }else{ 
            $errorMessage = 'Please select an image file to upload.'; 
        } 
    }    
    ?>

    <script>
        function validateForm() {
            let isInputValid = true;

            isInputValid = validateInputField(document.getElementById("nameInput")) && isInputValid;
            isInputValid = validateInputField(document.getElementById("categoryInput")) && isInputValid;
            isInputValid = validateInputField(document.getElementById("descInput")) && isInputValid;
            isInputValid = validateInputField(document.getElementById("dateInput")) && isInputValid;
            isInputValid = validateInputField(document.getElementById("placeInput")) && isInputValid;
            isInputValid = validateInputField(document.getElementById("authorInput")) && isInputValid;
            isInputValid = validateInputField(document.getElementById("isbnInput")) && isInputValid;
            isInputValid = validateInputField(document.getElementById("priceInput")) && isInputValid;

            return isInputValid;
        }

        function validateInputField(field) {
            if (field.value == "") {
                field.className = "errorInput";
                return false;
            }
            else {
                field.className = "";
                return true;
            }
        }

        console.log(window.location);
    </script>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()" enctype="multipart/form-data">
        <table>
            <tr>
                <td colspan="2">
                    <p class="errorMessage">
                        <?php echo $errorMessage; ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td>Book Name:</td>
                <td>
                    <input id="id" name="id" type="hidden" value="<?php echo $book["ID"]; ?>">
                    <input id="nameInput" class="inputField" name="name" type="text" value="<?php echo $book["Name"]; ?>">
                </td>
            </tr>
            <tr>
                <td>Category:</td>
                <td>
                    <input id="categoryInput" class="inputField" name="category" type="test" value="<?php echo $book["Category"]; ?>">
                </td>
            </tr>
            <tr>
                <td>Description:</td>
                <td>
                    <input id="descInput" class="inputField" name="desc" type="text" value="<?php echo $book["Description"]; ?>">
                </td>
            </tr>
            <tr>
                <td>Date Publish:</td>
                <td>
                    <input id="dateInput" class="inputField" name="date" type="date" min="0" value="<?php echo strftime('%Y-%m-%d', strtotime($book["PublishDate"])); ?>">
                </td>
            </tr>
            <tr>
                <td>Place Publish:</td>
                <td>
                    <input id="placeInput" class="inputField" name="place" type="text" value="<?php echo $book["PublishPlace"]; ?>">
                </td>
            </tr>
            <tr>
                <td>Author:</td>
                <td>
                    <input id="authorInput" class="inputField" name="author" type="text" value="<?php echo $book["Author"]; ?>">
                </td>
            </tr>
            <tr>
                <td>ISBN:</td>
                <td>
                    <input id="isbnInput" class="inputField" name="isbn" type="text" value="<?php echo $book["ISBNNumber"]; ?>">
                </td>
            </tr>
            <tr>
                <td>Price:</td>
                <td>
                    <input id="priceInput" class="inputField" name="price" type="text" value="<?php echo $book["Price"]; ?>">
                </td>
            </tr>
            <tr>
                <td>Image:</td>
                <td>
                    <input id="image" class="inputField" name="image" type="file" value="<?php echo $book["Image"]; ?>">
                </td>
            </tr>
        </table>
        <button type="submit" class="submitButton">Save</button>
        <button type="button" onclick="history.back();">Back</button>
    </form>
</body>

</html>