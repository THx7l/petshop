<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PetShop - Seu melhor amigo merece o melhor cuidado')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: #000;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .logo-small {
            height: 40px;
            width: auto;
        }

        .user-actions {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-logout {
            background-color: #be1717ff;
            color: white;
        }

        .btn-list {
            background-color:#727272ff;
            color: white;
        }

        .btn-edit {
            background-color: #3498db;
            color: white;
        }

        .btn-delete {
            background-color: #95a5a6;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        /* WELCOME SECTION */
        .welcome-section {
            text-align: center;
            padding: 60px 0;
            background-color: #ecf0f1;
            margin-bottom: 40px;
            border-radius: 8px;
        }

        .welcome-section h1 {
            font-size: 42px;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .welcome-section p {
            font-size: 18px;
            max-width: 600px;
            margin: 0 auto;
            color: #7f8c8d;
        }

        .actions-section {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 60px;
        }

        .action-card {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            width: 300px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .action-card:hover {
            transform: translateY(-5px);
        }

        .action-card h3 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .action-card p {
            color: #7f8c8d;
            margin-bottom: 20px;
        }

        .btn-action {
            background-color: #2ecc71;
            color: white;
            padding: 12px 25px;
            font-size: 16px;
        }

        .container-login {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background-color: #e6f2ff;
        }

        .login-box {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 900px;
            overflow: hidden;
        }

        .login-image {
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .logo-large {
            max-width: 100%;
            max-height: 500px;
        }

        footer {
            text-align: center;
            padding: 20px 0;
            margin-top: auto;
            border-top: 1px solid #ddd;
            color: #7f8c8d;
            background-color: #fff;
        }

        /* MODAL STYLES */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            border-radius: 8px;
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            animation: modalFadeIn 0.3s;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            margin: 0;
            color: #2c3e50;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #7f8c8d;
        }

        .modal-body {
            padding: 20px;
        }

        .account-list {
            list-style: none;
            padding: 0;
        }

        .account-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .account-item:last-child {
            border-bottom: none;
        }

        .account-info h3 {
            margin: 0 0 5px 0;
            color: #2c3e50;
        }

        .account-info p {
            margin: 0;
            color: #7f8c8d;
        }

        .account-actions {
            display: flex;
            gap: 10px;
        }

        .btn-small {
            padding: 5px 10px;
            font-size: 12px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .actions-section {
                flex-direction: column;
                align-items: center;
            }

            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .user-actions {
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
            }
            
            .login-image {
                padding: 20px;
            }
            
            .logo-large {
                max-height: 200px;
            }
            
            .account-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .account-actions {
                width: 100%;
                justify-content: flex-end;
            }
        }
    </style>
    
    @yield('styles')
</head>

<body class="@yield('body-class', 'bg-light')">
    @hasSection('navbar')
        @yield('navbar')
    @else
        <nav class="navbar">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo PetShop" class="logo-small">
            <div class="user-actions">
                @yield('navbar-actions')
            </div>
        </nav>
    @endif

    <main class="@yield('main-class', 'container')">
        @yield('content')
    </main>

    @hasSection('footer')
        @yield('footer')
    @else
        <footer>
            <div class="container">
                <p>Â© 2025 Gerenciador de Petshop</p>
            </div>
        </footer>
    @endif

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
</body>
</html>