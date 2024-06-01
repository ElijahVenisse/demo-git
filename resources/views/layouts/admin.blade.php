<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 1rem;
            background-image: url('{{ asset('storage/images/psuschool2.png') }}'), linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7));
            background-blend-mode: overlay;
            background-size: cover;
            background-position: center;
            color: white;
        }
        .sidebar a {
            color: white;
            padding: 1rem;
            text-decoration: none;
            display: block;
            background-color: rgba(0, 0, 0, 0.5); /* Add a background to make the text readable */
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: rgba(87, 87, 87, 0.8);
        }
        .dropdown-btn {
            background-color: rgba(51, 51, 51, 0.8);
            color: white;
            padding: 1rem;
            border: none;
            text-align: left;
            cursor: pointer;
            outline: none;
            width: 100%;
        }
        .dropdown-btn:hover {
            background-color: rgba(87, 87, 87, 0.8);
        }
        .dropdown-container {
            display: none;
            background-color: rgba(68, 68, 68, 0.8);
            padding-left: 1.5rem;
        }
        .dropdown-container a {
            padding: 0.5rem 0;
        }
        .dropdown-container a:hover, .dropdown-container a.active {
            background-color: rgba(87, 87, 87, 0.8);
        }
        .content {
            margin-left: 250px; /* Ensure this matches the width of the sidebar */
            padding: 2rem;
            background-color: #f4f4f4;
            flex-grow: 1;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background-color: #333;
            color: white;
        }
        .header h1 {
            margin: 0;
        }
        .logout-button {
            background-color: rgba(255, 85, 85, 0.8);
            border: none;
            padding: 1rem;
            color: white;
            cursor: pointer;
            text-align: left;
            margin-top: auto;
            width: 100%;
        }
        .logout-button:hover {
            background-color: rgba(255, 68, 68, 0.8);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
        <button class="dropdown-btn {{ request()->routeIs('users.index') || request()->routeIs('admin.bsit') || request()->routeIs('admin.bsmath') ? 'active' : '' }}">Students
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container" style="{{ request()->routeIs('users.index') || request()->routeIs('admin.bsit') || request()->routeIs('admin.bsmath') ? 'display: block;' : '' }}">
            <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.index') ? 'active' : '' }}">All Students</a>
            <a href="{{ route('admin.bsit') }}" class="{{ request()->routeIs('admin.bsit') ? 'active' : '' }}">BSIT Students</a>
            <a href="{{ route('admin.bsmath') }}" class="{{ request()->routeIs('admin.bsmath') ? 'active' : '' }}">BSMATH Students</a>
        </div>
        <a href="{{ route('admin.pending_users.index') }}" class="{{ request()->routeIs('admin.pending_users.index') ? 'active' : '' }}">Pending Students</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <button class="logout-button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </button>
    </div>
    <div class="content">
        @yield('content')
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var dropdown = document.querySelector(".dropdown-btn");
            var dropdownContent = document.querySelector(".dropdown-container");

            dropdown.addEventListener("click", function() {
                dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
            });
        });
    </script>
</body>
</html>
