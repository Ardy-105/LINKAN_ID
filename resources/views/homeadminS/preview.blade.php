@php
    // Default color jika tidak ada appearance
    $themeColor = $appearance->theme_color ?? '#FF9040';
@endphp
<div class="preview-section">
    <div class="preview-header">
        <h2>Preview</h2>
    </div>
    <div class="phone-preview">
        <div class="phone-content" id="previewScreen" style="width: 100%; height: 100%; background: #f8f9fa; border-radius: 30px; padding: 20px; display: flex; flex-direction: column; align-items: center; overflow-y: auto; background-image: url('{{ $appearance && $appearance->background_color ? asset('storage/themes/backgrounds/' . $appearance->background_color) . '?v=' . time() : '' }}'); background-size: cover; background-position: center;">
            @if($appearance && $appearance->banner)
                <div class="banner-preview" style="width: 100%; height: 120px; background: #ddd; border-radius: 10px; margin-bottom: 20px; overflow: hidden;">
                    <img src="{{ asset('storage/' . $appearance->banner) }}" alt="Banner" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            @endif
            <div class="profile-circle" style="width: 80px; height: 80px; border-radius: 50%; background: #ddd; margin-bottom: 15px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                @if($appearance && $appearance->profile_image)
                    <img src="{{ asset('storage/' . $appearance->profile_image) }}" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <i class="fas fa-user"></i>
                @endif
            </div>
            <div class="preview-name" style="font-size: 18px; font-weight: 600; margin-bottom: 10px; text-align: center; color: {{ $themeColor }};">
                {{ $appearance->name ?? ($user->name ?? '') }}
            </div>
            @if($appearance && $appearance->bio)
                <div class="preview-bio" style="font-size: 14px; color: {{ $themeColor }}; text-align: center; margin-bottom: 15px; padding: 0 20px; line-height: 1.4;">{!! $appearance->bio !!}</div>
            @endif
            <div class="social-links" style="display: flex; gap: 15px; margin-bottom: 20px;">
                @if($appearance && $appearance->instagram)
                    <a href="{{ $appearance->instagram }}" target="_blank"><i class="fab fa-instagram" style="color: {{ $themeColor }}"></i></a>
                @endif
                @if($appearance && $appearance->tiktok)
                    <a href="{{ $appearance->tiktok }}" target="_blank"><i class="fab fa-tiktok" style="color: {{ $themeColor }}"></i></a>
                @endif
                @if($appearance && $appearance->whatsapp)
                    <a href="{{ $appearance->whatsapp }}" target="_blank"><i class="fab fa-whatsapp" style="color: {{ $themeColor }}"></i></a>
                @endif
            </div>
            @if($appearance && $appearance->description)
                <div class="preview-bio" style="color: {{ $themeColor }}">{{ $appearance->description }}</div>
            @endif
            @if($appearance && $appearance->link)
                <a href="{{ $appearance->link }}" class="preview-product-button" style="background-color: {{ $themeColor }}">{{ $appearance->button_text ?? 'Beli' }}</a>
            @endif
            @if($digitalProducts && $digitalProducts->count() > 0)
                <div class="preview-products" style="width: 100%; padding: 10px; display: flex; flex-direction: column; gap: 10px;">
                    @foreach($digitalProducts as $product)
                        <div class="preview-product-item" style="background: white; border-radius: 8px; padding: 10px; display: flex; align-items: center; gap: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); transition: transform 0.2s ease;">
                            <div class="preview-product-image" style="width: 40px; height: 40px; background: #FFE5D3; border-radius: 6px; display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0;">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <i class="fas fa-file-alt"></i>
                                @endif
                            </div>
                            <div class="preview-product-info" style="flex: 1; min-width: 0;">
                                <div class="preview-product-title" style="font-size: 14px; color: #333; margin-bottom: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $product->title }}</div>
                            </div>
                            @if($product->verification_status == 'approved')
                                <a href="{{ route('track.click', ['link_id' => ($user->username ?? Auth::user()->username), 'target' => $product->platform_url ?? '#']) }}" class="preview-product-button" style="background-color: {{ $themeColor }}; color: white; padding: 4px 12px; border-radius: 4px; font-size: 12px; border: none; cursor: pointer; transition: background-color 0.3s ease; flex-shrink: 0; min-width: 100px; text-align: center; height: 28px; display: flex; align-items: center; justify-content: center; text-decoration: none;" target="_blank">{{ str_replace('_', ' ', $product->button_text ?? 'Beli') }}</a>
                            @else
                                <button class="preview-product-button" disabled style="background-color: #e9ecef; color: #6c757d; cursor: not-allowed; opacity: 1;">
                                    @if($product->verification_status == 'pending')
                                        <span class="status pending">Menunggu Verifikasi</span>
                                    @else
                                        <span class="status rejected">Ditolak</span>
                                    @endif
                                </button>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div> 