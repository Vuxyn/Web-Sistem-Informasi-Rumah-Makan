<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .profile-container {
            background: #fff;
            width: 400px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid #ddd;
        }

        .username {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .bio {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }

        .info {
            text-align: left;
            margin-top: 15px;
        }

        .info p {
            margin-bottom: 10px;
            font-size: 14px;
        }

        .info p span {
            font-weight: bold;
            color: #333;
        }

        .btn-edit {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 15px;
            background: #000;
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            border-radius: 5px;
        }

        .btn-edit:hover {
            background: #444;
        }
    </style>

</head>

<body>

     <div class="profile-container">
        <img src="https://via.placeholder.com/120" alt="Foto Pengguna" class="profile-img">
        <div class="username">Nama Pengguna</div>
        <div class="bio">Halo! Saya adalah pengguna yang suka belajar pemrograman dan teknologi.</div>
        
        <div class="info">
            <p><span>Nama Lengkap:</span> Fahmi Alfahma</p>
            <p><span>Alamat:</span> Jl. Merdeka No. 123, Jakarta</p>
            <p><span>Email:</span> fahmi@example.com</p>
            <p><span>Nomor Telepon:</span> +62 812 3456 7890</p>
        </div>

        <a href="#" class="btn-edit">Edit Profil</a>
    </div>
    
</body>
</html>