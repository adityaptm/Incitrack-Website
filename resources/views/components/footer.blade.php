<footer class="footer">
    <div class="container footerContainer">
        <div class="brandCol">
            <div class="logo">
                <img src="{{ asset('it.png') }}" alt="INCITRACK" />
            </div>
            <p>INCITRACK berkomitmen untuk meningkatkan keselamatan di jalan melalui data yang akurat dan transparan.</p>
            <div class="socials">
                <a href="#">in</a>
                <a href="#">ig</a>
                <a href="#">fb</a>
            </div>
        </div>

        <div class="linksCol">
            <h3>Layanan Kami</h3>
            <ul>
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('kontak') }}">Kontak</a></li>
                <li><a href="{{ route('lapor') }}">Lapor</a></li>
                <li><a href="{{ route('lihat') }}">Lihat</a></li>
            </ul>
        </div>

        <div class="contactCol">
            <h3>Kontak Kami</h3>
            <ul>
                <li><i class='bx bx-phone' style="margin-right: 8px;"></i> 021 - 1234 - 5678</li>
                <li><i class='bx bx-envelope' style="margin-right: 8px;"></i> info@incitrack.id</li>
                <li><i class='bx bx-map' style="margin-right: 8px;"></i> Jl. Senayan no.3, Jakarta</li>
            </ul>
        </div>
    </div>
    <div class="copyright">
        <p>© INCITRACK {{ date('Y') }} - Berkomitmen untuk Keselamatan Jalan Tol Indonesia</p>
    </div>
</footer>
