<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F4F9F9;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .login-box {
            background: #FFFFFF;
            border-radius: 15px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 350px;
            border: 1px solid #D3E0EA;
        }
        .login-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-logo a {
            color: #003580;
            font-size: 28px;
            font-weight: 700;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .login-box-msg {
            text-align: center;
            margin-bottom: 20px;
            color: #666;
            font-size: 14px;
        }
        .form-control {
            border: 1px solid #D3E0EA;
            border-radius: 25px;
            padding: 10px 20px 10px 40px; /* Increased left padding for space */
            margin-bottom: 15px;
            font-size: 14px;
            width: 100%;
            box-sizing: border-box;
            position: relative;
        }
        .form-control:focus {
            outline: none;
            border-color: #548CA8;
            box-shadow: 0 0 5px rgba(84, 140, 168, 0.2);
        }
        .input-group {
            position: relative;
            margin-bottom: 15px;
        }
        .input-group i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #003580;
        }
        .custom-checkbox {
            margin-bottom: 15px;
        }
        .custom-control-label {
            padding-left: 30px;
            color: #666;
        }
        .btn-primary {
            background-color: #548CA8;
            border: none;
            border-radius: 25px;
            padding: 12px;
            width: 100%;
            font-size: 15px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #FFFFFF;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #003580;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <div class="login-box">
        <div class="login-logo">
            <a href="#">Hotel Bengkalis</a>
        </div>
        <p class="login-box-msg">Silahkan login untuk mengelola data</p>
        <form action="../../proses/user/proses_login.php" method="post">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" class="form-control" placeholder="Email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
            </div>
            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="remember">
                <label class="custom-control-label" for="remember">Ingatkan saya</label>
            </div>
            <button type="submit" class="btn btn-primary">Masuk</button>
        </form>
    </div>
</body>

</html>
