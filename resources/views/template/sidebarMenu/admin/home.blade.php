@extends('template.admin.sidebar')

@section('sidebar-menu')
  <li class="nav-item {{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
      <i class="mdi mdi-view-dashboard"></i>
      <span>Beranda</span></a>
  </li>
  <hr class="sidebar-divider">

  {{-- pelatihan --}}
  <li
    class="nav-item {{ request()->routeIs('admin.training.*') || request()->routeIs('admin.training.speaker.*') || request()->routeIs('admin.training.moderator.*') || request()->routeIs('admin.training.collaboration.*') ? 'active' : '' }}">
    <a class="nav-link {{ request()->routeIs('admin.training.*') || request()->routeIs('admin.training.speaker.*') || request()->routeIs('admin.training.moderator.*') ? '' : 'collapsed' }}"
      data-toggle="collapse" data-target="#collapseTraining" href="#"
      aria-expanded="{{ request()->routeIs('admin.training.*') || request()->routeIs('admin.training.speaker.*') || request()->routeIs('admin.training.moderator.*') || request()->routeIs('admin.training.collaboration.*') ? 'true' : 'false' }}"
      aria-controls="collapseTraining">
      <i class="mdi mdi-book-open-page-variant-outline"></i>
      <span>Menu Pelatihan</span>
    </a>
    <div class="collapse {{ request()->routeIs('admin.training.*') || request()->routeIs('admin..*') ? 'show' : '' }}"
      id="collapseTraining" data-parent="#accordionSidebar" aria-labelledby="headingService" style="">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Fitur</h6>
        <a class="collapse-item {{ request()->routeIs('admin.training.index') ? 'active' : '' }}"
          href="{{ route('admin.training.index') }}">
          <i class="mdi mdi-book-open-page-variant"></i>
          <span>Buat Pelatihan</span>
        </a>
        <hr class="sidebar-divider">
        <a class="collapse-item {{ request()->routeIs('admin.training.speaker.*') ? 'active' : '' }}"
          href="{{ route('admin.training.speaker.index') }}">
          <i class="mdi mdi-cog"></i>
          <span>Data Pemateri</span>
        </a>
        <a class="collapse-item {{ request()->routeIs('admin.training.moderator.*') ? 'active' : '' }}"
          href="{{ route('admin.training.moderator.index') }}">
          <i class="mdi mdi-cog"></i>
          <span>Data Moderator</span>
        </a>
        <a class="collapse-item {{ request()->routeIs('admin.training.collaboration.*') ? 'active' : '' }}"
          href="{{ route('admin.training.collaboration.index') }}">
          <i class="mdi mdi-cog"></i>
          <span>Data Kolaborasi</span>
        </a>
      </div>
    </div>
  </li>

  {{-- peserta --}}
  <li class="nav-item {{ request()->routeIs('admin.participant.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.participant.index') }}">
      <i class="mdi mdi-card-account-details"></i>
      <span>Daftar Peserta</span>
    </a>
  </li>

  {{-- <li
    class="nav-item {{ request()->routeIs('admin.participant.*') || request()->routeIs('admin.participant.presence.*') ? 'active' : '' }}">
    <a class="nav-link {{ request()->routeIs('admin.participant.*') || request()->routeIs('admin.participant.presence.*') ? '' : 'collapsed' }}"
      data-toggle="collapse" data-target="#collapseParticipants" href="#"
      aria-expanded="{{ request()->routeIs('admin.participant.*') || request()->routeIs('admin.participant.presence.*') ? 'true' : 'false' }}"
      aria-controls="collapseParticipants">
      <i class="mdi mdi-account-group"></i>
      <span>Menu Peserta</span>
    </a>
    <div class="collapse {{ request()->routeIs('admin.participant.*') || request()->routeIs('admin..*') ? 'show' : '' }}"
      id="collapseParticipants" data-parent="#accordionSidebar" aria-labelledby="headingService" style="">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Fitur</h6>
        <a class="collapse-item {{ request()->routeIs('admin.participant.*') ? 'active' : '' }}"
          href="{{ route('admin.participant.index') }}">
          <i class="mdi mdi-card-account-details"></i>
          <span>Daftar Peserta</span>
        </a>
      </div>
    </div>
  </li> --}}

  {{-- data tanda tangan sertif --}}
  {{-- <li class="nav-item {{ request()->routeIs('admin.certificate.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.certificate.signature.index') }}">
      <i class="mdi mdi-cog"></i>
      <span>Tanda Tangan Sertifikat</span>
    </a>
  </li> --}}

  <li
    class="nav-item {{ request()->routeIs('admin.invitation.signature.*') || request()->routeIs('admin.certificate.signature.*') ? 'active' : '' }}">
    <a class="nav-link {{ request()->routeIs('admin.invitation.signature.*') || request()->routeIs('admin.certificate.signature.*') ? '' : 'collapsed' }}"
      data-toggle="collapse" data-target="#collapseCertificate" href="#"
      aria-expanded="{{ request()->routeIs('admin.invitation.signature.*') || request()->routeIs('admin.certificate.signature.*') ? 'true' : 'false' }}"
      aria-controls="collapseCertificate">
      <i class="mdi mdi-certificate"></i>
      <span>Menu Tanda Tangan</span>
    </a>
    <div
      class="collapse {{ request()->routeIs('admin.certificate.signature.*') || request()->routeIs('admin.invitation.signature.*') ? 'show' : '' }}"
      id="collapseCertificate" data-parent="#accordionSidebar" aria-labelledby="headingService" style="">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Fitur</h6>
        <a class="collapse-item {{ request()->routeIs('admin.certificate.signature.*') ? 'active' : '' }}"
          href="{{ route('admin.certificate.signature.index') }}">
          <i class="mdi mdi-cog"></i>
          <span>TTD Sertifikat</span>
        </a>
        <a class="collapse-item {{ request()->routeIs('admin.invitation.signature.*') ? 'active' : '' }}"
          href="{{ route('admin.invitation.signature.index') }}">
          <i class="mdi mdi-cog"></i>
          <span>TTD Sk</span>
        </a>
      </div>
    </div>
  </li>

  {{-- Blog --}}

  {{-- @php $collapse = 'Blog' @endphp
  <li
    class="nav-item {{ request()->routeIs('admin.blog.article.*') || request()->routeIs('admin.blog.article-category.*') || request()->routeIs('admin.blog.author.*') ? 'active' : '' }}">
    <a class="nav-link {{ request()->routeIs('admin.blog.article.*') || request()->routeIs('admin.blog.article-category.*') || request()->routeIs('admin.blog.author.*') ? '' : 'collapsed' }}"
      data-toggle="collapse" data-target="#collapse{{ $collapse }}" href="#"
      aria-expanded="{{ request()->routeIs('admin.blog.article.*') || request()->routeIs('admin.blog.article-category.*') || request()->routeIs('admin.blog.author.*') ? 'true' : 'false' }}"
      aria-controls="collapse{{ $collapse }}">
      <i class="mdi mdi-newspaper"></i>
      <span>Berita & Aktivitas</span>
    </a>
    <div
      class="collapse {{ request()->routeIs('admin.blog.article.*') || request()->routeIs('admin.blog.article-category.*') || request()->routeIs('admin.blog.author.*') ? 'show' : '' }}"
      id="collapse{{ $collapse }}" data-parent="#accordionSidebar" aria-labelledby="heading{{ $collapse }}"
      style="">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Berita & Aktivitas</h6>
        <a class="collapse-item {{ request()->routeIs('admin.blog.article.*') ? 'active' : '' }}"
          href="{{ route('admin.blog.article.index') }}">
          <i class="mdi mdi-pin"></i>
          <span>Artikel</span>
        </a>
        <hr class="sidebar-divider">
        <a class="collapse-item {{ request()->routeIs('admin.blog.article-category.*') ? 'active' : '' }}"
          href="{{ route('admin.blog.article-category.index') }}">
          <i class="mdi mdi-cog"></i>
          <span>Kategori</span>
        </a>
        <a class="collapse-item {{ request()->routeIs('admin.blog.author.*') ? 'active' : '' }}"
          href="{{ route('admin.blog.author.index') }}">
          <i class="mdi mdi-cog"></i>
          <span>Penulis</span>
        </a>
      </div>
    </div>
  </li> --}}
@endsection
