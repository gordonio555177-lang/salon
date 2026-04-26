<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Salon Management System') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* --- Basic Page Setup --- */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 40px 20px;
        }
        
        /* --- Main Container --- */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }
        
        h1 {
            color: #2c3e50;
            margin-top: 0;
            margin-bottom: 20px;
        }
        
        /* --- Navigation --- */
        .nav-bar {
            background: #2c3e50;
            padding: 15px 0;
            margin-bottom: 30px;
            border-radius: 8px;
        }
        
        .nav-bar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 5px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        
        .nav-bar a:hover {
            background-color: #3498db;
        }
        
        /* --- Form Styling --- */
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }
        
        .form-group input, 
        .form-group select, 
        .form-group textarea {
            width: 100%;
            max-width: 400px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        
        .form-group textarea {
            max-width: 600px;
            min-height: 80px;
        }
        
        .btn-submit, .btn-update {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-submit:hover, .btn-update:hover {
            background-color: #2980b9;
        }
        
        .btn-back {
            background-color: #767879;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-back:hover {
            background-color: #5a5c5d;
        }
        
        .btn-danger {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .btn-success {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        
        hr {
            border: 0;
            height: 1px;
            background: #eaeaea;
            margin: 30px 0;
        }
        
        /* --- Table Styling --- */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .data-table th,
        .data-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        
        .data-table th {
            background-color: #f8f9fa;
            color: #333;
            font-weight: 600;
        }
        
        .data-table tbody tr:hover {
            background-color: #f1f5f9;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }
        
        .badge-paid {
            background-color: #27ae60;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
        }
        
        .badge-unpaid {
            background-color: #e74c3c;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="nav-bar">
        <div class="container" style="background: transparent; box-shadow: none; padding: 0;">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('services.index') }}">Services</a>
            <a href="{{ route('appointments.index') }}">Appointments</a>
            <a href="{{ route('payments.index') }}">Payments</a>
            <a href="{{ route('payments.history') }}">Payment History</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: white; padding: 10px 20px; cursor: pointer;">Logout</button>
            </form>
        </div>
    </div>
    
    <div class="container">
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif
        
        @yield('content')
    </div>
</body>
</html>