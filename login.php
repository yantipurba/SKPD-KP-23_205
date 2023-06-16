<?php
// Data admin
$admins = [
    'dis' => 'dis123',
    'sekretaris' => 'sekretaris123',
    'kadis' => 'kadis123',
    'kabid_aptika' => 'kabidaptika123',
    'seksi_aplikasi' => 'seksiaplikasi123'
];

// Data user
$users = [
    'user1' => 'user123',
    'user2' => 'user456',
    'user3' => 'user789'
];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check admin login
    if (array_key_exists($username, $admins) && $admins[$username] === $password) {
        $role = $username;
        // Redirect to admin dashboard based on role
        if ($role === 'dis') {
            header('Location: dis_dashboard.php');
            exit();
        } elseif ($role === 'sekretaris') {
            header('Location: sekretaris_dashboard.php');
            exit();
        } elseif ($role === 'kadis') {
            header('Location: kadis_dashboard.php');
            exit();
        } elseif ($role === 'kabid_aptika') {
            header('Location: kabid_aptika_dashboard.php');
            exit();
        } elseif ($role === 'seksi_aplikasi') {
            header('Location: seksi_aplikasi_dashboard.php');
            exit();
        }
    }
    // Check user login
    elseif (array_key_exists($username, $users) && $users[$username] === $password) {
        $role = 'user';
        // Redirect to user dashboard
        header('Location: user_dashboard.php');
        exit();
    } else {
        $errorMessage = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            background-image: url("bg.png");
            background-size: cover;
            background-position: center;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        h1 {
            text-align: center;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 150px;
            height: auto;
        }

        .form-section {
            display: none;
        }

        .form-section.current {
            display: block;
        }

        .form-toggle {
            text-align: center;
            margin-top: 20px;
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.form-toggle').click(function () {
                var targetForm = $(this).data('form');
                $('.form-section').removeClass('current');
                $(targetForm).addClass('current');
            });
        });
    </script>
</head>

<body>
    <div class="container">
        <h1>Login</h1>

        <div class="logo">
            <img src="logo.jpg" alt="Logo">
        </div>

        <?php if (isset($errorMessage)) : ?>
            <div class="error-message"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <div id="user-form" class="form-section current">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Login">
                </div>
                <div class="form-toggle" data-form="#user-form">Login as User</div>
                <div class="form-toggle" data-form="#admin-form">Login as Admin</div></br>
                <div class="register-link" data-form="#user-form"><center>Don't have an account?<a href="registration.php">Register</a></p></center>
        </div>
            </form>
        </div>

        <div id="admin-form" class="form-section">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="admin-username">Username:</label>
                    <input type="text" id="admin-username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="admin-password">Password:</label>
                    <input type="password" id="admin-password" name="password" required>
             </div>
             <div class="form-group">
                    <label for="admin-role">Admin Role:</label>
                    <select id="admin-role" name="admin_role">
                        <option value="dis">DIS</option>
                        <option value="sekretaris">Sekretaris</option>
                        <option value="kadis">Kadis</option>
                        <option value="kabid_aptika">Kabid Aptika</option>
                        <option value="seksi_aplikasi">Seksi Aplikasi</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="submit" value="Login">
                </div>
                <div class="form-toggle" data-form="#user-form">Login as User</div>
                <div class="form-toggle" data-form="#admin-form">Login as Admin</div>
                
            </form>
    </div>
</body>

</html>
