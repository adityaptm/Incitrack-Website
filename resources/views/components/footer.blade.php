<footer class="footer-wrap">
    <div class="container footer-grid">
        <div class="footer-brand">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                <div class="logo-dark-container">
                    <img src="{{ asset('images/logo.png') }}" alt="INCITRACK">
                </div>
                <span class="brand-logo-text" style="color: var(--white);">INCITRACK</span>
            </div>
            <p>
                Platform pelaporan dan pemantauan insiden jalan tol nasional terintegrasi untuk mewujudkan jalan tol yang aman, tertib, dan transparan di Indonesia.
            </p>
            <div class="footer-socials">
                <a href="https://wa.me/" target="_blank" class="footer-social-link" title="WhatsApp">
                    <i class='bx bxl-whatsapp'></i>
                </a>
                <a href="https://instagram.com/" target="_blank" class="footer-social-link" title="Instagram">
                    <i class='bx bxl-instagram'></i>
                </a>
                <a href="https://facebook.com/" target="_blank" class="footer-social-link" title="Facebook">
                    <i class='bx bxl-facebook'></i>
                </a>
            </div>
        </div>

        <div class="footer-links">
            <h3 class="footer-heading">Tautan Cepat</h3>
            <ul class="footer-links-list">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('kontak') }}">Kontak Kami</a></li>
                <li><a href="{{ route('lapor') }}">Lapor Insiden</a></li>
                <li><a href="{{ route('lihat') }}">Lihat Peta Insiden</a></li>
            </ul>
        </div>

        <div class="footer-contact">
            <h3 class="footer-heading">Hubungi Kami</h3>
            <ul class="footer-contact-list">
                <li>
                    <i class='bx bx-map-pin'></i>
                    <span>Jl. Senayan No. 3, Tower C Lantai 8, Jakarta Pusat, DKI Jakarta 10270</span>
                </li>
                <li>
                    <i class='bx bx-phone'></i>
                    <span>Call Center: 021 - 1234 - 5678</span>
                </li>
                <li>
                    <i class='bx bx-envelope'></i>
                    <span>Email: info@incitrack.id</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="container footer-copyright">
        <p>&copy; 2026 INCITRACK Indonesia. Hak Cipta Dilindungi Undang-Undang.</p>
    </div>
</footer>
