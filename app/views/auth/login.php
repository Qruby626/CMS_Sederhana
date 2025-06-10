<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - CMS Sederhana</title>
    <link rel="stylesheet" href="/CMS_Sederhana/public/assets/plugins/fontawesome-free/css/all.min.css?v=<?= time() ?>">
    <link rel="stylesheet" href="/CMS_Sederhana/public/assets/plugins/bootstrap/css/bootstrap.min.css?v=<?= time() ?>">
    <link rel="stylesheet" href="/CMS_Sederhana/public/assets/css/adminlte.min.css?v=<?= time() ?>">
    <!-- Tambahkan Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #ff6b00;
            --primary-light: #ff8533;
            --primary-dark: #cc5500;
            --text-color: #2c3e50;
            --text-light: #666;
            --white: #ffffff;
            --input-bg: #f8f9fa;
            --input-border: #e9ecef;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body.login-page {
            background: linear-gradient(135deg, #ff6b00 0%, #ff8533 100%);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-box {
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
            border-radius: 20px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            width: 400px;
            max-width: 100%;
        }

        .login-card-body {
            padding: 2.5rem;
        }

        .login-logo {
            padding: 1.5rem 0;
            text-align: center;
        }

        .login-logo a {
            color: var(--text-color);
            font-size: 1.75rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            letter-spacing: -0.5px;
        }

        .login-logo a:hover {
            color: var(--primary-color);
        }

        .login-box-msg {
            font-size: 1rem;
            color: var(--text-light);
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: 500;
        }

        /* Input Group Styling */
        .input-group {
            position: relative;
            margin-bottom: 1.25rem;
        }

        .form-control {
            width: 100%;
            height: 48px;
            padding: 0.75rem 1rem;
            padding-right: 3rem;
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text-color);
            background-color: var(--input-bg);
            border: 2px solid var(--input-border);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            background-color: var(--white);
            box-shadow: 0 0 0 4px rgba(255, 107, 0, 0.1);
            outline: none;
        }

        .input-group-append {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            display: flex;
            align-items: center;
            padding-right: 1rem;
            pointer-events: none;
        }

        .input-group-text {
            background: transparent;
            border: none;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .input-group-text i {
            color: var(--primary-color);
            font-size: 1rem;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Button Styling */
        .btn-primary {
            width: 100%;
            height: 48px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            border: none;
            border-radius: 12px;
            color: var(--white);
            font-size: 0.95rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 0, 0.4);
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-color) 100%);
        }

        .btn-primary i {
            font-size: 1rem;
        }

        /* Alert Styling */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-danger {
            background-color: #fff5f5;
            color: #e53e3e;
            border-left: 4px solid #e53e3e;
        }

        .alert i {
            font-size: 1rem;
        }

        /* Placeholder Styling */
        ::placeholder {
            color: #a0a0a0;
            font-weight: 400;
            font-size: 0.95rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 480px) {
            .login-box {
                width: 100%;
            }
            .login-card-body {
                padding: 2rem 1.5rem;
            }
            .login-logo a {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>CMS</b> Sederhana</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <span><?= $error ?></span>
                    </div>
                <?php endif; ?>
                <form action="/login" method="post">
                    <div class="input-group">
                        <input type="text" 
                               name="username" 
                               class="form-control" 
                               placeholder="Username" 
                               value="<?= $username ?? '' ?>" 
                               required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="password" 
                               name="password" 
                               class="form-control" 
                               placeholder="Password" 
                               required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Sign In</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="/CMS_Sederhana/public/assets/plugins/jquery/jquery.min.js?v=<?= time() ?>"></script>
    <script src="/CMS_Sederhana/public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js?v=<?= time() ?>"></script>
    <script src="/CMS_Sederhana/public/assets/js/adminlte.min.js?v=<?= time() ?>"></script>
</body>
</html>