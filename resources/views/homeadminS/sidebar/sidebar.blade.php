<style>

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: #e0e7ff;
            min-height: 100vh;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .sidebar-main {
            flex: 1;
        }

        .sidebar-footer {
            margin-top: auto;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            padding-top: 15px;
        }

        .logout-button {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #e3342f;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            transition: 0.3s;
        }

        .logout-button:hover {
            background-color: #fee2e2;
        }

        .logout-button i {
            margin-right: 10px;
            width: 20px;
        }

        .sidebar .logo {
            width: 120px;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #1a1a1a;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #d1d9ff;
        }

        .sidebar a i {
            margin-right: 10px;
            width: 20px;
        }

</style>
<div class="sidebar">
    <img src="{{ asset('images/logo.png') }}" alt="Linkan Logo" class="logo">

    <div class="sidebar-main">
        <a href="{{ route('beranda.admins') }}"><i class="fas fa-home"></i>Home</a>
        <a href="{{ route('mylinkan') }}"><i class="fas fa-user"></i>My Linkan</a>
        <a href="#"><i class="fas fa-paint-brush"></i>Appearance</a>
        <a href="#"><i class="fas fa-chart-bar"></i>Statistic</a>
        <a href="#"><i class="fas fa-shopping-cart"></i>Orders</a>
        <a href="#"><i class="fas fa-box"></i>My Purchase</a>
        <a href="#"><i class="fas fa-cog"></i>Settings</a>
        <a href="#"><i class="fas fa-users"></i>Affiliates</a>

        <div class="marketing-tools">
            <h3>MARKETING TOOLS</h3>
            <a href="#"><i class="fas fa-envelope"></i>E-Mail Marketing</a>
            <a href="#"><i class="fab fa-whatsapp"></i>WhatsApp</a>
            <a href="#"><i class="fas fa-ticket-alt"></i>Vouchers</a>
        </div>
    </div>

    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-button">
                <i class="fas fa-sign-out-alt"></i>Logout
            </button>
        </form>
    </div>
</div>
