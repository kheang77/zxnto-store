<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        
        .login-container {
            display: flex;
            width: 900px;
            height: 550px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
        }
        
        .login-left {
            flex: 1;
            background: linear-gradient(to bottom right, #2c3e50, #1a1a2e);
            color: white;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .login-right {
            flex: 1.2;
            background-color: white;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .logo-icon {
            background-color: #3498db;
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        
        .logo-text {
            font-size: 28px;
            font-weight: 700;
        }
        
        .login-title {
            font-size: 32px;
            margin-bottom: 10px;
            color: #2c3e50;
        }
        
        .login-subtitle {
            color: #7f8c8d;
            margin-bottom: 40px;
            font-size: 16px;
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .form-input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 2px solid #e0e6ed;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
        }
        
        .show-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
            cursor: pointer;
        }
        
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
        }
        
        .remember-me input {
            margin-right: 8px;
        }
        
        .forgot-password {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
        }
        
        .forgot-password:hover {
            text-decoration: underline;
        }
        
        .login-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        
        .login-btn:hover {
            background-color: #2980b9;
        }
        
        .login-btn:active {
            transform: translateY(1px);
        }
        
        .welcome-title {
            font-size: 28px;
            margin-bottom: 20px;
        }
        
        .welcome-text {
            line-height: 1.6;
            margin-bottom: 30px;
            color: #bdc3c7;
        }
        
        .features {
            margin-top: 30px;
        }
        
        .feature {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .feature-icon {
            background-color: rgba(255, 255, 255, 0.1);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        
        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 25px;
            display: none;
        }
        
        .alert-error {
            background-color: #fee;
            color: #c0392b;
            border-left: 4px solid #c0392b;
        }
        
        .alert-success {
            background-color: #e8f6ef;
            color: #27ae60;
            border-left: 4px solid #27ae60;
        }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #7f8c8d;
            font-size: 14px;
        }
        
        @media (max-width: 950px) {
            .login-container {
                width: 95%;
                height: auto;
            }
        }
        
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                height: auto;
                margin: 20px;
            }
            
            .login-left, .login-right {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left side with branding and info -->
        <div class="login-left">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-shield-alt fa-2x"></i>
                </div>
                <div class="logo-text">Admin<span style="color: #3498db;">Panel</span></div>
            </div>
            
            <h2 class="welcome-title">Welcome Back</h2>
            <p class="welcome-text">Sign in to access the admin dashboard where you can manage users, content, settings, and view analytics for your platform.</p>
            
            <div class="features">
                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>Manage users and permissions</div>
                </div>
                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div>View analytics and reports</div>
                </div>
                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div>Configure system settings</div>
                </div>
            </div>
        </div>
        
        <!-- Right side with login form -->
        <div class="login-right">
            <h1 class="login-title">Admin Login</h1>
            <p class="login-subtitle">Please enter your credentials to access the admin dashboard</p>
            
            <!-- Alert message for login errors/success -->
            <div class="alert alert-error" id="errorAlert">
                <i class="fas fa-exclamation-circle"></i> Invalid username or password. Please try again.
            </div>
            
            <div class="alert alert-success" id="successAlert">
                <i class="fas fa-check-circle"></i> Login successful! Redirecting...
            </div>
            
            <!-- Login form -->
            <form id="loginForm">
                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <div class="input-with-icon">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" id="username" class="form-input" placeholder="Enter admin username" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password" class="form-input" placeholder="Enter your password" required>
                        <i class="fas fa-eye show-password" id="togglePassword"></i>
                    </div>
                </div>
                
                <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" id="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>
                
                <button type="submit" class="login-btn" id="loginButton">
                    <i class="fas fa-sign-in-alt"></i> Login to Dashboard
                </button>
            </form>
            
            <div class="footer">
                <p>&copy; 2023 AdminPanel. All rights reserved. | <i class="fas fa-lock"></i> Secure Login</p>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
        
        // Handle form submission
        const loginForm = document.getElementById('loginForm');
        const errorAlert = document.getElementById('errorAlert');
        const successAlert = document.getElementById('successAlert');
        const loginButton = document.getElementById('loginButton');
        
        // Default admin credentials (for demo purposes only)
        const adminUsername = "Vibol";
        const adminPassword = "Vibol10";
        
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const rememberMe = document.getElementById('remember').checked;
            
            // Hide any previous alerts
            errorAlert.style.display = 'none';
            successAlert.style.display = 'none';
            
            // Simple validation
            if (!username || !password) {
                showError("Please enter both username and password.");
                return;
            }
            
            // Show loading state on button
            const originalText = loginButton.innerHTML;
            loginButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Authenticating...';
            loginButton.disabled = true;
            
            // Simulate authentication process with timeout
            setTimeout(() => {
                // Check credentials (in a real app, this would be done server-side)
                if (username === adminUsername && password === adminPassword) {
                    showSuccess("Login successful! Redirecting to admin dashboard...");
                    
                    // In a real application, you would redirect to the admin dashboard
                    // window.location.href = "dashboard.html";
                    
                    // For demo, reset form after 2 seconds
                    setTimeout(() => {
                         window.location.href = "dashboard.html";
                        // loginForm.reset();
                        // loginButton.innerHTML = originalText;
                        // loginButton.disabled = false;
                        // successAlert.style.display = 'none';
                    }, 2000);
                    
                } else {
                    showError("Invalid username or password. Please try again.");
                    loginButton.innerHTML = originalText;
                    loginButton.disabled = false;
                }
            }, 1500);
        });
        
        function showError(message) {
            errorAlert.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
            errorAlert.style.display = 'block';
        }
        
        function showSuccess(message) {
            successAlert.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
            successAlert.style.display = 'block';
        }
        
        // Forgot password link
        const forgotPasswordLink = document.querySelector('.forgot-password');
        forgotPasswordLink.addEventListener('click', function(e) {
            e.preventDefault();
            alert("Password reset functionality would be implemented here. In a real application, this would send a password reset email to the admin's registered email address.");
        });
    </script>
</body>
</html>
