<style>

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: #e0e7ff;
            min-height: 100vh;
            padding: 20px;
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
