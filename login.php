<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập & Đăng Ký - VitaMeds</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/Login.css">
    
</head>
<body>
    <div class="auth-container">
        <!-- Back to home button -->
        <a href="index.php" class="back-home">
            <i class="fas fa-home"></i>
            Về trang chủ
        </a>

        <!-- Left side - Auth Info -->
        <div class="auth-info">
            <div class="logo-container">
                <div class="logo-img">
                    <a href="index.php"><img src="./images/medical-care-logo-illustration-vector.jpg" alt="VitaMeds Logo"></a>
                </div>
                <div class="logo-text">VitaMeds</div>
            </div>
            
            <div class="info-content">
                <h2 id="info-title">Chào mừng trở lại!</h2>
                <p id="info-description">Đăng nhập để tiếp tục mua sắm và quản lý đơn hàng của bạn.</p>
                <button class="switch-btn" id="switch-btn" onclick="toggleAuthForm()">Đăng ký ngay</button>
            </div>
        </div>

        <!-- Right side - Auth Forms -->
        <div class="auth-form-container">
            <!-- Login Form -->
            <div class="auth-form active" id="login-form">
                <div class="form-title">
                    <h2>Đăng Nhập</h2>
                    <p>Nhập thông tin để truy cập tài khoản</p>
                </div>

                <div class="error-message" id="login-error"></div>
                <div class="success-message" id="login-success"></div>

                <form id="loginForm" onsubmit="handleLogin(event)">
                    <div class="form-group">
                        <label for="login-email">Email hoặc Tên đăng nhập</label>
                        <input type="text" id="login-email" name="email" required>
                        <i class="fas fa-user"></i>
                    </div>

                    <div class="form-group">
                        <label for="login-password">Mật khẩu</label>
                        <input type="password" id="login-password" name="password" required>
                        <i class="fas fa-eye-slash" onclick="togglePassword('login-password', this)"></i>
                    </div>

                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember">
                            Ghi nhớ đăng nhập
                        </label>
                        <a href="#" class="forgot-password">Quên mật khẩu?</a>
                    </div>

                    <button type="submit" class="submit-btn">
                        <span class="loading"></span>
                        Đăng Nhập
                    </button>
                </form>

                <div class="auth-switch">
                    Chưa có tài khoản? <a onclick="toggleAuthForm()">Đăng ký ngay</a>
                </div>
            </div>

            <!-- Register Form -->
            <div class="auth-form" id="register-form">
                <div class="form-title">
                    <h2>Đăng Ký</h2>
                    <p>Tạo tài khoản mới để bắt đầu mua sắm</p>
                </div>

                <div class="error-message" id="register-error"></div>
                <div class="success-message" id="register-success"></div>

                <form id="registerForm" onsubmit="handleRegister(event)">
                    <div class="form-group">
                        <label for="register-fullname">Họ và tên</label>
                        <input type="text" id="register-fullname" name="fullname" required>
                        <i class="fas fa-user"></i>
                    </div>

                    <div class="form-group">
                        <label for="register-email">Email</label>
                        <input type="email" id="register-email" name="email" required>
                        <i class="fas fa-envelope"></i>
                    </div>

                    <div class="form-group">
                        <label for="register-phone">Số điện thoại</label>
                        <input type="tel" id="register-phone" name="phone" required>
                        <i class="fas fa-phone"></i>
                    </div>

                    <div class="form-group">
                        <label for="register-password">Mật khẩu</label>
                        <input type="password" id="register-password" name="password" required minlength="6">
                        <i class="fas fa-eye-slash" onclick="togglePassword('register-password', this)"></i>
                    </div>

                    <div class="form-group">
                        <label for="register-confirm-password">Xác nhận mật khẩu</label>
                        <input type="password" id="register-confirm-password" name="confirm_password" required>
                        <i class="fas fa-eye-slash" onclick="togglePassword('register-confirm-password', this)"></i>
                    </div>

                    

                    <button type="submit" class="submit-btn">
                        <span class="loading"></span>
                        Đăng Ký
                    </button>
                </form>

                <div class="auth-switch">
                    Đã có tài khoản? <a onclick="toggleAuthForm()">Đăng nhập ngay</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        let isLoginForm = true;

        function toggleAuthForm() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const infoTitle = document.getElementById('info-title');
            const infoDescription = document.getElementById('info-description');
            const switchBtn = document.getElementById('switch-btn');

            if (isLoginForm) {
                // Switch to register
                loginForm.classList.remove('active');
                registerForm.classList.add('active');
                infoTitle.textContent = 'Xin chào!';
                infoDescription.textContent = 'Đăng ký tài khoản để trải nghiệm dịch vụ tuyệt vời của chúng tôi.';
                switchBtn.textContent = 'Đăng nhập';
                isLoginForm = false;
            } else {
                // Switch to login
                registerForm.classList.remove('active');
                loginForm.classList.add('active');
                infoTitle.textContent = 'Chào mừng trở lại!';
                infoDescription.textContent = 'Đăng nhập để tiếp tục mua sắm và quản lý đơn hàng của bạn.';
                switchBtn.textContent = 'Đăng ký ngay';
                isLoginForm = true;
            }

            // Clear all error/success messages
            document.getElementById('login-error').style.display = 'none';
            document.getElementById('login-success').style.display = 'none';
            document.getElementById('register-error').style.display = 'none';
            document.getElementById('register-success').style.display = 'none';
        }

        function togglePassword(inputId, icon) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }

        function showMessage(messageId, text, isError = true) {
            const messageElement = document.getElementById(messageId);
            messageElement.textContent = text;
            messageElement.style.display = 'block';
            
            // Hide message after 5 seconds
            setTimeout(() => {
                messageElement.style.display = 'none';
            }, 5000);
        }

        function handleLogin(event) {
            event.preventDefault();
            
            const submitBtn = event.target.querySelector('.submit-btn');
            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;

            // Add loading state
            submitBtn.classList.add('loading');

            // Simulate API call
            setTimeout(() => {
                submitBtn.classList.remove('loading');
                
                // Simple validation demo
                if (email === 'admin@vitameds.com' && password === '123456') {
                    showMessage('login-success', 'Đăng nhập thành công! Đang chuyển hướng...', false);
                    setTimeout(() => {
                        window.location.href = 'index.html'; // Redirect to homepage
                    }, 2000);
                } else {
                    showMessage('login-error', 'Email hoặc mật khẩu không chính xác!');
                }
            }, 2000);
        }

        function handleRegister(event) {
            event.preventDefault();
            
            const submitBtn = event.target.querySelector('.submit-btn');
            const password = document.getElementById('register-password').value;
            const confirmPassword = document.getElementById('register-confirm-password').value;
            const email = document.getElementById('register-email').value;
            const phone = document.getElementById('register-phone').value;

            // Validation
            if (password !== confirmPassword) {
                showMessage('register-error', 'Mật khẩu xác nhận không khớp!');
                return;
            }

            if (password.length < 6) {
                showMessage('register-error', 'Mật khẩu phải có ít nhất 6 ký tự!');
                return;
            }

            // Add loading state
            submitBtn.classList.add('loading');

            // Simulate API call
            setTimeout(() => {
                submitBtn.classList.remove('loading');
                showMessage('register-success', 'Đăng ký thành công! Vui lòng kiểm tra email để xác thực tài khoản.', false);
                
                // Auto switch to login form after successful registration
                setTimeout(() => {
                    toggleAuthForm();
                }, 3000);
            }, 2000);
        }

        // Auto-fill demo credentials (for testing)
        document.addEventListener('DOMContentLoaded', function() {
            // Add demo hint
            const loginEmail = document.getElementById('login-email');
            loginEmail.placeholder = 'Demo: admin@vitameds.com';
            
            const loginPassword = document.getElementById('login-password');
            loginPassword.placeholder = 'Demo: 123456';
        });
    </script>
</body>
</html>