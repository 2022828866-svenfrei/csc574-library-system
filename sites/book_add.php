<!DOCTYPE html>
<html>

<head>
    <title>Add Book</title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css"> <!--link to mystyle.css -->
    <link rel="stylesheet" type="text/css" href="css/userstyle.css"> <!--link to userstyle.css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <style>
        fieldset {
            margin-inline-start: 2px;
            margin-inline-end: 2px;
            padding-block-start: 0.35em;
            padding-inline-start: 0.75em;
            padding-inline-end: 0.75em;
            padding-block-end: 0.625em;
            min-inline-size: min-content; 
            border: 2px solid black;
        }
    </style>
</head>

<body>
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
                        $insertSuccessful = insertBook($name, $category, $desc, $date, $place, $author, $isbn, $newImgName, $price);

                        if ($insertSuccessful) {
                            move_uploaded_file($file_tmp, $file_destination);
                            echo "Book ($name) successfully added"; // reload page with js command
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
    </script>

    <table style="width: 100%; margin-left: 0;">
        <thead>
            <tr>
                <th width="50%" style="text-align: left; padding: 10px;"><h3>Add</h3></th>
                <th width="50%" style="text-align: right; padding: 10px;"><h3>Book</h3></th>
            </tr>
        </thead>
    </table>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()" enctype="multipart/form-data">
        <fieldset>
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
                        <input id="nameInput" class="inputField" name="name" type="text" value="<?php echo $name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                    <select id="categoryInput" name="category" value="<?php echo $category; ?>">
                            <option value="General">General</option>
                            <option value="Philosophy">Philosophy</option>
                            <option value="Religion">Religion</option>
                            <option value="Social Science">Social Science</option>
                            <option value="Language">Language</option>
                            <option value="Pure Science">Pure Science</option>
                            <option value="Technology">Technology</option>
                            <option value="Art">Art</option>
                            <option value="Literature">Literature</option>
                            <option value="Geography & History">Geography & History</option>
                            </select>
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <input id="descInput" class="inputField" name="desc" type="text" value="<?php echo $desc; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Date Publish:</td>
                    <td>
                        <input id="dateInput" class="inputField" name="date" type="date" min="0" value="<?php echo $date; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Place Publish:</td>
                    <td>
                        <input id="placeInput" class="inputField" name="place" type="text" value="<?php echo $place; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Author:</td>
                    <td>
                        <input id="authorInput" class="inputField" name="author" type="text"
                            value="<?php echo $author; ?>">
                    </td>
                </tr>
                <tr>
                    <td>ISBN:</td>
                    <td>
                        <input id="isbnInput" class="inputField" name="isbn" type="text"
                            value="<?php echo $isbn; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input id="priceInput" class="inputField" name="price" type="text"
                            value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td>
                        <input id="image" class="inputField" name="image" type="file"
                            value="<?php echo $image; ?>">
                    </td>
                </tr>
            </table>
        </fieldset>  
        <br>
        <table style="width: 100%; margin: 0;">
            <tr>
                <td colspan="2" align="right">
                    <button type="submit" class="submitButton">Save</button>
                    <button type="button" onclick="history.back();">Back</button>
                </td>
            </tr>
        </table>      
    </form>
</body>

</html>