<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký tài khoản</title>
</head>
<body>

<?php
include("config.php");

// Function to handle user registration
function signup($username, $password, $email, $conn) {
    // Hash the password for security

    try {
        // Prepare SQL statement to insert user data into the database
        $stmt = $conn->prepare("INSERT INTO users (Username, Password, Email) VALUES (:username, :password, :email)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);

        // Execute the statement
        $stmt->execute();

        // Registration successful
        return true;
    } catch(PDOException $e) {
        // Registration failed, display error message
        echo "Đã xảy ra lỗi khi đăng ký tài khoản: " . $e->getMessage();
        return false;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $email = test_input($_POST["email"]);
    
    // Check if fields are not empty
    if (empty($username)) {
        $errors[] = "Tên đăng nhập không được để trống";
    }

    if (empty($password)) {
        $errors[] = "Mật khẩu không được để trống";
    }

    if (empty($email)) {
        $errors[] = "Email không được để trống";
    }

    // If no errors, attempt to register user
    if (empty($errors)) {
        if (signup($username, $password, $email, $conn)) {
            // Registration successful, redirect to congratulations page
            header("Location:dk.php");
            exit;
        } else {
            echo "Đã xảy ra lỗi khi đăng ký tài khoản. Vui lòng thử lại sau.";
        }
    }
}

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>Đăng ký tài khoản</h2>
<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Tên đăng nhập: <input type="text" name="username" value="<?php echo isset($username) ? $username : ''; ?>">
    <br><br>
    Mật khẩu: <input type="password" name="password" value="">
    <br><br>
    Email: <input type="text" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
    <br><br>
    <input type="submit" name="submit" value="Đăng ký">
</form>

<?php
// Display error messages
if (!empty($errors)) {
    echo "<h3>Có lỗi xảy ra:</h3>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
}
?>

</body>
</html>
