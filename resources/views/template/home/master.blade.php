<!DOCTYPE html>
<html lang="en">

<head>
  @include('template.home.head')
  @yield('headmeta')
</head>

<body>

  <!-- pre loader area start -->
  <div id="loading">
    <div id="loading-center">
      <div id="loading-center-absolute">
        <svg id="loader">
          <path id="corners" d="m 0 12.5 l 0 -12.5 l 50 0 l 0 50 l -50 0 l 0 -37.5" />
        </svg>
        <img src="assets/img/favicon.png" alt="">
      </div>
    </div>
  </div>
  <!-- pre loader area end -->

  <!-- header area start -->
  <header>
    <div class="header__area header__transparent" id="header-sticky">
      <div class="header__bottom">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-xxl-8 col-xl-9 col-lg-10 col-md-6 col-6">
              <div class="header__bottom-left d-flex align-items-center">
                <div class="logo">
                  <a href="/">
                    <img src="assets/img/logo/logo-itts.png" alt="logo">
                  </a>
                </div>
                <div class="main-menu main-menu-2 main-menu-border ml-30 pl-30">
                  <nav id="mobile-menu">
                    <ul class="custom-menu">
                      <li>
                        <a href="/">Home</a>
                      </li>
                      {{-- <li class="has-dropdown">
                        <a href="/#about">About</a>
                      </li>
                      <li>
                        <a href="/#news">News</a>
                      </li> --}}
                      {{-- <li>
                        <a href="/#Trainings">Trainings</a>
                      </li> --}}
                      <li>
                        <a href="{{ route('home.user.presence.index') }}">Absen</a>
                      </li>
                      <li>
                        <a href="{{ route('home.user.certificate.index') }}">Download Sertifikat</a>
                      </li>

                    </ul>
                  </nav>
                </div>
              </div>
            </div>
            <div class="col-xxl-4 col-xl-3 col-lg-2 col-md-6 col-6">
              <div class="header__bottom-right d-flex justify-content-end align-items-center pl-30">
                <div class="header__action d-none d-xl-block">
                  <a class="btn-daftar" href="{{ route('home.user.register.index') }}">Daftar Pelatihan</a>
                </div>
                <div class="header__hamburger ml-50 d-xl-none">
                  <button class="hamurger-btn" data-bs-toggle="modal" data-bs-target="#offcanvasmodal" type="button">
                    <span></span>
                    <span></span>
                    <span></span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- header area end -->

  <!-- offcanvas area start -->
  <div class="offcanvas__area">
    <div class="modal fade" id="offcanvasmodal" aria-labelledby="offcanvasmodal" aria-hidden="true" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="offcanvas__wrapper">
            <div class="offcanvas__content">
              <div class="offcanvas__top d-flex justify-content-between align-items-center">
                <div class="offcanvas__logo logo">
                  <a href="index-2.html">
                    <img src="assets/img/logo/logo-itts.png" alt="logo">
                  </a>
                </div>
                <div class="offcanvas__close">
                  <button class="offcanvas__close-btn" data-bs-toggle="modal" data-bs-target="#offcanvasmodal">
                    <i class="bi bi-x"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="mobile-menu fix"></div>


            <div class="offcanvas__contact mt-30 mb-20">
              <div class="means-container">
                <div class="btn-more">
                  <a class="tp-btn-green" href="/pendaftaran">Pelatihan</a>
                  <a class="tp-btn-orange" href="https://itts.ac.id/">ITTS</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- offcanvas area end -->
  <div class="body-overlay"></div>
  <!-- offcanvas area end -->

  <!-- back to top start -->
  <div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
      <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>

  </div>


  @yield('content')


  < <!-- back to top end -->

    <!-- footer area start -->
    <footer>
      <div class="footer__area">
        <div class="footer__top grey-bg-4 pt-95 pb-45">
          <div class="container">
            <div class="row">
              <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-7">
                <div class="footer__widget footer__widget-2 footer-col-2-1 mb-50">
                  <div class="footer__logo">
                    <div class="logo">
                      <a href="index.html">
                        <img src="assets/img/logo/logo-itts.png" alt="">
                      </a>
                    </div>
                  </div>
                  <div class="footer__widget-content">
                    <div class="footer__widget-info">
                      <p>Alamat: Komplek Komersial BSD, Jl. Raya Serpong Kilometer 7 Jl. Komp. Bsd
                        No.Kav. 9, Lengkong Karya, Kec. Serpong Utara, Kota Tangerang Selatan,
                        Banten 15117</p>
                      <div class="footer__social">
                        <h4>Follow Us</h4>

                        <ul>
                          <li><a href="#"><i class="bi bi-facebook"></i></a>
                          </li>
                          <li><a href="#"><i class="bi bi-twitter"></i></a>
                          </li>
                          <li><a href="#"><i class="bi bi-linkedin"></i></a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-5">
                <div class="footer__widget footer__widget-2 mb-50 footer-col-2-2">
                  <h3 class="footer__widget-title">Explore</h3>
                  <div class="footer__widget-content">
                    <ul>
                      <li>
                        <a href="#about">About News & Trainings</a>
                      </li>
                      <li>
                        <a href="#news">News</a>
                      </li>
                      <li>
                        <a href="#trainings">Trainings</a>
                      </li>
                      <li>
                        <a href="/pendaftaran">Daftar Pelatihan</a>
                      </li>

                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-5">
                <div class="footer__widget footer__widget-2 mb-50 footer-col-2-3">
                  <h3 class="footer__widget-title">Links</h3>
                  <div class="footer__widget-content">
                    <ul>
                      <li>
                        <a href="https://itts.ac.id/">Kampus ITTS</a>
                      </li>
                      <li>
                        <a href="/">Email</a>
                      </li>

                      <li>
                        <a href="/">WhatsApp</a>
                      </li>
                      <li>
                        <a href="/">Instagram</a>
                      </li>
                      <li>
                        <a href="/">Facebook</a>
                      </li>

                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-7">
                <div class="footer__widget footer__widget-2 footer-col-2-4 mb-50">
                  <h3 class="footer__widget-title">Sign up for our newsletter</h3>
                  <div class="footer__subscribe">
                    <p>Receive weekly newsletter with educational materials, popular books and much
                      more!</p>
                    <form action="#">
                      <div class="footer__subscribe-input">
                        <input type="text" placeholder="Email">
                        <button class="tp-btn-subscribe" type="submit">Subscribe</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="footer__bottom grey-bg-4">
          <div class="container">
            <div class="footer__bottom-inner">
              <div class="row">
                <div class="col-xxl-12">
                  <div class="footer__copyright text-center">
                    <p>© ITTS News. <a href="http://digiyok.com/">Powered By Digiyok</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- footer area end -->

    @include('template.home.plugin')
    <script src="{{ asset('js/custom.js') }}"></script>

    @yield('footjs')

</body>

</html>
