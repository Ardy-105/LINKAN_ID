<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f6fa;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .header {
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #333;
        }

        .account-detail, .delete-account {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .account-detail h2, .delete-account h2 {
            font-size: 18px;
            color: #333;
            margin-bottom: 15px;
        }

        .account-detail input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .delete-account button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-account button:hover {
            background-color: #e60000;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .form-group span {
            font-size: 12px;
            color: #999;
        }
        .btn-save {
    background-color: #FF9040; /* Warna oranye */
    color: white; /* Warna font putih */
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    display: block; /* Pastikan tombol berada di baris baru */
    margin-left: auto; /* Geser tombol ke kanan */
    margin-top: 20px; /* Tambahkan jarak dari elemen sebelumnya */
}

.btn-save:hover {
    background-color: #e67e22; /* Warna oranye lebih gelap saat hover */
}
    </style>
</head>
<body>
    
    <div class="container">
        @include('homeadminS.sidebar.sidebar')

        <div class="main-content">
            <div class="header">
                <h1>Account Settings</h1>
            </div>

            <div class="account-detail">
                <h2>Account Detail</h2>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" value="Budi" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" value="Budi@gmail.com" readonly>
                </div>
                <div class="form-group">
                    <label for="name">Name :</label>
                    <input type="text" id="name" value="Budi" readonly>
                </div>    
                <div class="form-group">
                    <label for="Password">Password :</label>
                    <input type="text" id="Password" value="Budi123" readonly>
                </div> 
                <div class="form-group">
                     <button class="btn-save">Save</button>
                </div>         
            </div>

            <div class="delete-account">
                <h2>Delete Account</h2>
                <p>Click the button below if you want to delete your account</p>
                <button>Delete Account</button>
            </div>
        </div>
    </div>
</body>
</html> 