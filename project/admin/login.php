<!DOCTYPE html>
<html>
<head>
    <title>Slide Navbar</title>
    <link rel="stylesheet" type="text/css" href="styles/slide_navbar_style.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
session_start();
include("config.php");

$errors = [];

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function signup($username, $password, $email, $conn) {
    try {
        $stmt = $conn->prepare("INSERT INTO users (Username, Password, Email) VALUES (:username, :password, :email)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_BCRYPT));
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return true;
    } catch(PDOException $e) {
        echo "Đã xảy ra lỗi khi đăng ký tài khoản: " . $e->getMessage();
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['signup'])) {
        $username = test_input($_POST["username"]);
        $password = test_input($_POST["password"]);
        $email = test_input($_POST["email"]);
        
        if (empty($username)) $errors[] = "Tên đăng nhập không được để trống";
        if (empty($password)) $errors[] = "Mật khẩu không được để trống";
        if (empty($email)) $errors[] = "Email không được để trống";
        
        if (empty($errors)) {
            if (signup($username, $password, $email, $conn)) {
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit;
            } else {
                $errors[] = "Đã xảy ra lỗi khi đăng ký tài khoản. Vui lòng thử lại sau.";
            }
        }
    } elseif (isset($_POST['login'])) {
        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE Email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['Password'])) {
            $_SESSION['username'] = $user['Username'];
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "Email hoặc mật khẩu không đúng.";
        }
    }
}
?>

<div class="main">  	
    <input type="checkbox" id="chk" aria-hidden="true">

    <div class="signup">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="chk" aria-hidden="true">Sign up</label>
            <input type="text" name="username" placeholder="User name" required="">
            <input type="email" name="email" placeholder="Email" required="">
            <input type="password" name="password" placeholder="Password" required="">
            <button type="submit" name="signup">Sign up</button>
        </form>
    </div>

    <div class="login">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="chk" aria-hidden="true">Login</label>
            <input type="email" name="email" placeholder="Email" required="">
            <input type="password" name="password" placeholder="Password" required="">
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</div>

<?php
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
