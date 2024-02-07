@extends('template.home.master')

@section('content')
  <main>

    <!-- blog area start -->
    <section class="blog__area pt-120 pb-120">
      <div class="row">
        <div class="col-xxl-8 col-xl-8 col-lg-8">
          <div class="postbox__wrapper postbox__details">
            <div class="postbox__item transition-3 mb-70">
              <div class="container">
                <div class="postbox__thumb m-img">
                  <img src="assets/img/blog/blog-big-5.jpg" alt="">
                </div>
              </div>
              <div class="postbox__content">
                <div class="postbox__meta">
                  <span><i class="far fa-calendar-check"></i> July 21, 2020 </span>
                  <span><a href="#"><i class="far fa-user"></i> Shahnewaz</a></span>
                  <span><a href="#"><i class="fal fa-comments"></i> 02 Comments</a></span>
                </div>
                <h3 class="postbox__title">A Podpourri of Learning Options: Pods, Hubs, and Microschools
                </h3>
                <div class="postbox__text mb-40">
                  <p>Me old mucker argy-bargy I'm telling pear shaped Jeffrey super brilliant, I
                    excuse my French blatant gormless up the duff, cup of char up the kyver tosser
                    cras happy days. The full monty he nicked it he legged it bum bag burke
                    plastered arse over tit it's your round owt to do with me pardon you, on your
                    bike mate hanky panky mush cuppa only a quid crikey Jeffrey skive off, faff
                    about so I said what a load of rubbish blag David knees up cockup cras.
                    Argy-bargy give us a bell wellies gosh skive off old bodge cheesed off A bit of
                    how's your father off his nut bamboozled, bugger say I'm telling morish bleeding
                    boot up the kyver nice one brilliant, ruddy jolly good fanny around chinwag
                    amongst brown bread arse brolly. Horse play it's all gone to pot codswallop easy
                    peasy mush knees up down the pub jolly good nice one tosser it's your round
                    lurgy, I vagabond barmy off his nut only a quid so I said is gosh Charles blow
                    off, pardon me chip shop Richard spiffing skive off bleeding get stuffed mate
                    porkies amongst the full monty.</p>
                </div>
                <div class="postbox__quote grey-bg-2 mb-45 p-relative fix">
                  <img class="quote" src="assets/img/blog/quote-1.png" alt="">
                  <blockquote>
                    <p>After I started learning design with Quillow, I realized that I had Improved
                      to very advanced levels.</p>
                    <h4>Chris Collins</h4>
                  </blockquote>
                </div>
                <div class="postbox__text mb-30">
                  <p>Horse play it's all gone to pot codswallop easy peasy mush knees up down the pub
                    jolly good nice one tosser it's your round lurgy, I vagabond barmy off his nut
                    only a quid so I said is gosh Charles blow off, pardon me chip shop Richard
                    spiffing skive off bleeding get stuffed mate porkies amongst the full monty.
                    Daft burke you</p>
                </div>
                <div class="postbox__link mb-35">
                  <p>The little rotter bum bag a blinding shot gosh spifing butty eatonwha load of
                    rubbish bamboozled. <a href="#"> https://eduker.com/courses</a> </p>
                </div>
                <div class="postbox__img w-img mb-45">
                  <img src="assets/img/blog/blog-big-4.jpg" alt="">
                </div>
                <div class="postbox__text mb-40">
                  <h3>Build a beautiful website with Quillow</h3>
                  <p>Some dodgy chav car boot blower starkers bonnet tickety-boo no biggie cheesed
                    off, Oxford bloke fantastic the wireless bevvy cobblers chancer give us a bell,
                    bleeder jolly good hanky panky do one gormless matie boy. Pear shaped my good
                    sir I cobblers at public school quaint tickety-boo crikey bits and bobs, wellies
                    bugger all mate golly gosh brolly matie boy fanny around chimney pot cracking
                    goal my lady, bodge so I said spiffing posh the full monty don't get shirty with
                    me no biggie.</p>

                  <p>Brolly grub blimey victoria sponge blag nancy boy don't get shirty with me skive
                    off bobby burke in my flat bog-standard, easy peasy golly gosh up the duff show
                    off show off pick your nose and blow off gosh a brilliant that what a load of
                    rubbish.</p>
                </div>
                <div class="postbox__line"></div>
                <div class="postbox__meta-3 d-sm-flex align-items-center">
                  <span>Tags :</span>
                  <div class="tagcloud">
                    <a href="#">Art & Design</a>
                    <a href="#">Education</a>
                    <a href="#">App</a>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="col-xxl-4 col-xl-4 col-lg-4">
          <div class="container">
            <div class="blog__sidebar pl-70">
              <div class="sidebar__widget mb-60">
                <div class="sidebar__widget-content">
                  <div class="sidebar__search p-relative">
                    <form action="#">
                      <input type="text" placeholder="Search for courses...">
                      <button type="submit">
                        <svg style="enable-background:new 0 0 584.4 584.4;" version="1.1"
                          xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                          viewBox="0 0 584.4 584.4" xml:space="preserve">
                          <g>
                            <g>
                              <path class="st0"
                                d="M565.7,474.9l-61.1-61.1c-3.8-3.8-8.8-5.9-13.9-5.9c-6.3,0-12.1,3-15.9,8.3c-16.3,22.4-36,42.1-58.4,58.4    c-4.8,3.5-7.8,8.8-8.3,14.5c-0.4,5.6,1.7,11.3,5.8,15.4l61.1,61.1c12.1,12.1,28.2,18.8,45.4,18.8c17.1,0,33.3-6.7,45.4-18.8    C590.7,540.6,590.7,499.9,565.7,474.9z" />
                              <path class="st1"
                                d="M254.6,509.1c140.4,0,254.5-114.2,254.5-254.5C509.1,114.2,394.9,0,254.6,0C114.2,0,0,114.2,0,254.5    C0,394.9,114.2,509.1,254.6,509.1z M254.6,76.4c98.2,0,178.1,79.9,178.1,178.1s-79.9,178.1-178.1,178.1S76.4,352.8,76.4,254.5    S156.3,76.4,254.6,76.4z" />
                            </g>
                          </g>
                        </svg>
                      </button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="sidebar__widget mb-55">
                <div class="sidebar__widget-head mb-35">
                  <h3 class="sidebar__widget-title">Recent posts</h3>
                </div>
                <div class="sidebar__widget-content">
                  <div class="rc__post-wrapper">
                    <div class="rc__post d-flex align-items-start">
                      <div class="rc__thumb mr-20">
                        <a href="blog-details.html"><img src="assets/img/blog/sm/blog-sm-1.jpg" alt=""></a>
                      </div>
                      <div class="rc__content">
                        <div class="rc__meta">
                          <span>October 15, 2021</span>
                        </div>
                        <h6 class="rc__title"><a href="blog-details.html">The Importance Intrinsic
                            Motivation.</a></h6>
                      </div>
                    </div>
                    <div class="rc__post d-flex align-items-start">
                      <div class="rc__thumb mr-20">
                        <a href="blog-details.html"><img src="assets/img/blog/sm/blog-sm-2.jpg" alt=""></a>
                      </div>
                      <div class="rc__content">
                        <div class="rc__meta">
                          <span>March 26, 2021</span>
                        </div>
                        <h6 class="rc__title"><a href="blog-details.html">A Better Alternative To
                            Grading Student.</a></h6>
                      </div>
                    </div>
                    <div class="rc__post d-flex align-items-start">
                      <div class="rc__thumb mr-20">
                        <a href="blog-details.html"><img src="assets/img/blog/sm/blog-sm-3.jpg" alt=""></a>
                      </div>
                      <div class="rc__content">
                        <div class="rc__meta">
                          <span>October 15, 2021</span>
                        </div>
                        <h6 class="rc__title"><a href="blog-details.html">Strategic Social Media &
                            Evolution of Visual</a></h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- blog area end -->

  </main>
@endsection
