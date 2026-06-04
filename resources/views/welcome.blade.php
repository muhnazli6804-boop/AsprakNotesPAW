<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AsprakNotes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('AsprakNotes.png') }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            width: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            position: relative;
            color: white;
        }

        .fullscreen-bg {
            background: url('{{ asset('welcome.png') }}') no-repeat center center;
            background-size: cover;
            width: 100vw;
            height: 100vh;
            position: relative;
            z-index: 1;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* transparansi */
            z-index: 2;
        }

        .login-button {
            position: absolute;
            top: 20px;
            right: 30px;
            padding: 10px 20px;
            background-color: #fff;
            color: #f53003;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
            border: 2px solid #f53003;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: background-color 0.2s ease;
            z-index: 3;
        }

        .login-button:hover {
            background-color: #f53003;
            color: #fff;
        }

        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 3;
        }

        .content h1 {
            font-size: 48px;
            margin-bottom: 10px;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        }

        .content p {
            font-size: 20px;
            margin-bottom: 30px;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.4);
        }

        @media (max-width: 768px) {
            .content h1 {
                font-size: 32px;
            }
            .content p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

    <!-- Background -->
    <div class="fullscreen-bg"></div>

    <!-- Overlay hitam transparan -->
    <div class="overlay"></div>

    <!-- Button Login -->
    <a href="{{ route('login') }}" 
        class="login-button"
        style="background-color: #fff; color: #f53003; border: 2px solid #f53003; box-shadow: 0 2px 8px rgba(0,0,0,0.08);"
    >
        Login
    </a>

    <!-- Welcome Text -->
    <div class="content">
        <h1>Welcome to AsprakNotes</h1>
        <p>Platform Belajar yang Membawa Ilmu ke Genggamanmu</p>
    </div>

</body>
</html>
