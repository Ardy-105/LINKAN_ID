<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appearance - Linkan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
    overflow: hidden;
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
    height: 100vh;
}

.left-panel {
    flex: 2;
    max-height: 100vh;
    overflow-y: auto;
    padding-right: 10px;
}

.left-panel form {
    display: flex;
    flex-direction: column;
    min-height: 100%;
    gap: 20px;
    padding-bottom: 100px; /* Tambahkan ini agar tombol tidak mentok */
}


.save-button {
    align-self: center; /* Tombol di tengah */
    background: #FF9040; /* Warna fallback */
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 20px;
    transition: background-color 0.3s ease;
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

        .preview-section {
            background: #eee;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .preview-phone {
            background: white;
            border-radius: 40px;
            padding: 20px;
            width: 100%;
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
            overflow-y: auto;
        }

        .preview-banner {
            width: 100%;
            height: 120px;
            background: #ddd;
            border-radius: 10px;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .preview-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-profile {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #ddd;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .preview-profile img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            text-align: center;
        }

        .preview-bio {
            font-size: 14px;
            color: #666;
            text-align: center;
            margin-bottom: 15px;
            padding: 0 20px;
            line-height: 1.4;
        }

        .preview-social-links {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .preview-social-links a {
            color: #FF9040;
            font-size: 20px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .preview-social-links a:hover {
            opacity: 0.8;
        }

        .preview-products {
            width: 100%;
            padding: 10px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .preview-product-item {
            background: white;
            border-radius: 8px;
            padding: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
        }

        .preview-product-item:hover {
            transform: translateY(-2px);
        }

        .preview-product-image {
            width: 40px;
            height: 40px;
            background: #FFE5D3;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }

        .preview-product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-product-info {
            flex: 1;
            min-width: 0;
        }

        .preview-product-title {
            font-size: 14px;
            color: #333;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .preview-product-button {
            background: #FF9040;
            color: white;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            flex-shrink: 0;
        }

        .preview-product-button:hover {
            opacity: 0.9;
        }


        .save-button:hover {
            opacity: 0.9;
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
        .preview-name,
        .preview-bio,
        .preview-screen button {
            transition: all 0.3s ease;
        }

        .preview-social-links a {
            margin: 0 8px;
            font-size: 20px;
            color: inherit;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        @include('homeadminS.sidebar.sidebar')

        <div class="main-content">
            <div class="url-section">
                <div class="url-input-group">
                    <input type="text" class="url-input" value="My Linkan: http://localhost:8000/linkan.id/{{ Auth::user()->username }}" readonly>
                    <button class="share-button">
                        <i class="fas fa-share-alt"></i>
                    </button>
                </div>
            </div>

           <form action="{{ route('appearance.update') }}" method="POST" enctype="multipart/form-data">


                @csrf
                <div class="content-section">
                    <div class="left-panel">
                        <!-- Banner -->
                        <div class="card">
                            <h2 class="card-title">Banner</h2>
                            <div class="banner-section">
                                @if($appearance && $appearance->banner)
                                    <img src="{{ asset('storage/' . $appearance->banner) }}" alt="Banner" style="max-width: 100%; margin-bottom: 15px;" id="previewBanner">
                                @else
                                    <i class="fas fa-image"></i>
                                    <p class="banner-text">Optimize banner size 1056 x 638 px</p>
                                @endif
                                <input type="file" name="banner" id="bannerInput" style="display: none;" accept="image/*">
                                <button type="button" class="upload-button" onclick="document.getElementById('bannerInput').click()">Upload Image</button>
                            </div>
                        </div>

                        <!-- Profile -->
                        <div class="card">
                            <h2 class="card-title">Profile</h2>
                            <div class="profile-section">
                                <div class="profile-image" onclick="document.getElementById('profileImageInput').click()">
                                    @if($appearance && $appearance->profile_image)
                                        <img src="{{ asset('storage/' . $appearance->profile_image) }}" alt="Profile" id="previewProfileImage">
                                    @else
                                        <i class="fas fa-user" id="defaultProfileIcon"></i>
                                    @endif
                                </div>
                                <input type="file" name="profile_image" id="profileImageInput" style="display: none;" accept="image/*">
                                <input type="text" name="name" class="profile-name" placeholder="Your Name" value="{{ $appearance ? $appearance->name : Auth::user()->name }}" id="inputName">
                                <div class="bio-section">
                                    <textarea name="bio" placeholder="Write your bio here..." id="inputBio">{{ $appearance ? $appearance->bio : '' }}</textarea>
                                </div>
                                <!-- 🎨 Color Picker -->
<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
    <label for="colorPicker">Customize Color:</label>
    <input type="color" id="colorPicker" name="themeColor" value="{{ $appearance ? $appearance->theme_color : '#3498db' }}">

   <input type="hidden" name="theme_color" id="themeColor" value="{{ $appearance ? $appearance->theme_color : '#FF9040' }}">
</div>

                            </div>
                        </div>
<!-- Social Media Links -->
<div class="card">
    <h2 class="card-title">Social Links</h2>
    <div class="social-link-inputs">
        <input type="url" name="instagram" id="inputInstagram" placeholder="Instagram URL" value="{{ $appearance->instagram ?? '' }}">
        <input type="url" name="tiktok" id="inputTiktok" placeholder="TikTok URL" value="{{ $appearance->tiktok ?? '' }}">
        <input type="url" name="whatsapp" id="inputWhatsapp" placeholder="WhatsApp URL" value="{{ $appearance->whatsapp ?? '' }}">
    </div>
</div>
                        <!-- Theme -->
                    <div class="theme-options" id="themeOptions" style="display: flex; flex-wrap: wrap; gap: 10px;">
    @php
        $themes = ['blue ocean.png', 'city light.png', 'clasic.png', 'desert.png', 'green flower.png', 'pink candy.png', 'playstation abstract.png'];
    @endphp
    @foreach ($themes as $theme)
        <img src="{{ asset('images/previewt/' . $theme) }}"
             data-bg="{{ asset('images/background/' . $theme) }}"
             data-name="{{ $theme }}"
             class="theme-preview"
             style="width: 80px; height: 60px; object-fit: cover; cursor: pointer; border: 2px solid transparent; border-radius: 6px;">
    @endforeach
</div>
<input type="hidden" name="background_color" id="backgroundColor" value="{{ $appearance ? $appearance->background_color : '' }}">


<div style="display: flex; justify-content: center; margin-top: 20px;">
    <button type="submit" class="save-button"
        style="background-color: #FF9040">
        Save Changes
    </button>
</div>


                    </div>

                    <!-- Preview -->
                    <div class="right-panel">
                        <div class="card">
                            <h2 class="card-title">Preview</h2>
                            <div class="preview-phone">
                                <div class="preview-screen" id="previewScreen">
                                    @if($appearance && $appearance->banner)
                                        <div class="preview-banner">
                                            <img src="{{ asset('storage/' . $appearance->banner) }}" alt="Banner" id="previewPhoneBanner">
                                        </div>
                                    @endif
                                    <div class="preview-profile" id="previewPhoneProfile">
                                        @if($appearance && $appearance->profile_image)
                                            <img src="{{ asset('storage/' . $appearance->profile_image) }}" alt="Profile">
                                        @else
                                            <i class="fas fa-user"></i>
                                        @endif
                                    </div>
                                    <div class="preview-name" id="livePreviewName" style="color: {{ $appearance ? $appearance->theme_color : '#FF9040' }}">{{ $appearance ? $appearance->name : Auth::user()->name }}</div>
                                    <div class="preview-bio" id="livePreviewBio" style="color: {{ $appearance ? $appearance->theme_color : '#FF9040' }}">{{ $appearance ? $appearance->bio : '' }}</div>
                                    <div class="preview-social-links" id="livePreviewSocialLinks">
                                        @if($appearance && $appearance->instagram)
                                            <a href="{{ $appearance->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                                        @endif
                                        @if($appearance && $appearance->tiktok)
                                            <a href="{{ $appearance->tiktok }}" target="_blank"><i class="fab fa-tiktok"></i></a>
                                        @endif
                                        @if($appearance && $appearance->whatsapp)
                                            <a href="{{ $appearance->whatsapp }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                        @endif
                                    </div>
                                    @if($digitalProducts && $digitalProducts->count() > 0)
                                        <div class="preview-products">
                                            @foreach($digitalProducts as $product)
                                                <div class="preview-product-item">
                                                    <div class="preview-product-image">
                                                        @if($product->image)
                                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}">
                                                        @else
                                                            <i class="fas fa-file-alt"></i>
                                                        @endif
                                                    </div>
                                                    <div class="preview-product-info">
                                                        <div class="preview-product-title">{{ $product->title }}</div>
                                                    </div>
                                                    <button class="preview-product-button" style="background-color: {{ $appearance ? $appearance->theme_color : '#FF9040' }}">{{ $product->button_text ?? 'Beli' }}</button>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
  <script>
document.addEventListener('DOMContentLoaded', function () {
    const colorPicker = document.getElementById('colorPicker');
    const themeColorInput = document.getElementById('themeColor');
    const backgroundColorInput = document.getElementById('backgroundColor');
    const previewName = document.getElementById('livePreviewName');
    const previewBio = document.getElementById('livePreviewBio');
    const previewButtons = document.querySelectorAll('.preview-product-button');
    const previewSocialLinks = document.getElementById('livePreviewSocialLinks');
    const saveButton = document.querySelector('.save-button');
    // Terapkan background dari database saat halaman dimuat ulang
const currentBackground = "{{ $appearance ? $appearance->background_color : '' }}";
if (currentBackground) {
    const matchedTheme = document.querySelector(`.theme-preview[data-name="${currentBackground}"]`);
    if (matchedTheme) {
        const bgUrl = matchedTheme.getAttribute('data-bg');
        const previewScreen = document.getElementById('previewScreen');
        previewScreen.style.backgroundImage = `url('${bgUrl}')`;
        previewScreen.style.backgroundSize = 'cover';
        previewScreen.style.backgroundPosition = 'center';

        // Tambahkan border aktif
        matchedTheme.style.border = "2px solid #FF9040";
    }
}


    function updatePreviewColor(color) {
        previewName.style.color = color;
        previewBio.style.color = color;
        previewButtons.forEach(btn => btn.style.backgroundColor = color);
        themeColorInput.value = color;
        colorPicker.value = color;

        if (previewSocialLinks) {
            previewSocialLinks.querySelectorAll('a i').forEach(icon => {
                icon.style.color = color;
            });
        }
    }

    colorPicker.addEventListener('input', function () {
        updatePreviewColor(this.value);
    });

    updatePreviewColor(themeColorInput.value);

    // Preview banner
    document.getElementById('bannerInput').addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const img = document.getElementById('previewPhoneBanner');
            if (img) {
                img.src = event.target.result;
            } else {
                const screen = document.getElementById('previewScreen');
                const newImg = document.createElement('img');
                newImg.src = event.target.result;
                newImg.id = "previewPhoneBanner";
                newImg.style = "width: 100%; border-radius: 10px; margin-bottom: 20px;";
                screen.insertBefore(newImg, screen.firstChild);
            }
        };
        reader.readAsDataURL(e.target.files[0]);
    });

    // Preview profile image
    document.getElementById('profileImageInput').addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const previewProfile = document.getElementById('previewPhoneProfile');
            previewProfile.innerHTML = `<img src="${event.target.result}" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">`;
            document.querySelector('.profile-image').innerHTML = `<img src="${event.target.result}" alt="Profile">`;
        };
        reader.readAsDataURL(e.target.files[0]);
    });

    // Live preview name and bio
    document.getElementById('inputName').addEventListener('input', function() {
        previewName.textContent = this.value;
    });
    document.getElementById('inputBio').addEventListener('input', function() {
        previewBio.textContent = this.value;
    });

    // Live preview social links
    function updateSocialPreview() {
        const instagram = document.getElementById('inputInstagram').value;
        const tiktok = document.getElementById('inputTiktok').value;
        const whatsapp = document.getElementById('inputWhatsapp').value;

        const container = document.getElementById('livePreviewSocialLinks');
        container.innerHTML = '';

        if (instagram) {
            container.innerHTML += `<a href="${instagram}" target="_blank"><i class="fab fa-instagram"></i></a>`;
        }
        if (tiktok) {
            container.innerHTML += `<a href="${tiktok}" target="_blank"><i class="fab fa-tiktok"></i></a>`;
        }
        if (whatsapp) {
            container.innerHTML += `<a href="${whatsapp}" target="_blank"><i class="fab fa-whatsapp"></i></a>`;
        }
    }

    ['inputInstagram', 'inputTiktok', 'inputWhatsapp'].forEach(id => {
        document.getElementById(id).addEventListener('input', updateSocialPreview);
    });

    // Pilihan background tema (gambar)
    document.querySelectorAll('.theme-preview').forEach(img => {
        img.addEventListener('click', function () {
            const bgUrl = this.getAttribute('data-bg');
            const bgName = this.getAttribute('data-name');

            // Simpan nilai ke input hidden
            backgroundColorInput.value = bgName;

            // Terapkan background ke preview
            const previewScreen = document.getElementById('previewScreen');
            previewScreen.style.backgroundImage = `url('${bgUrl}')`;
            previewScreen.style.backgroundSize = 'cover';
            previewScreen.style.backgroundPosition = 'center';

            // Tambahkan border active
            document.querySelectorAll('.theme-preview').forEach(tp => {
                tp.style.border = "2px solid transparent";
            });
            this.style.border = "2px solid #FF9040";
        });
    });
});
</script>

</body>
</html>
