<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Linkan</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #ffffff;
            background-image: url('{{ asset('images/background.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('images/background.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.1;
            z-index: 0;
            pointer-events: none;
        }

        .container {
            display: flex;
            width: 100%;
            max-width: 1440px;
            margin: auto;
            align-items: center;
            justify-content: space-between;
            padding: 0 80px;
            position: relative;
            z-index: 2;
        }

        .left-side {
            flex: 0 0 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .floating-animation {
            width: 100%;
            max-width: 500px;
            animation: floating 3s ease-in-out infinite;
        }

        .register-container {
            flex: 0 0 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 0;
        }

        .register-box {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .register-box h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 14px 18px;
            border: 1px solid #e1e1e1;
            border-radius: 14px;
            font-size: 15px;
            background-color: #fff;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .form-group input:focus {
            outline: none;
            border-color: #FF7F50;
            box-shadow: 0 0 0 4px rgba(255, 127, 80, 0.1);
        }

        .form-group input::placeholder {
            color: #999;
        }

        .btn-register {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #FF7F50, #ff6b3b);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 28px;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #ff6b3b, #FF7F50);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 127, 80, 0.3);
        }

        .login-link {
            text-align: center;
            font-size: 14px;
            color: #666;
        }

        .login-link a {
            color: #FF7F50;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 6px;
        }

        @media (max-width: 1200px) {
            .container {
                padding: 0 40px;
            }
            
            .left-side {
                flex: 0 0 40%;
            }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                padding: 20px;
            }

            .left-side {
                display: none;
            }

            .register-container {
                flex: 0 0 100%;
            }

            .register-box {
                padding: 30px 20px;
            }
        }

        @keyframes floating {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0px);
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Linkan Logo" id="logo">
        </div>
    </nav>
    <div class="container">
        <div class="left-side">
            <img src="{{ asset('images/logohp.png') }}" alt="Register Illustration" class="floating-animation">
        </div>
        
        <div class="register-container">
            <div class="register-box">
                <h2>Create your account</h2>
                
                @if(session('error'))
                    <div class="error-message" style="margin-bottom: 20px;">
                        {{ session('error') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('register.submit') }}">
                    @csrf
                    @if(isset($googleData))
                        <input type="hidden" name="google_id" value="{{ $googleData['google_id'] }}">
                    @endif

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your full name" value="{{ $googleData['name'] ?? old('name') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Choose your username" value="{{ old('username') }}" required>
                        <small style="color: #666; font-size: 12px;">This will be your link: linkan.id/username</small>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Example@gmail.com" value="{{ $googleData['email'] ?? old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                    </div>

                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror

                    @error('username')
                        <div class="error-message">{{ $message }}</div>
                    @enderror

                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror

                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn-register">Create Account</button>
                </form>

                <div class="login-link">
                    Already have an account? <a href="{{ route('login') }}">Sign in</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 