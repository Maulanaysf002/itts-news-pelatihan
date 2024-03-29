@extends('template.home.master')

@section('content')
  <main>

    <!-- slider area start -->
    <section class="slider__area slider__height-2 include-bg d-flex align-items-center"
      data-background="assets/img/slider/2/slider-2-bg.jpg">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xxl-6 col-lg-6">
            <div class="slider__content-2 mt-30">
              <span>ITTS Present</span>
              <h3 class="slider__title-2">News & Trainings</h3>
              <p>Institut Teknologi Tangerang Selatan memberikan sebuah pelayanan baru kepada Teknovers untuk
                Informasi seputar kampus ITTS terkini dan yang akan datang</p>
              <div class="btn-more">
                <a class="tp-btn-green" href="{{ route('home.user.register.index') }}">Daftar Pelatihan</a>
                <a class="tp-btn-orange" href="https://itts.ac.id/">Kampus ITTS</a>
              </div>
            </div>
          </div>
          <div class="col-xxl-6 col-lg-6">
            <div class="slider__thumb-2 p-relative">
              <div class="slider__shape">
                <img class="slider__shape-1" src="assets/img/slider/2/shape/slider-cap-1.png" alt="">
                <img class="slider__shape-2" src="assets/img/slider/2/shape/slider-cap-2.png" alt="">
                <img class="slider__shape-3" src="assets/img/slider/2/shape/slider-cap-3.png" alt="">
                <img class="slider__shape-4" src="assets/img/slider/2/shape/slider-shape-1.jpg" alt="">
                <img class="slider__shape-5" src="assets/img/slider/2/shape/slider-shape-2.jpg" alt="">
              </div>
              <span class="slider__thumb-mask">
                <img src="{{ asset('assets/img/slider/2/slider-thumb.png') }}" alt="">
              </span>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- slider area end -->

    <!-- category area start -->
    <section class="category__area pt-105 pb-70">
      <div class="container">
        <div class="row">
          <div class="col-xxl-4 col-xl-4 col-lg-4">
            <div class="category__wrapper">
              <div class="section__title-wrapper-2">
                <span class="section__title-pre-2">Categories</span>
                <h3 class="section__title-2 section__title-2-30">Bidang Pelatihan & Seputar ITTS</h3>
              </div>
              <p>Mari melihat mengenai apa saja yang akan dibahas dalam pelatihan dan area sekitar ITTS</p>

            </div>
          </div>
          <div class="col-xxl-8 col-xl-8 col-lg-8">
            <div class="category__item-wrapper">
              <div class="row">
                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                  <div class="category__item text-center mb-45">
                    <div class="category__icon">
                      <div class="icon-content">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M28.733 3.71736C26.5787 9.08912 21.1789 16.3914 16.6605 20.0145L13.9047 22.2247C13.555 22.4765 13.2052 22.7004 12.8135 22.8542C12.8135 22.6024 12.7996 22.3227 12.7576 22.0569C12.6037 20.8818 12.0721 19.7907 11.1349 18.8534C10.1836 17.9022 9.02254 17.3426 7.83348 17.1887C7.5537 17.1747 7.27392 17.1468 6.99414 17.1747C7.14802 16.7411 7.38583 16.3354 7.6796 15.9997L9.86188 13.2438C13.471 8.7254 20.8012 3.29769 26.159 1.15738C26.9844 0.849623 27.7817 1.07345 28.2853 1.59104C28.8169 2.10863 29.0687 2.906 28.733 3.71736Z"
                            stroke="#4270FF" stroke-width="1.56" stroke-linecap="round" stroke-linejoin="round" />
                          <path
                            d="M12.8136 22.8543C12.8136 24.393 12.226 25.8619 11.1209 26.981C10.2676 27.8343 9.10649 28.4219 7.72158 28.6037L4.2803 28.9814C2.40578 29.1913 0.797051 27.5965 1.02087 25.694L1.39858 22.2527C1.73431 19.1891 4.29429 17.2307 7.00815 17.1747C7.28793 17.1608 7.58169 17.1747 7.84748 17.1887C9.03655 17.3426 10.1976 17.8882 11.1489 18.8534C12.0861 19.7907 12.6177 20.8818 12.7716 22.0569C12.7856 22.3227 12.8136 22.5885 12.8136 22.8543Z"
                            stroke="#4270FF" stroke-width="1.56" stroke-linecap="round" stroke-linejoin="round" />
                          <path d="M18.1433 18.4477C18.1433 14.7966 15.1776 11.8309 11.5265 11.8309" stroke="#4270FF"
                            stroke-width="1.56" stroke-linecap="round" stroke-linejoin="round" />
                          <path
                            d="M26.3688 16.0137L27.404 17.0349C29.4884 19.1192 29.4884 21.1756 27.404 23.26L23.2633 27.4007C21.2069 29.4571 19.1225 29.4571 17.0662 27.4007"
                            stroke="#4270FF" stroke-width="1.56" stroke-linecap="round" />
                          <path
                            d="M2.57353 12.9081C0.517156 10.8237 0.517156 8.76737 2.57353 6.68301L6.71426 2.54228C8.77064 0.485906 10.855 0.485906 12.9114 2.54228L13.9466 3.57747"
                            stroke="#4270FF" stroke-width="1.56" stroke-linecap="round" />
                          <path d="M13.9606 3.59143L8.78467 8.76734" stroke="#4270FF" stroke-width="1.56"
                            stroke-linecap="round" />
                          <path d="M26.3688 16.0137L22.228 20.1404" stroke="#4270FF" stroke-width="1.56"
                            stroke-linecap="round" />
                        </svg>
                      </div>
                    </div>
                    <div class="category__content">
                      <h4 class="category__title">
                        Art & Designx
                      </h4>
                    </div>
                  </div>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                  <div class="category__item text-center mb-45">
                    <div class="category__icon">

                      <div class="icon-content">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path d="M8.32007 25.2251V22.1201" stroke="#FF6470" stroke-width="1.6" stroke-linecap="round" />
                          <path d="M16 25.225V19.015" stroke="#FF6470" stroke-width="1.6" stroke-linecap="round" />
                          <path d="M23.6799 25.225V15.895" stroke="#FF6470" stroke-width="1.6" stroke-linecap="round" />
                          <path d="M23.6801 6.77502L22.9901 7.58502C19.1651 12.055 14.0351 15.22 8.32007 16.645"
                            stroke="#FF6470" stroke-width="1.6" stroke-linecap="round" />
                          <path d="M19.2849 6.77502H23.6799V11.155" stroke="#FF6470" stroke-width="1.6"
                            stroke-linecap="round" stroke-linejoin="round" />
                          <path
                            d="M11.5 31H20.5C28 31 31 28 31 20.5V11.5C31 4 28 1 20.5 1H11.5C4 1 1 4 1 11.5V20.5C1 28 4 31 11.5 31Z"
                            stroke="#FF6470" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                      </div>

                    </div>
                    <div class="category__content">
                      <h4 class="category__title">
                        Management
                      </h4>
                    </div>
                  </div>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                  <div class="category__item text-center mb-45">
                    <div class="category__icon green-bg">

                      <div class="icon-content">
                        <svg width="34" height="32" viewBox="0 0 34 32" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M31.4 6.76923H25.5333V5.03846C25.5321 3.96781 25.1384 2.94138 24.4385 2.18431C23.7386 1.42724 22.7898 1.00134 21.8 1H12.2C11.2102 1.00134 10.2614 1.42724 9.5615 2.18431C8.86163 2.94138 8.4679 3.96781 8.46667 5.03846V6.76923H2.6C2.17565 6.76923 1.76869 6.95158 1.46863 7.27616C1.16857 7.60074 1 8.04097 1 8.5L1 20.0385C1.00134 20.3952 1.10454 20.7427 1.29548 21.0336C1.48641 21.3244 1.75576 21.5443 2.06667 21.6632V29.2692C2.06667 29.7283 2.23524 30.1685 2.5353 30.4931C2.83535 30.8177 3.24232 31 3.66667 31H30.3333C30.7577 31 31.1646 30.8177 31.4647 30.4931C31.7648 30.1685 31.9333 29.7283 31.9333 29.2692V21.6632C32.2442 21.5443 32.5136 21.3244 32.7045 21.0336C32.8955 20.7427 32.9987 20.3952 33 20.0385V8.5C33 8.04097 32.8314 7.60074 32.5314 7.27616C32.2313 6.95158 31.8243 6.76923 31.4 6.76923ZM9.53333 5.03846C9.53422 4.27371 9.81545 3.54055 10.3154 2.99978C10.8153 2.45902 11.493 2.1548 12.2 2.15385H21.8C22.507 2.1548 23.1847 2.45902 23.6846 2.99978C24.1846 3.54055 24.4658 4.27371 24.4667 5.03846V6.76923H23.3787L23.4 5.03846C23.3989 4.57978 23.23 4.14022 22.9302 3.81588C22.6304 3.49155 22.224 3.30883 21.8 3.30769H12.18C11.756 3.30883 11.3496 3.49155 11.0498 3.81588C10.75 4.14022 10.5811 4.57978 10.58 5.03846V5.04423L10.5947 6.76923H9.53333V5.03846ZM22.3333 5.03053L22.312 6.76923H11.6613L11.6447 5.03846C11.6447 4.88545 11.7009 4.73871 11.8009 4.63052C11.9009 4.52232 12.0366 4.46154 12.178 4.46154H21.8C21.9402 4.46152 22.0747 4.52122 22.1746 4.6277C22.2744 4.73419 22.3314 4.8789 22.3333 5.03053ZM30.8667 29.2692C30.8667 29.4222 30.8105 29.569 30.7105 29.6772C30.6104 29.7854 30.4748 29.8462 30.3333 29.8462H3.66667C3.52522 29.8462 3.38956 29.7854 3.28954 29.6772C3.18952 29.569 3.13333 29.4222 3.13333 29.2692V21.7692H6.86667V23.5C6.86667 23.653 6.92286 23.7998 7.02288 23.9079C7.1229 24.0161 7.25855 24.0769 7.4 24.0769H9.53333C9.67478 24.0769 9.81044 24.0161 9.91046 23.9079C10.0105 23.7998 10.0667 23.653 10.0667 23.5V21.7692H23.9333V23.5C23.9333 23.653 23.9895 23.7998 24.0895 23.9079C24.1896 24.0161 24.3252 24.0769 24.4667 24.0769H26.6C26.7415 24.0769 26.8771 24.0161 26.9771 23.9079C27.0771 23.7998 27.1333 23.653 27.1333 23.5V21.7692H30.8667V29.2692ZM7.93333 22.9231V20.0385C7.93332 19.9615 7.94786 19.8853 7.97606 19.8146C8.00427 19.7439 8.04554 19.6802 8.09733 19.6274C8.14532 19.5742 8.20279 19.532 8.26628 19.5035C8.32976 19.475 8.39793 19.4607 8.46667 19.4615C8.60812 19.4615 8.74377 19.5223 8.84379 19.6305C8.94381 19.7387 9 19.8855 9 20.0385V22.9231H7.93333ZM25 22.9231V20.0385C25 19.8855 25.0562 19.7387 25.1562 19.6305C25.2562 19.5223 25.3919 19.4615 25.5333 19.4615C25.6045 19.4612 25.6749 19.4767 25.7403 19.5071C25.8057 19.5375 25.8646 19.5821 25.9133 19.6382C25.9624 19.6904 26.0013 19.7527 26.0277 19.8215C26.054 19.8902 26.0673 19.964 26.0667 20.0385V22.9231H25ZM31.9333 20.0385C31.9333 20.1915 31.8771 20.3382 31.7771 20.4464C31.6771 20.5546 31.5415 20.6154 31.4 20.6154H27.1333V20.0385C27.1333 19.5794 26.9648 19.1392 26.6647 18.8146C26.3646 18.49 25.9577 18.3077 25.5333 18.3077C25.109 18.3077 24.702 18.49 24.402 18.8146C24.1019 19.1392 23.9333 19.5794 23.9333 20.0385V20.6154H10.0667V20.0385C10.0667 19.5794 9.8981 19.1392 9.59804 18.8146C9.29798 18.49 8.89101 18.3077 8.46667 18.3077C8.04232 18.3077 7.63535 18.49 7.3353 18.8146C7.03524 19.1392 6.86667 19.5794 6.86667 20.0385V20.6154H2.6C2.45855 20.6154 2.3229 20.5546 2.22288 20.4464C2.12286 20.3382 2.06667 20.1915 2.06667 20.0385V8.5C2.06667 8.34699 2.12286 8.20025 2.22288 8.09205C2.3229 7.98386 2.45855 7.92308 2.6 7.92308H31.4C31.5415 7.92308 31.6771 7.98386 31.7771 8.09205C31.8771 8.20025 31.9333 8.34699 31.9333 8.5V20.0385Z"
                            fill="#59C578" stroke="#59C578" stroke-width="0.4" />
                        </svg>
                      </div>

                    </div>
                    <div class="category__content">
                      <h4 class="category__title">
                        Business
                      </h4>
                    </div>
                  </div>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                  <div class="category__item text-center mb-45">
                    <div class="category__icon">

                      <div class="icon-content">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path d="M21.3334 10.6666H10.6667V21.3333H21.3334V10.6666Z" stroke="#F37F43"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                          <path
                            d="M6.66675 29.3334C8.86675 29.3334 10.6667 27.5334 10.6667 25.3334V21.3334H6.66675C4.46675 21.3334 2.66675 23.1334 2.66675 25.3334C2.66675 27.5334 4.46675 29.3334 6.66675 29.3334Z"
                            stroke="#F37F43" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                          <path
                            d="M6.66675 10.6666H10.6667V6.66663C10.6667 4.46663 8.86675 2.66663 6.66675 2.66663C4.46675 2.66663 2.66675 4.46663 2.66675 6.66663C2.66675 8.86663 4.46675 10.6666 6.66675 10.6666Z"
                            stroke="#F37F43" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                          <path
                            d="M21.3333 10.6666H25.3333C27.5333 10.6666 29.3333 8.86663 29.3333 6.66663C29.3333 4.46663 27.5333 2.66663 25.3333 2.66663C23.1333 2.66663 21.3333 4.46663 21.3333 6.66663V10.6666Z"
                            stroke="#F37F43" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                          <path
                            d="M25.3333 29.3334C27.5333 29.3334 29.3333 27.5334 29.3333 25.3334C29.3333 23.1334 27.5333 21.3334 25.3333 21.3334H21.3333V25.3334C21.3333 27.5334 23.1333 29.3334 25.3333 29.3334Z"
                            stroke="#F37F43" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                      </div>

                    </div>
                    <div class="category__content">
                      <h4 class="category__title">
                        Programming
                      </h4>
                    </div>
                  </div>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                  <div class="category__item text-center mb-45">
                    <div class="category__icon">

                      <div class="icon-content">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M12.25 18.625C12.25 20.08 13.375 21.25 14.755 21.25H17.575C18.775 21.25 19.75 20.23 19.75 18.955C19.75 17.59 19.15 17.095 18.265 16.78L13.75 15.205C12.865 14.89 12.265 14.41 12.265 13.03C12.265 11.77 13.24 10.735 14.44 10.735H17.26C18.64 10.735 19.765 11.905 19.765 13.36"
                            stroke="#2675FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                          <path d="M16 9.25V22.75" stroke="#2675FF" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                          <path d="M31 16C31 24.28 24.28 31 16 31C7.72 31 1 24.28 1 16C1 7.72 7.72 1 16 1"
                            stroke="#2675FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                          <path d="M31 7V1H25" stroke="#2675FF" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                          <path d="M23.5 8.5L31 1" stroke="#2675FF" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        </svg>
                      </div>

                    </div>
                    <div class="category__content">
                      <h4 class="category__title">
                        Fintech
                      </h4>
                    </div>
                  </div>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                  <div class="category__item text-center mb-45">
                    <div class="category__icon purple-bg">

                      <div class="icon-content">
                        <svg width="27" height="29" viewBox="0 0 27 29" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M25.0833 14.175V8.14001C25.0833 2.43085 23.7517 1 18.3967 1H7.68667C2.33167 1 1 2.43085 1 8.14001V24.0916C1 27.86 3.06835 28.7525 5.57585 26.0608L5.58999 26.0467C6.75165 24.8142 8.52248 24.9133 9.52832 26.2591L10.9592 28.1717"
                            stroke="#E33CFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                          <path d="M7.375 8.08331H18.7083" stroke="#E33CFF" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                          <path d="M8.79175 13.75H17.2917" stroke="#E33CFF" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                          <path
                            d="M21.8405 19.0912L16.8255 24.1063C16.6272 24.3046 16.443 24.6729 16.4005 24.9421L16.1313 26.8546C16.0322 27.5488 16.5139 28.0304 17.208 27.9313L19.1205 27.6621C19.3897 27.6196 19.7722 27.4354 19.9564 27.2371L24.9714 22.2221C25.8355 21.3579 26.2464 20.3521 24.9714 19.0771C23.7105 17.8163 22.7047 18.2271 21.8405 19.0912Z"
                            stroke="#E33CFF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                          <path d="M21.1155 19.8137C21.5405 21.3437 22.7305 22.5337 24.2605 22.9587" stroke="#E33CFF"
                            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                        </svg>
                      </div>

                    </div>
                    <div class="category__content">
                      <h4 class="category__title">
                        Content Writing
                      </h4>
                    </div>
                  </div>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                  <div class="category__item text-center mb-45">
                    <div class="category__icon green-bg-2">

                      <div class="icon-content">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path d="M6.25 18.75V10" stroke="#20AD96" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                          <path
                            d="M6.5625 27.5C8.80616 27.5 10.625 25.6812 10.625 23.4375C10.625 21.1938 8.80616 19.375 6.5625 19.375C4.31884 19.375 2.5 21.1938 2.5 23.4375C2.5 25.6812 4.31884 27.5 6.5625 27.5Z"
                            stroke="#20AD96" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                          <path
                            d="M6.25 10C8.32107 10 10 8.32107 10 6.25C10 4.17893 8.32107 2.5 6.25 2.5C4.17893 2.5 2.5 4.17893 2.5 6.25C2.5 8.32107 4.17893 10 6.25 10Z"
                            stroke="#20AD96" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                          <path
                            d="M23.75 10C25.8211 10 27.5 8.32107 27.5 6.25C27.5 4.17893 25.8211 2.5 23.75 2.5C21.6789 2.5 20 4.17893 20 6.25C20 8.32107 21.6789 10 23.75 10Z"
                            stroke="#20AD96" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                          <path
                            d="M6.41248 18.75C6.97498 16.5625 8.97497 14.9375 11.3375 14.95L15.625 14.9625C18.9 14.975 21.6875 12.875 22.7125 9.94995"
                            stroke="#20AD96" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                      </div>

                    </div>
                    <div class="category__content">
                      <h4 class="category__title">
                        Data Science
                      </h4>
                    </div>
                  </div>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                  <div class="category__item text-center mb-45">
                    <div class="category__icon yellow-bg">

                      <div class="icon-content">
                        <svg width="34" height="30" viewBox="0 0 34 30" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M13.6258 21.5381C13.5005 21.5379 13.3793 21.4933 13.2839 21.412L9.86503 18.5011C9.80677 18.4515 9.75999 18.3898 9.7279 18.3204C9.69582 18.2509 9.6792 18.1753 9.6792 18.0988C9.6792 18.0223 9.69582 17.9467 9.7279 17.8773C9.75999 17.8078 9.80677 17.7462 9.86503 17.6966L13.2839 14.7856C13.391 14.6986 13.528 14.6569 13.6655 14.6695C13.8029 14.6822 13.93 14.7481 14.0195 14.8533C14.1089 14.9584 14.1537 15.0944 14.1441 15.2321C14.1346 15.3698 14.0715 15.4983 13.9684 15.5902L11.025 18.0988L13.9684 20.6075C14.0507 20.6776 14.1096 20.7712 14.137 20.8758C14.1644 20.9804 14.1591 21.0909 14.1217 21.1923C14.0844 21.2938 14.0168 21.3813 13.9281 21.4431C13.8394 21.505 13.7339 21.5381 13.6258 21.5381Z"
                            fill="#FFA428" stroke="#F5B455" stroke-width="0.5" />
                          <path
                            d="M20.3744 21.5381C20.2663 21.5381 20.1608 21.505 20.0721 21.4431C19.9834 21.3813 19.9158 21.2938 19.8785 21.1923C19.8411 21.0909 19.8358 20.9804 19.8632 20.8758C19.8906 20.7712 19.9495 20.6776 20.0318 20.6075L22.9752 18.0988L20.0318 15.5902C19.9287 15.4983 19.8656 15.3698 19.8561 15.2321C19.8465 15.0944 19.8913 14.9584 19.9807 14.8533C20.0702 14.7481 20.1973 14.6822 20.3347 14.6695C20.4722 14.6569 20.6092 14.6986 20.7163 14.7856L24.1352 17.6966C24.1934 17.7462 24.2402 17.8078 24.2723 17.8773C24.3044 17.9467 24.321 18.0223 24.321 18.0988C24.321 18.1753 24.3044 18.2509 24.2723 18.3204C24.2402 18.3898 24.1934 18.4515 24.1352 18.5011L20.7163 21.412C20.6209 21.4933 20.4997 21.5379 20.3744 21.5381Z"
                            fill="#FFA428" stroke="#F5B455" stroke-width="0.5" />
                          <path
                            d="M15.7925 23.7215C15.7557 23.7214 15.719 23.7176 15.683 23.7102C15.5461 23.6812 15.4262 23.599 15.3498 23.4817C15.2734 23.3644 15.2467 23.2215 15.2755 23.0845L17.4061 12.9713C17.435 12.8342 17.5172 12.7142 17.6346 12.6377C17.752 12.5612 17.895 12.5345 18.0321 12.5634C18.1692 12.5923 18.2892 12.6745 18.3657 12.7919C18.4422 12.9093 18.4689 13.0523 18.44 13.1894L16.3087 23.3026C16.2836 23.421 16.2187 23.5272 16.1247 23.6034C16.0308 23.6797 15.9135 23.7214 15.7925 23.7215Z"
                            fill="#FFA428" stroke="#F5B455" stroke-width="0.5" />
                          <path
                            d="M29.4528 29.2332H4.54717C3.60677 29.232 2.70523 28.8579 2.04027 28.1929C1.3753 27.528 1.0012 26.6264 1 25.686V4.54717C1.0012 3.60677 1.3753 2.70523 2.04027 2.04027C2.70523 1.3753 3.60677 1.0012 4.54717 1H29.4528C30.3932 1.0012 31.2948 1.3753 31.9597 2.04027C32.6247 2.70523 32.9988 3.60677 33 4.54717V25.686C32.9988 26.6264 32.6247 27.528 31.9597 28.1929C31.2948 28.8579 30.3932 29.232 29.4528 29.2332ZM4.54717 2.0566C3.88663 2.0566 3.25315 2.319 2.78607 2.78607C2.319 3.25315 2.0566 3.88663 2.0566 4.54717V25.686C2.0566 26.3466 2.319 26.9801 2.78607 27.4471C3.25315 27.9142 3.88663 28.1766 4.54717 28.1766H29.4528C30.1134 28.1766 30.7469 27.9142 31.2139 27.4471C31.681 26.9801 31.9434 26.3466 31.9434 25.686V4.54717C31.9434 3.88663 31.681 3.25315 31.2139 2.78607C30.7469 2.319 30.1134 2.0566 29.4528 2.0566H4.54717Z"
                            fill="#FFA428" stroke="#F5B455" stroke-width="0.5" />
                          <path
                            d="M32.4717 9.45962H1.5283C1.38819 9.45962 1.25381 9.40396 1.15474 9.30488C1.05566 9.20581 1 9.07143 1 8.93132C1 8.7912 1.05566 8.65683 1.15474 8.55775C1.25381 8.45868 1.38819 8.40302 1.5283 8.40302H32.4717C32.6118 8.40302 32.7462 8.45868 32.8453 8.55775C32.9443 8.65683 33 8.7912 33 8.93132C33 9.07143 32.9443 9.20581 32.8453 9.30488C32.7462 9.40396 32.6118 9.45962 32.4717 9.45962Z"
                            fill="#FEA425" stroke="#F5B455" stroke-width="0.5" />
                          <path
                            d="M10.0264 6.93135C9.6958 6.93135 9.3726 6.83331 9.09769 6.64962C8.82278 6.46593 8.60851 6.20484 8.48199 5.89938C8.35546 5.59392 8.32236 5.2578 8.38686 4.93352C8.45136 4.60924 8.61058 4.31137 8.84437 4.07758C9.07816 3.84379 9.37603 3.68458 9.7003 3.62007C10.0246 3.55557 10.3607 3.58868 10.6662 3.7152C10.9716 3.84173 11.2327 4.056 11.4164 4.3309C11.6001 4.60581 11.6981 4.92902 11.6981 5.25965C11.6975 5.70283 11.5212 6.12768 11.2078 6.44106C10.8945 6.75443 10.4696 6.93075 10.0264 6.93135ZM10.0264 4.64456C9.90478 4.64456 9.78586 4.68063 9.68471 4.74822C9.58356 4.81581 9.50472 4.91187 9.45816 5.02426C9.41161 5.13666 9.39943 5.26033 9.42316 5.37965C9.44689 5.49897 9.50548 5.60857 9.5915 5.69459C9.67752 5.78061 9.78712 5.83919 9.90644 5.86293C10.0258 5.88666 10.1494 5.87448 10.2618 5.82792C10.3742 5.78137 10.4703 5.70253 10.5379 5.60138C10.6055 5.50023 10.6415 5.3813 10.6415 5.25965C10.6413 5.09658 10.5765 4.94024 10.4612 4.82493C10.3458 4.70962 10.1895 4.64476 10.0264 4.64456Z"
                            fill="#FFAD2D" />
                          <path
                            d="M4.88976 6.91546C4.55892 6.91561 4.23546 6.81763 3.96031 6.63392C3.68516 6.4502 3.47068 6.18901 3.34401 5.88338C3.21733 5.57775 3.18414 5.24141 3.24865 4.91692C3.31316 4.59242 3.47246 4.29435 3.7064 4.06041C3.94035 3.82647 4.23842 3.66716 4.56291 3.60266C4.88741 3.53815 5.22374 3.57133 5.52937 3.69801C5.83501 3.82469 6.0962 4.03917 6.27991 4.31432C6.46363 4.58946 6.56161 4.91292 6.56146 5.24377C6.56106 5.687 6.38481 6.11197 6.07139 6.42539C5.75797 6.73881 5.333 6.91506 4.88976 6.91546ZM4.88976 4.62792C4.76793 4.62777 4.64878 4.66376 4.54741 4.73134C4.44603 4.79892 4.36698 4.89505 4.32025 5.00757C4.27352 5.12008 4.26122 5.24393 4.2849 5.36345C4.30858 5.48296 4.36717 5.59276 4.45327 5.67897C4.53937 5.76517 4.6491 5.8239 4.76858 5.84772C4.88807 5.87155 5.01193 5.8594 5.12451 5.81281C5.23708 5.76622 5.33331 5.68728 5.40101 5.58599C5.46872 5.4847 5.50486 5.3656 5.50486 5.24377C5.50466 5.08062 5.43981 4.92421 5.32452 4.80878C5.20924 4.69335 5.0529 4.62831 4.88976 4.62792Z"
                            fill="#FFAD2D" />
                          <path
                            d="M15.1631 6.94716C14.8325 6.94701 14.5094 6.84884 14.2346 6.66506C13.9598 6.48128 13.7456 6.22014 13.6192 5.91467C13.4928 5.60919 13.4598 5.27309 13.5244 4.94886C13.589 4.62464 13.7483 4.32684 13.9821 4.09312C14.2159 3.85941 14.5138 3.70027 14.838 3.63583C15.1623 3.57138 15.4984 3.60453 15.8038 3.73108C16.1092 3.85763 16.3702 4.0719 16.5539 4.34679C16.7376 4.62168 16.8356 4.94486 16.8356 5.27546C16.8354 5.71889 16.6591 6.14409 16.3455 6.45757C16.0318 6.77106 15.6066 6.94716 15.1631 6.94716ZM15.1631 4.66036C15.0415 4.66051 14.9227 4.69671 14.8216 4.76439C14.7206 4.83207 14.6418 4.92819 14.5954 5.04059C14.549 5.153 14.5369 5.27665 14.5607 5.39592C14.5845 5.51519 14.6432 5.62471 14.7292 5.71066C14.8153 5.79661 14.9249 5.85512 15.0442 5.87879C15.1635 5.90246 15.2871 5.89024 15.3994 5.84366C15.5118 5.79708 15.6078 5.71824 15.6754 5.61711C15.7429 5.51597 15.779 5.39708 15.779 5.27546C15.7788 5.11226 15.7138 4.95581 15.5983 4.84048C15.4829 4.72514 15.3263 4.66036 15.1631 4.66036Z"
                            fill="#FFAD2D" />
                        </svg>
                      </div>

                    </div>
                    <div class="category__content">
                      <h4 class="category__title">
                        Devolopment
                      </h4>
                    </div>
                  </div>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                  <div class="category__item text-center mb-45">
                    <div class="category__icon violet-bg">

                      <div class="icon-content">
                        <svg id="_x31_" width="34" height="30" enable-background="new 0 0 24 24"
                          viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <g>
                            <g>
                              <path
                                d="m18.5 20c-.061 0-.121-.011-.18-.033l-13-5c-.193-.074-.32-.26-.32-.467v-6c0-.207.127-.393.32-.467l13-5c.155-.06.326-.038.463.055.136.093.217.247.217.412v16c0 .165-.081.319-.217.412-.085.058-.183.088-.283.088zm-12.5-5.844 12 4.616v-14.544l-12 4.616z" />
                            </g>
                          </g>
                          <g>
                            <g>
                              <path
                                d="m5.5 15h-3.5c-1.103 0-2-.897-2-2v-3c0-1.103.897-2 2-2h3.5c.276 0 .5.224.5.5v6c0 .276-.224.5-.5.5zm-3.5-6c-.552 0-1 .448-1 1v3c0 .552.448 1 1 1h3v-5z" />
                            </g>
                          </g>
                          <g>
                            <g>
                              <path
                                d="m7.5 22h-3c-.249 0-.46-.183-.495-.43l-1-7c-.039-.273.151-.526.425-.565.268-.034.526.151.565.425l.939 6.57h2.006l-.668-5.954c-.03-.274.167-.521.441-.553.265-.029.521.167.553.441l.73 6.51c.016.142-.029.283-.124.389-.094.106-.229.167-.372.167z" />
                            </g>
                          </g>
                          <g>
                            <g>
                              <path
                                d="m20.5 9c-.161 0-.319-.078-.416-.223-.153-.229-.091-.54.139-.693l3-2c.228-.152.539-.092.693.139.153.229.091.54-.139.693l-3 2c-.085.057-.181.084-.277.084z" />
                            </g>
                          </g>
                          <g>
                            <g>
                              <path
                                d="m23.5 18c-.096 0-.192-.027-.277-.084l-3-2c-.229-.153-.292-.464-.139-.693.154-.23.466-.291.693-.139l3 2c.229.153.292.464.139.693-.097.145-.255.223-.416.223z" />
                            </g>
                          </g>
                          <g>
                            <g>
                              <path
                                d="m23.5 12.5h-3c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h3c.276 0 .5.224.5.5s-.224.5-.5.5z" />
                            </g>
                          </g>
                        </svg>
                      </div>

                    </div>
                    <div class="category__content">
                      <h4 class="category__title">
                        Marketing
                      </h4>
                    </div>
                  </div>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                  <div class="category__item text-center mb-45">
                    <div class="category__icon add">
                      <div class="icon-content">
                        <i class="bi bi-three-dots"></i>
                      </div>
                    </div>
                    <div class="category__content">
                      <h4 class="category__title">
                        Many More
                      </h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- category area end -->

    <!-- about area start -->
    <section class="about__area pb-120 p-relative" id="about">
      <div class="container">
        <div class="row">
          <div class="col-xxl-7 col-xl-7 col-lg-7">
            <div class="about__thumb-wrapper d-sm-flex mr-20 p-relative">
              <div class="about__shape">
                <img class="about__shape-1 d-none d-sm-block" src="assets/img/about/about-shape-1.png" alt="">
                <img class="about__shape-2 d-none d-sm-block" src="assets/img/about/about-shape-2.png" alt="">
                <img class="about__shape-3" src="assets/img/about/about-shape-3.png" alt="">
              </div>
              <div class="about__thumb-left mr-10">
                <div class="about__thumb-1 mb-10">
                  <img src="assets/img/about/about-1.jpg" alt="">
                </div>
                <div class="about__thumb-1 mb-10 text-end">
                  <img src="assets/img/about/about-3.jpg" alt="">
                </div>
              </div>
              <div class="about__thumb-2 mb-10">
                <img src="assets/img/about/about-2.jpg" alt="">
              </div>
            </div>
          </div>
          <div class="col-xxl-5 col-xl-5 col-lg-5">
            <div class="about__content pl-70 pr-25">
              <div class="section__title-wrapper mb-15">
                <span class="section__title-pre">About News & Training</span>
                <h2 class="section__title">Informasi Terkini Mengenai Teknologi</h2>
              </div>
              <p>ITTS memberikan informasi menganai update informasi teknologi terbaru <br> <br> Cek Juga
                Kampus
                Kami Institut Teknologi Tangerang Selatan agar kamu dapat mengetahui para dosen-dosen
                terbaik kami</p>

              <div class="about__btn">
                <a class="tp-btn tp-btn-2" href="https://itts.ac.id/">Read more</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- about area end -->

    <!-- research area start -->
    {{-- <section class="research__area research__border grey-bg-3 pt-115 pb-90 p-relative z-index-1" id="news">
      <div class="research__shape">
        <img class="research__shape-1 d-none d-sm-block" src="assets/img/research/research-shape-1.png" alt="">
        <img class="research__shape-2 d-none d-sm-block" src="assets/img/research/research-shape-2.png" alt="">
        <img class="research__shape-3" src="assets/img/research/research-shape-3.png" alt="">
      </div>
      <div class="container">
        <div class="row">
          <div class="col-xxl-12">
            <div class="section__title-wrapper mb-50 text-center">
              <span class="section__title-pre">Berita ITTS</span>
              <h2 class="section__title section__title-44">Seputar Informasi Kampus</h2>
            </div>
          </div>
        </div>
        <div class="row gy-5">
          <div class="col-lg-4 col-md-4 col-ms-6">
            <div class="news-box">
              <div class="news-img"><img class="img-fluid" src="assets/img/blog/blog-big-5.jpg" alt=""></div>
              <span class="news-date">Tue, September 15</span>
              <h3 class="news-title">Eum ad dolor et. Autem aut fugiat debitis voluptatem consequuntur
                sit
              </h3>
              <a class="readmore stretched-link mt-auto" href="/artikel"><span>Read More</span><i
                  class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-ms-6">
            <div class="news-box">
              <div class="news-img"><img class="img-fluid" src="assets/img/blog/blog-big-5.jpg" alt=""></div>
              <span class="news-date">Fri, August 28</span>
              <h3 class="news-title">Et repellendus molestiae qui est sed omnis voluptates magnam</h3>
              <a class="readmore stretched-link mt-auto" href="/artikel"><span>Read More</span><i
                  class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-ms-6">
            <div class="news-box">
              <div class="news-img"><img class="img-fluid" src="assets/img/blog/blog-3.jpg" alt=""></div>
              <span class="news-date">Mon, July 11</span>
              <h3 class="news-title">Quia assumenda est et veritatis aut quae</h3>
              <a class="readmore stretched-link mt-auto" href="/artikel"><span>Read More</span><i
                  class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <a class="btn-more-news" href="/news">Brows All News</a>
        </div>
      </div>
    </section> --}}
    <!-- research area end -->

    <!-- event area start -->
    <section class="event__area pt-115" id="Trainings">
      <div class="container">
        <div class="row">
          <div class="col-xxl-12">
            <div class="section__title-wrapper-2 text-center mb-60">
              <span class="section__title-pre-2">Training & Webinar</span>
              <h3 class="section__title-2">Ayo Ikuti Semua Kegiatan ITTS</h3>
            </div>
          </div>
        </div>
        <br>


        <ul class="nav nav-tabs" id="trainingTabs">
          <li class="nav-item">
            <a class="nav-link active" id="upcomingTraining-tab" data-toggle="tab" href="#upcomingTraining">Upcoming
              Training</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pastTraining-tab" data-toggle="tab" href="#pastTraining">Past
              Training</a>
          </li>
        </ul>

        <div class="tab-content">

          {{-- training unfinish --}}
          <div class="tab-pane fade show active mt-4" id="upcomingTraining">
            <h4>Upcoming Training</h4>
            @if ($training['unfinish'] && count($training['unfinish']) > 0)
              <div class="row">
                <div class="col-xxl-12">

                  @foreach ($training['unfinish'] as $t_unfinish)
                    <div
                      class="mt-3 event__item white-bg mb-10 transition-3 p-relative d-lg-flex align-items-center justify-content-between">
                      <div class="event__left d-sm-flex align-items-center">
                        <div class="event__date">
                          <h4>{{ Carbon\Carbon::parse($t_unfinish->t_date)->format('d') }}</h4>
                          <p>{{ Carbon\Carbon::parse($t_unfinish->t_date)->format('F, Y') }}</p>
                        </div>
                        <div class="event__content">
                          {{-- <div class="event__meta">
                          <ul>
                            <li>
                              <a href="#"><svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path
                                    d="M8.49992 9.51253C9.72047 9.51253 10.7099 8.52308 10.7099 7.30253C10.7099 6.08198 9.72047 5.09253 8.49992 5.09253C7.27937 5.09253 6.28992 6.08198 6.28992 7.30253C6.28992 8.52308 7.27937 9.51253 8.49992 9.51253Z"
                                    stroke="#5F6160" stroke-width="1.5" />
                                  <path
                                    d="M2.56416 6.01334C3.95958 -0.120822 13.0475 -0.113738 14.4358 6.02043C15.2504 9.61876 13.0121 12.6646 11.05 14.5488C9.62625 15.9229 7.37375 15.9229 5.94291 14.5488C3.98791 12.6646 1.74958 9.61168 2.56416 6.01334Z"
                                    stroke="#5F6160" stroke-width="1.5" />
                                </svg>
                                New York, US</a>
                            </li>
                          </ul>
                        </div> --}}
                          <h3 class="event__title fs-6">
                            <a href="#">{{ $t_unfinish->title }}</a>
                          </h3>

                          {{-- <div class="event__person">
                          <ul>
                            <li>
                              <a href="#">
                                <img src="assets/img/event/event-person-1.jpg" alt="">
                                <img src="assets/img/event/event-person-2.jpg" alt="">
                                <span>David Karry</span>
                              </a>
                            </li>
                          </ul>
                        </div> --}}

                        </div>
                      </div>
                      <div class="event__right d-sm-flex align-items-center">
                        {{-- <div class="event__time">
                          <span>
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M13.75 7.50024C13.75 10.9502 10.95 13.7502 7.5 13.7502C4.05 13.7502 1.25 10.9502 1.25 7.50024C1.25 4.05024 4.05 1.25024 7.5 1.25024C10.95 1.25024 13.75 4.05024 13.75 7.50024Z"
                                stroke="#258E46" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M9.8188 9.48735L7.8813 8.3311C7.5438 8.1311 7.2688 7.64985 7.2688 7.2561V4.6936"
                                stroke="#258E46" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            11:00am - 12:00pm
                          </span>
                        </div> --}}
                        {{-- <div class="event__more ml-30">
                          <a class="tp-btn-5 tp-btn-7 cursor-pointer " data-bs-toggle="modal"
                            data-bs-target="#eventModal2">View Events
                          </a>
                        </div> --}}
                      </div>
                    </div>
                  @endforeach

                </div>
              </div>
            @endif
          </div>


          {{-- finish training --}}
          <div class="tab-pane fade  mt-4" id="pastTraining">
            <h4>Past Training</h4>
            @if ($training['finish'] && count($training['finish']) > 0)
              <div class="row">
                <div class="col-xxl-12">
                  @foreach ($training['finish'] as $t_finish)
                    <div
                      class="event__item white-bg mb-10 transition-3 p-relative d-lg-flex align-items-center justify-content-between">
                      <div class="event__left d-sm-flex align-items-center">
                        <div class="event__date">
                          <h4>{{ Carbon\Carbon::parse($t_finish->t_date)->format('d') }}</h4>
                          <p>{{ Carbon\Carbon::parse($t_finish->t_date)->format('F, Y') }}</p>
                        </div>
                        <div class="event__content">
                          {{-- <div class="event__meta">
                            <ul>
                              <li>
                                <a href="#"><svg width="17" height="17" viewBox="0 0 17 17"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                      d="M8.49992 9.51253C9.72047 9.51253 10.7099 8.52308 10.7099 7.30253C10.7099 6.08198 9.72047 5.09253 8.49992 5.09253C7.27937 5.09253 6.28992 6.08198 6.28992 7.30253C6.28992 8.52308 7.27937 9.51253 8.49992 9.51253Z"
                                      stroke="#5F6160" stroke-width="1.5" />
                                    <path
                                      d="M2.56416 6.01334C3.95958 -0.120822 13.0475 -0.113738 14.4358 6.02043C15.2504 9.61876 13.0121 12.6646 11.05 14.5488C9.62625 15.9229 7.37375 15.9229 5.94291 14.5488C3.98791 12.6646 1.74958 9.61168 2.56416 6.01334Z"
                                      stroke="#5F6160" stroke-width="1.5" />
                                  </svg>
                                  New York, US</a>
                              </li>
                            </ul>
                          </div> --}}
                          <h3 class="event__title">
                            <a href="#">{{ $t_finish->title }}</a>
                          </h3>

                          {{-- <div class="event__person">
                            <ul>
                              <li>
                                <a href="#">
                                  <img src="assets/img/event/event-person-1.jpg" alt="">
                                  <img src="assets/img/event/event-person-2.jpg" alt="">
                                  <span>David Karry</span>
                                </a>
                              </li>
                            </ul>
                          </div> --}}
                        </div>
                      </div>
                      {{-- <div class="event__right d-sm-flex align-items-center">
                        <div class="event__time">
                          <span>
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M13.75 7.50024C13.75 10.9502 10.95 13.7502 7.5 13.7502C4.05 13.7502 1.25 10.9502 1.25 7.50024C1.25 4.05024 4.05 1.25024 7.5 1.25024C10.95 1.25024 13.75 4.05024 13.75 7.50024Z"
                                stroke="#258E46" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M9.8188 9.48735L7.8813 8.3311C7.5438 8.1311 7.2688 7.64985 7.2688 7.2561V4.6936"
                                stroke="#258E46" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            04:00pm - 06:30pm
                          </span>
                        </div>
                        <div class="event__more ml-30">
                          <a class="tp-btn-5 tp-btn-7" href="#">View Events </a>
                        </div>
                      </div> --}}
                    </div>
                  @endforeach
                </div>
              </div>
            @endif
          </div>

        </div>




      </div>
    </section>
    <!-- event area end -->

    <!-- team area start -->
    {{-- <section class="team__area pt-115">
      <div class="container">
        <div class="row align-items-end">
          <div class="col-xxl-6 col-xl-6 col-lg-6">
            <div class="section__title-wrapper-2 mb-40">
              <span class="section__title-pre-2">Best Speaker From ITTS</span>
              <h3 class="section__title-2">Dosen Sekaligus Sebuah Pembicara di Kampus ITTS.</h3>
            </div>
          </div>
          <div class="col-xxl-6 col-xl-6 col-lg-6">
            <div class="team__wrapper mb-45 pl-70">
              <p>Dosen dan Pembicara Berkualitas di Kampus ITTS: Seorang ahli yang menginspirasi, memberikan
                wawasan mendalam, dan mendukung pengembangan ilmu di lingkungan akademis dengan keahliannya
                sebagai pembicara dan pendidik di ITTS.</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6">
            <div class="team__item text-center mb-40">
              <div class="team__thumb">
                <div class="team__shape">
                  <img src="assets/img/team/team-shape-1.png" alt="">
                </div>
                <img src="assets/img/team/pakagung.png" alt="">
              </div>
              <div class="team__content">
                <h3 class="team__title">
                  <a href="team-details.html">Agung Budi Prasetio, S.T., M.Eng., Ph.D.</a>
                </h3>
                <span class="team__designation">Professor</span>
              </div>
            </div>
          </div>
          <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6">
            <div class="team__item text-center mb-40">
              <div class="team__thumb">
                <div class="team__shape">
                  <img src="assets/img/team/team-shape-2.png" alt="">
                </div>
                <img src="assets/img/team/team-2.png" alt="">
              </div>
              <div class="team__content">
                <h3 class="team__title">
                  <a href="team-details.html">Morgan Key</a>
                </h3>
                <span class="team__designation">Teacher MBA</span>
              </div>
            </div>
          </div>
          <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6">
            <div class="team__item text-center mb-40">
              <div class="team__thumb">
                <div class="team__shape">
                  <img src="assets/img/team/team-shape-3.png" alt="">
                </div>
                <img src="assets/img/team/team-3.png" alt="">
              </div>
              <div class="team__content">
                <h3 class="team__title">
                  <a href="team-details.html">Andra Flatcher </a>
                </h3>
                <span class="team__designation">Lead Teacher</span>
              </div>
            </div>
          </div>
          <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6">
            <div class="team__item text-center mb-40">
              <div class="team__thumb">
                <div class="team__shape">
                  <img src="assets/img/team/team-shape-4.png" alt="">
                </div>
                <img src="assets/img/team/team-4.png" alt="">
              </div>
              <div class="team__content">
                <h3 class="team__title">
                  <a href="team-details.html">M. Ihsan Fawzi M. Kom</a>
                </h3>
                <span class="team__designation">Lecture</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> --}}
    <!-- team area end -->

    <!-- Modal 2 -->
    <div class="modal fade" id="eventModal2" aria-hidden="true" tabindex="-1">
      <div class="modal-dialog">
        <div class="d-flex justify-content-center">
          <div class="modal-content">
            <div class="modal-header">

              <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
            </div>

            <div class="modal-body">
              <div class="container">
                <div class="row">
                  <div class="col-lg-7">
                    <img class="img-fluid img-event" src={{ asset('assets/img/flayer.jpg') }} alt="">
                  </div>
                  <div class="col-lg-5 img-content">
                    <h5 class="headline">BEASISWA SAMPAI LULUS!</h5>
                    <p class="desc">Institut Teknologi Tangerang Selatan membuka beasiswa hingga 30
                      November
                      2023. Benefit utama yang bisa kamu dapatkan adalah mendapatkan subsidi biaya
                      hingga
                      semester 8, bisa fully funded juga tergantung hasil seleksi
                      yapp🙌<br><br>Penerima
                      beasiswa ini memiliki peluang mendapatkan kerja sebelum lulus lhoo..yuk langsung
                      aja
                      daftar sekarang yapp, kali aja ITTS jembatanmu menggapai impian dibidang
                      IT.<br><br>Daftar melalui link :<br>bit.ly/beasiswa-GSK<br><br>Info
                      Pendaftaran:<br>📱0877-7277-1775<br></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <a href="/pendaftaran">
                <button class="btn btn-primary" type="button">Daftar Pelatihan</button>
              </a>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal 3 -->
    <div class="modal fade" id="eventModal3" aria-hidden="true" tabindex="-1">
      <div class="modal-dialog">
        <div class="d-flex justify-content-center">
          <div class="modal-content">
            <div class="modal-header">

              <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
            </div>

            <div class="modal-body">
              <div class="container">
                <div class="row">
                  <div class="col-lg-7">
                    <img class="img-fluid img-event" src={{ asset('assets/img/flayer.jpg') }} alt="">
                  </div>
                  <div class="col-lg-5 img-content">
                    <h5 class="headline">BEASISWA SAMPAI LULUS!</h5>
                    <p class="desc">Institut Teknologi Tangerang Selatan membuka beasiswa hingga 30
                      November
                      2023. Benefit utama yang bisa kamu dapatkan adalah mendapatkan subsidi biaya
                      hingga
                      semester 8, bisa fully funded juga tergantung hasil seleksi
                      yapp🙌<br><br>Penerima
                      beasiswa ini memiliki peluang mendapatkan kerja sebelum lulus lhoo..yuk langsung
                      aja
                      daftar sekarang yapp, kali aja ITTS jembatanmu menggapai impian dibidang
                      IT.<br><br>Daftar melalui link :<br>bit.ly/beasiswa-GSK<br><br>Info
                      Pendaftaran:<br>📱0877-7277-1775<br></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <a href="/pendaftaran">
                <button class="btn btn-primary" type="button">Daftar Pelatihan</button>
              </a>

            </div>
          </div>
        </div>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </main>
@endsection
