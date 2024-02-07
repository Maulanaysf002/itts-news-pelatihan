@extends('template.home.master')

@section('content')
  <main>
    <section class="newsPage pt-120 pb-120" id="newsPage">
      <div class="head">

        <div class="col-xxl-12">
          <div class="section__title-wrapper mb-50 text-center">
            <span class="section__title-pre">Berita ITTS</span>
            <h2 class="section__title section__title-44">Seputar Informasi Kampus</h2>

            <div class="search-bar">
              <form action=/ method="get" enctype="multipart/form-data" accept-charset="utf-8">
                <input name="q" type="text" value="" placeholder="Cari Artikel">
                <button type="submit"><i class="bi bi-search"></i></button>
              </form>
            </div>

            <div class="tab__max-width">
              <div class="__tabs">
                <ul class="nav nav-tabs" id="newsTab">
                  <li class="nav-item">
                    <a class="nav-link active" id="tabA" data-bs-toggle="tab" href="#content1">Tab
                      A</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tabB" data-bs-toggle="tab" href="#content2">Tab B</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tabC" data-bs-toggle="tab" href="#content3">Tab C</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="content">
        <div class="container">
          <div class="tab-content mt-2">
            <div class="tab-pane fade show active" id="content1">
              <div class="row gy-5">

                <div class="col-lg-4 col-md-4 col-ms-6">
                  <div class="news-box">
                    <div class="news-img"><img class="img-fluid" src="assets/img/blog/blog-big-5.jpg" alt="">
                    </div>
                    <span class="news-date">Tue, September 15</span>
                    <h3 class="news-title">Eum ad dolor et. Autem aut fugiat debitis voluptatem
                      consequuntur
                      sit
                    </h3>
                    <a class="readmore stretched-link mt-auto" href="/artikel"><span>Read
                        More</span><i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>

                <div class="col-lg-4 col-md-4 col-ms-6">
                  <div class="news-box">
                    <div class="news-img"><img class="img-fluid" src="assets/img/blog/blog-big-5.jpg" alt="">
                    </div>
                    <span class="news-date">Fri, August 28</span>
                    <h3 class="news-title">Et repellendus molestiae qui est sed omnis voluptates magnam
                    </h3>
                    <a class="readmore stretched-link mt-auto" href="/artikel"><span>Read
                        More</span><i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>

                <div class="col-lg-4 col-md-4 col-ms-6">
                  <div class="news-box">
                    <div class="news-img"><img class="img-fluid" src="assets/img/blog/blog-3.jpg" alt=""></div>
                    <span class="news-date">Mon, July 11</span>
                    <h3 class="news-title">Quia assumenda est et veritatis aut quae</h3>
                    <a class="readmore stretched-link mt-auto" href="/artikel"><span>Read
                        More</span><i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>

                <div class="col-lg-4 col-md-4 col-ms-6">
                  <div class="news-box">
                    <div class="news-img"><img class="img-fluid" src="assets/img/blog/blog-3.jpg" alt=""></div>
                    <span class="news-date">Mon, July 11</span>
                    <h3 class="news-title">Quia assumenda est et veritatis aut quae</h3>
                    <a class="readmore stretched-link mt-auto" href="/artikel"><span>Read
                        More</span><i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>

              </div>
            </div>
            <div class="tab-pane fade" id="content2">
              <div class="row gy-5">


                <div class="col-lg-4 col-md-4 col-ms-6">
                  <div class="news-box">
                    <div class="news-img"><img class="img-fluid" src="assets/img/blog/blog-3.jpg" alt=""></div>
                    <span class="news-date">Mon, July 11</span>
                    <h3 class="news-title">Quia assumenda est et veritatis aut quae</h3>
                    <a class="readmore stretched-link mt-auto" href="/artikel"><span>Read
                        More</span><i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>

              </div>
            </div>
            <div class="tab-pane fade" id="content3">
              <div class="row gy-5">


                <div class="col-lg-4 col-md-4 col-ms-6">
                  <div class="news-box">
                    <div class="news-img"><img class="img-fluid" src="assets/img/blog/blog-3.jpg" alt="">
                    </div>
                    <span class="news-date">Mon, July 11</span>
                    <h3 class="news-title">Quia assumenda est et veritatis aut quae</h3>
                    <a class="readmore stretched-link mt-auto" href="/artikel"><span>Read
                        More</span><i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>

                <div class="col-lg-4 col-md-4 col-ms-6">
                  <div class="news-box">
                    <div class="news-img"><img class="img-fluid" src="assets/img/blog/blog-3.jpg" alt="">
                    </div>
                    <span class="news-date">Mon, July 11</span>
                    <h3 class="news-title">Quia assumenda est et veritatis aut quae</h3>
                    <a class="readmore stretched-link mt-auto" href="/artikel"><span>Read
                        More</span><i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

      </div>
    </section>
  </main>
@endsection
