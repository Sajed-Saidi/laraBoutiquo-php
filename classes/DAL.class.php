<?php

class DAL
{
    public $servername = "localhost";
    public $username = "root";
    public $password = "";
    public $dbname = "laraboutique";

    public function getData($sql)
    {
        // Establish a connection to the database
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check if the connection was successful
        if ($conn->connect_error) {
            // Throw an exception if there is a connection error
            throw new Exception($conn->connect_error);
        } else {
            // Execute the SQL query
            $result = $conn->query($sql);

            // Check if the query was successful
            if (!$result) {
                // Throw an exception if there is an error with the query
                throw new Exception($conn->error);
                $conn->close();
            } else {
                // Fetch all results as an associative array
                $results = $result->fetch_all(MYSQLI_ASSOC);
                // Return the results
                $conn->close();
                return $results;
            }
        }
    }

    public function execute($sql)
    {
        // Establish a connection to the database
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check if the connection was successful
        if ($conn->connect_error) {
            // Throw an exception if there is a connection error
            throw new Exception($conn->connect_error);
        } else {
            // Execute the SQL query
            $result = $conn->query($sql);

            // Check if the query was successful
            if (!$result) {
                // Throw an exception if there is an error with the query
                throw new Exception($conn->error);
                exit; // This exit is redundant because the exception will halt execution
            } else {
                // Return the ID of the last inserted row
                return $conn->insert_id;
            }
        }
    }

    public function movemultiplefiles($image, $i, $path)
    {
        $target_dir = $path;
        $target_file = $target_dir . basename($image["name"][$i]); //p1.png
        // var_dump($target_file);exit;
        $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); //png
        // var_dump($extension);exit;
        $img_name = str_replace("." . $extension, "", basename($image["name"][$i])); //p1
        // var_dump($img_name);exit;
        $count = 0;
        $image_name = $image["name"][$i];
        while (file_exists($target_file)) {
            $new_image = $img_name . "-" . $count . "." . $extension; //p1-0.png
            $image_name = $new_image;
            $target_file = $target_dir . $new_image; //uploads/p1-0.png

            $count++;
        }
        $res = move_uploaded_file($image["tmp_name"][$i], $target_file);
        return $image_name;
    }

    public function moveImage($path, $fileImage)
    {
        // Move the file and insert into the database
        $image = $fileImage['name'];

        // var_dump($extension);exit;
        $image_ext = strtolower(pathinfo($image, PATHINFO_EXTENSION)); //png
        $img_name = str_replace("." . $image_ext, "", basename($image)); //p1
        $file_name = uniqid() . time() . '.' . $image_ext;

        move_uploaded_file($fileImage['tmp_name'], $path . $file_name);

        return $file_name;
    }

    public function updateImage($path, $fileImage, $old_image)
    {
        $image = $fileImage['name'];
        $file_name = $old_image;
        if ($image  != null) {
            $file_name = $this->moveImage($path, $fileImage);
            if (file_exists($path . $old_image)) {
                unlink($path . $old_image);
            }
        }
        return $file_name;
    }

    public function ConnectionDatabase()
    {
        return new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    }

    public function data($sql, $params = array())
    {
        $conn = $this->ConnectionDatabase();
        // Check if there are parameters
        if (!empty($params)) {
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                throw new Exception($conn->error);
            }

            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);

            $result = $stmt->execute();

            if ($result === false) {
                throw new Exception($stmt->error);
            }

            $resultSet = $stmt->get_result();
            $results = $resultSet->fetch_all(MYSQLI_ASSOC);

            $stmt->close();
        } else {
            // If there are no parameters, execute the query directly
            $result = $conn->query($sql);

            if ($result === false) {
                throw new Exception($conn->error);
            }

            $results = $result->fetch_all(MYSQLI_ASSOC);
        }

        $conn->close();

        return $results;
    }
    public function validatePhoneNumber($phone)
    {
        $phone = preg_replace('/[\/ ]/', '', $phone);
        $pattern = '/^(?:\+?\d{1,3})?[ -]?\(?\d{3}\)?[ -]?[0-9]{3}[ -]?[0-9]{4}$/';
        $pattern2 = '/^\+?[1-9][0-9]{7,14}$/';

        if (preg_match($pattern, $phone) || preg_match($pattern2, $phone)) {
            return $phone;
        } else {
            return false;
        }
    }

    public function handleFileUpload($file, $path, $prefix = "cv_")
    {
        // Check if the file was uploaded without errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('File upload error');
        }

        // Allowed file extensions
        $allowedExtensions = ['pdf', 'doc', 'docx'];

        // Get file extension and validate it
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            throw new Exception('Invalid file type. Only PDF and Word documents are allowed.');
        }

        // Clean and generate the unique file name
        $fileName = pathinfo($file['name'], PATHINFO_FILENAME);
        $fileName = preg_replace('/[^a-zA-Z0-9_-]/', '', $fileName); // Clean file name
        $uniqueFileName = $prefix . uniqid() . "_" . time() . ".{$fileExtension}";

        // Define the target file path
        $targetFilePath = $path  . $uniqueFileName;

        // Move the file to the target directory
        if (!move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            throw new Exception('Failed to move uploaded file');
        }

        // Return the unique file name
        return $uniqueFileName;
    }

    public function updateFileUpload($file, $path, $existingFileName, $prefix = "cv_")
    {
        // If a new file is uploaded, handle the update
        if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
            // First, delete the old file if it exists
            if (!empty($existingFileName)) {
                $oldFilePath = $path . DIRECTORY_SEPARATOR . $existingFileName;
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Handle the new file upload
            return $this->handleFileUpload($prefix, $file, $path);
        }

        // If no new file is uploaded, return the existing file name
        return $existingFileName;
    }
}


function dd(...$vars)
{
    echo '<pre>';
    foreach ($vars as $var) {
        // Use var_dump for detailed information, or print_r for more readable output
        var_dump($var);
        // print_r($var); // Uncomment this line if you prefer print_r instead of var_dump
        echo "\n";
    }
    echo '</pre>';
    die; // Terminate the script
}
