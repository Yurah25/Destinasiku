<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - DestinasiKu</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        /* CSS MURNI - TEMA TRAVELOKA */
        :root {
            --primary-blue: #1ba0e2; 
            --primary-hover: #108ccf;
            --bg-gray: #f2f3f3;
            --text-dark: #434343;
            --text-gray: #687176;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--bg-gray);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: white;
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1); 
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand-logo h1 {
            color: var(--text-dark);
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        
        .brand-logo span {
            color: var(--primary-blue);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-gray);
            font-size: 14px;
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px; 
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box; 
            transition: border-color 0.3s;
        }

        .form-input:focus {
            border-color: var(--primary-blue);
            outline: none;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-blue);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-login:hover {
            background-color: var(--primary-hover);
        }

        .error-msg {
            background-color: #ffe6e6;
            color: #d63031;
            padding: 10px;
            border-radius: 4px;
            font-size: 13px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid #ffcccc;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="brand-logo">
            <h1>Destinasi<span>Ku</span></h1>
            <p style="color: #888; font-size: 14px; margin-top: 5px;">Administrator Portal</p>
        </div>

        @if ($errors->any())
            <div class="error-msg">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-input" 
                       placeholder="Masukkan Email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-input" 
                       placeholder="********" required>
            </div>

            <button type="submit" class="btn-login">Log In</button>
        </form>
    </div>

</body>
</html>