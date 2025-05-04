<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appearance - Linkan</title>
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

        .url-section {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .url-input-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .url-input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #f8f9fa;
            color: #666;
        }

        .share-button {
            background: none;
            border: none;
            color: #FF9040;
            cursor: pointer;
            padding: 8px;
            font-size: 16px;
        }

        .content-section {
            display: flex;
            gap: 20px;
        }

        .left-panel {
            flex: 2;
        }

        .right-panel {
            flex: 1;
            min-width: 300px;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .card-title {
            font-size: 18px;
            color: #333;
            margin-bottom: 15px;
        }

        .banner-section {
            border: 2px dashed #ddd;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            margin-bottom: 20px;
        }

        .banner-section i {
            font-size: 40px;
            color: #ddd;
            margin-bottom: 10px;
        }

        .banner-text {
            color: #666;
            margin-bottom: 15px;
        }

        .upload-button {
            background: #FF9040;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .profile-section {
            text-align: center;
            padding: 20px 0;
        }

        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #f8f9fa;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            overflow: hidden;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-image i {
            font-size: 40px;
            color: #ddd;
        }

        .profile-name {
            width: 80%;
            margin: 0 auto 10px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .bio-section textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: vertical;
            margin-top: 10px;
        }

        .preview-phone {
            background: white;
            border-radius: 40px;
            padding: 20px;
            aspect-ratio: 9/19;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .preview-screen {
            background: #f8f9fa;
            height: 100%;
            border-radius: 30px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .preview-profile {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #ddd;
            margin: 20px 0;
            overflow: hidden;
        }

        .preview-profile img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-name {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .preview-bio {
            font-size: 14px;
            color: #666;
            text-align: center;
            margin-bottom: 20px;
        }

        .save-button {
            background: #FF9040;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 20px;
        }

        .theme-options {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 10px;
            margin-top: 10px;
        }

        .theme-option {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .theme-option.active {
            border-color: #FF9040;
        }

        @media (max-width: 768px) {
            .content-section {
                flex-direction: column;
            }

            .right-panel {
                min-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        @include('homeadminS.sidebar.sidebar')

        <div class="main-content">
            <div class="url-section">
                <div class="url-input-group">
                    <input type="text" class="url-input" value="My Linkan: https://Linkan.id/{{ Auth::user()->name }}" readonly>
                    <button class="share-button">
                        <i class="fas fa-share-alt"></i>
                    </button>
                </div>
            </div>

            <form action="{{ route('appearance.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="content-section">
                    <div class="left-panel">
                        <div class="card">
                            <h2 class="card-title">Banner</h2>
                            <div class="banner-section">
                                @if($appearance && $appearance->banner)
                                    <img src="{{ asset('storage/' . $appearance->banner) }}" alt="Banner" style="max-width: 100%; margin-bottom: 15px;">
                                @else
                                    <i class="fas fa-image"></i>
                                    <p class="banner-text">Optimize banner size 1056 x 638 px</p>
                                @endif
                                <input type="file" name="banner" id="bannerInput" style="display: none;" accept="image/*">
                                <button type="button" class="upload-button" onclick="document.getElementById('bannerInput').click()">Upload Image</button>
                            </div>
                        </div>

                        <div class="card">
                            <h2 class="card-title">Profile</h2>
                            <div class="profile-section">
                                <div class="profile-image" onclick="document.getElementById('profileImageInput').click()">
                                    @if($appearance && $appearance->profile_image)
                                        <img src="{{ asset('storage/' . $appearance->profile_image) }}" alt="Profile">
                                    @else
                                        <i class="fas fa-user"></i>
                                    @endif
                                </div>
                                <input type="file" name="profile_image" id="profileImageInput" style="display: none;" accept="image/*">
                                <input type="text" name="name" class="profile-name" placeholder="Your Name" value="{{ $appearance ? $appearance->name : Auth::user()->name }}">
                                <div class="bio-section">
                                    <textarea name="bio" placeholder="Write your bio here...">{{ $appearance ? $appearance->bio : '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <h2 class="card-title">Theme</h2>
                            <div class="theme-options">
                                <div class="theme-option" data-color="#FF9040">
                                    <div style="width: 30px; height: 30px; background: #FF9040; margin: 0 auto;"></div>
                                    <span>Orange</span>
                                </div>
                                <div class="theme-option" data-color="#4CAF50">
                                    <div style="width: 30px; height: 30px; background: #4CAF50; margin: 0 auto;"></div>
                                    <span>Green</span>
                                </div>
                                <div class="theme-option" data-color="#2196F3">
                                    <div style="width: 30px; height: 30px; background: #2196F3; margin: 0 auto;"></div>
                                    <span>Blue</span>
                                </div>
                                <div class="theme-option" data-color="#9C27B0">
                                    <div style="width: 30px; height: 30px; background: #9C27B0; margin: 0 auto;"></div>
                                    <span>Purple</span>
                                </div>
                            </div>
                            <input type="hidden" name="theme_color" id="themeColor" value="{{ $appearance ? $appearance->theme_color : '#FF9040' }}">
                        </div>
                    </div>

                    <div class="right-panel">
                        <div class="card">
                            <h2 class="card-title">Preview</h2>
                            <div class="preview-phone">
                                <div class="preview-screen">
                                    @if($appearance && $appearance->banner)
                                        <img src="{{ asset('storage/' . $appearance->banner) }}" alt="Banner" style="width: 100%; border-radius: 10px; margin-bottom: 20px;">
                                    @endif
                                    <div class="preview-profile">
                                        @if($appearance && $appearance->profile_image)
                                            <img src="{{ asset('storage/' . $appearance->profile_image) }}" alt="Profile">
                                        @endif
                                    </div>
                                    <div class="preview-name">{{ $appearance ? $appearance->name : Auth::user()->name }}</div>
                                    <div class="preview-bio">{{ $appearance ? $appearance->bio : '' }}</div>
                                </div>
                            </div>
                            <button type="submit" class="save-button">Save Changes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Preview image before upload
        document.getElementById('bannerInput').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const bannerSection = document.querySelector('.banner-section');
                    bannerSection.innerHTML = `<img src="${e.target.result}" alt="Banner" style="max-width: 100%; margin-bottom: 15px;">
                    <input type="file" name="banner" id="bannerInput" style="display: none;" accept="image/*">
                    <button type="button" class="upload-button" onclick="document.getElementById('bannerInput').click()">Change Image</button>`;
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        document.getElementById('profileImageInput').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const profileImage = document.querySelector('.profile-image');
                    profileImage.innerHTML = `<img src="${e.target.result}" alt="Profile">`;
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        // Theme selection
        const themeOptions = document.querySelectorAll('.theme-option');
        const themeColorInput = document.getElementById('themeColor');

        themeOptions.forEach(option => {
            option.addEventListener('click', function() {
                themeOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
                themeColorInput.value = this.dataset.color;
            });

            if (this.dataset.color === themeColorInput.value) {
                this.classList.add('active');
            }
        });

        // Share button functionality
        document.querySelector('.share-button').addEventListener('click', function() {
            const url = document.querySelector('.url-input').value;
            navigator.clipboard.writeText(url).then(() => {
                alert('URL copied to clipboard!');
            });
        });
    </script>
</body>
</html>
