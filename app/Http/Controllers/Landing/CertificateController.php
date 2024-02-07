<?php

namespace App\Http\Controllers\Landing;

use PDF;
use Jenssegers\Date\Date;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\TrainingCollab;
use Illuminate\Support\Facades\File;
use App\Models\Admin\TrainingSpeaker;
use App\Models\Admin\TrainingModerator;
use App\Models\Admin\TrainingSignature;
use Illuminate\Support\Facades\Session;
use App\Models\Admin\TrainingParticipant;

class CertificateController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {

    return view('home.certificate');
  }

  /**
   * Logic for submit certificate_code.
   */
  public function submit(Request $request)
  {
    $c_code = $request->certificate_code;

    $trainingParticipant = TrainingParticipant::where('certificate_code', $c_code)->with('training:id,title,training_code', 'participants:id,name,email')->get();

    if ($trainingParticipant && count($trainingParticipant) > 0) {

      $data = $trainingParticipant;

      return view('home.certificate-success', compact('data'));
    } else {
      Session::flash('danger', 'Kode Sertifikat yang Anda Masukan Tidak Ada. Silahkan melakukan Absensi atau Mengikuti Pelatihan Terlebih Dahulu');
      return redirect()->route('home.user.certificate.index');
    }
  }

  /**
   * Download Cerificate participant.
   */
  public function download(Request $request, $certificate_code)
  {

    $training = TrainingParticipant::where('certificate_code', $certificate_code)->with('training')->first();
    $participant = TrainingParticipant::where('certificate_code', $certificate_code)->with('participants')->first();
    // dapatkan data kolaborasi
    $collab = TrainingCollab::where('training_id', $training->training->id)->with('collaborator')->get();
    // dapatkan data ttd
    $signature = TrainingSignature::where('training_id', $training->training->id)->with('signature')->get();

    // return $signature;

    if ($training && $participant) {

      $pengaturan = collect([
        'margin_nomor' => 66.6,
        'font_size_nomor' => 18,
        'font_size_untuk' => 17,
        'margin_nama' => 10,
        'font_size_nama' => 35,
        'margin_pelatihan' => 15,
        'font_size_pelatihan' => 20,
        'font_size_tanggal' => 14,
        'margin_tanggal' => 2,
        'font_size_ttd' => 16,
        'margin_jabatan' => 13,
        'margin_ttd' => 23,
        'margin_nameSignature' => 5
      ]);

      $filename = 'sertifikat-' . $participant->participants->name . '-' . $training->certificate_code;

      // $pdf = PDF::loadView('pdf_view', $data);

      $pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      $pdf::setHeaderCallback(function ($pdf) {
        // get the current page break margin
        $bMargin = PDF::getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = PDF::getAutoPageBreak();
        // disable auto-page-break
        PDF::SetAutoPageBreak(false, 0);
        PDF::setCellPaddings(0, 0, 0, 0);
        // set background image
        $img_file = public_path('img/ecertificate/template.png');
        if (!File::exists($img_file)) {
          // check in server
          // $img_file = base_path('../sekolah.digiyok.com/img/ecertificate/template.png');
        }
        PDF::Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
        PDF::SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        PDF::setPageMark();
      });

      // set document information
      $pdf::SetCreator(PDF_CREATOR);
      $pdf::SetAuthor($participant->participants->name);
      $pdf::SetTitle(PDF_HEADER_TITLE . ' - ' . $training->training->title . ' - ' . $training->training->name);
      $pdf::SetSubject(PDF_HEADER_TITLE);
      $pdf::SetKeywords('PDF, e-certificate, certificate, SIT, Auliya');

      // set margins
      $pdf::SetMargins(PDF_MARGIN_RIGHT, $pengaturan['margin_nomor'], PDF_MARGIN_RIGHT);
      $pdf::SetHeaderMargin(0);
      $pdf::SetFooterMargin(0);

      // remove default footer
      $pdf::setPrintFooter(false);
      $pdf::SetAutoPageBreak(TRUE, 0);

      // set some language-dependent strings (optional)
      if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf::setLanguageArray($l);
      }

      // ---------------------------------------------------------

      $pdf::AddPage();
      // set_time_limit(0);
      // ini_set('memory_limit', '-1');
      if ($collab && count($collab) > 0) {
        // Tentukan posisi awal gambar
        $x = 60;
        $y = 10;
        $jarakGambar = 8;
        $logoITTSAdded = false;

        // Menambahkan gambar ke PDF dengan foreach
        foreach ($collab as $c) {

          // Tambahkan gambar wajib jika belum ditambahkan
          if (!$logoITTSAdded) {
            $logoITTS = 'img/logo/logo-fix-sertifikat.png';
            $pdf::Image(public_path($logoITTS), $x, 14, 85, 85, 'png', '', '', false, 300, '', false, false, 0, true);
            $logoITTSAdded = true; // Set flag menjadi true
            $x += 30 + 70; // Sesuaikan posisi untuk gambar berikutnya
          }

          // tambahkan gambar collaborator dari db
          $pdf::Image(public_path("img/collaboration/" . $c->collaborator->logo), $x, $y, 25, 25, '', '', '', false, 300, '', false, false, 0, true);

          // Sesuaikan posisi untuk gambar berikutnya
          $x += 30 + $jarakGambar; // Misalnya, berikan jarak 5 satuan antara gambar
        }
      } else {
        $logoITTS = 'img/logo/logo-fix-sertifikat.png';
        $pdf::Image(public_path($logoITTS), 108, 13, 85, 85, 'png', '', '', false, 300, '', false, false, 0, true);
      }

      $pdf::SetTextColor(0, 0, 0);
      $pdf::SetFont('helvetica', 'B', $pengaturan['font_size_nomor']);
      $pdf::Write(15, 'NO. ' . $training->certificate_code, '', 0, 'C', true, 0, false, false, 0);
      $pdf::SetFont('helvetica', '', $pengaturan['font_size_untuk']);
      $pdf::Ln((int) $pengaturan['margin_nama']);
      $pdf::SetFont('', '', $pengaturan['font_size_nama']);
      $pdf::Write(0, $participant->participants->name, '', 0, 'C', true, 0, false, false, 0);
      $pdf::Ln((int) $pengaturan['margin_pelatihan']);
      $pdf::SetFont('helvetica', 'B', $pengaturan['font_size_pelatihan']);
      $pdf::Write(10, '"' . strtoupper($training->training->title) . '"', '', 0, 'C', true, 0, false, false, 0);
      $pdf::Ln((int) $pengaturan['margin_tanggal']);
      $pdf::SetFont('helvetica', '', $pengaturan['font_size_tanggal']);
      Date::setLocale('id');
      $pdf::Write(0, 'On ' . Date::parse($training->training->t_date)->format('j F Y'), '', 0, 'C', true, 0, false, false, 0);
      $pdf::SetFont('helvetica', 'B', $pengaturan['font_size_ttd']);
      foreach ($signature as $s) {
        $pdf::Ln((int) $pengaturan['margin_jabatan']);
        $pdf::Write(0, $s->signature->position, '', 0, 'C', true, 0, false, false, 0);
        $pdf::Ln((int) $pengaturan['margin_ttd']);
        $pdf::Image(public_path("img/signature/" . $s->signature->image), 125, 168, 35, 35, '', '', '', false, 300, '', false, false, 0, true);
        $pdf::Ln((int) $pengaturan['margin_nameSignature']);
        $pdf::Write(0, $s->signature->prefixes . " " . $s->signature->name . " " . $s->signature->suffixes, '', 0, 'C', true, 0, false, false, 0);
      }


      $pdf::Output($filename . '.pdf', 'I');

      ob_end_flush();
    }
  }

  /**
   * Download Cerificate speaker.
   */
  public function speaker(Request $request, $certificate_code)
  {

    $training = TrainingSpeaker::where('certificate_code', $certificate_code)->with('training')->first();
    $speaker = TrainingSpeaker::where('certificate_code', $certificate_code)->with('speaker')->first();
    // dapatkan data kolaborasi
    $collab = TrainingCollab::where('training_id', $training->training->id)->with('collaborator')->get();
    // dapatkan data ttd
    $signature = TrainingSignature::where('training_id', $training->training->id)->with('signature')->get();

    // return $signature;

    if ($training && $speaker) {

      $pengaturan = collect([
        'margin_nomor' => 66.6,
        'font_size_nomor' => 18,
        'font_size_untuk' => 17,
        'margin_nama' => 10,
        'font_size_nama' => 35,
        'margin_pelatihan' => 15,
        'font_size_pelatihan' => 20,
        'font_size_tanggal' => 14,
        'margin_tanggal' => 2,
        'font_size_ttd' => 16,
        'margin_jabatan' => 13,
        'margin_ttd' => 23,
        'margin_nameSignature' => 5
      ]);

      $filename = 'sertifikat-' . $speaker->speaker->name . '-' . $training->certificate_code;

      // $pdf = PDF::loadView('pdf_view', $data);

      $pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      $pdf::setHeaderCallback(function ($pdf) {
        // get the current page break margin
        $bMargin = PDF::getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = PDF::getAutoPageBreak();
        // disable auto-page-break
        PDF::SetAutoPageBreak(false, 0);
        PDF::setCellPaddings(0, 0, 0, 0);
        // set background image
        $img_file = public_path('img/ecertificate/template-speaker.png');
        if (!File::exists($img_file)) {
          // check in server
          // $img_file = base_path('../sekolah.digiyok.com/img/ecertificate/template.png');
        }
        PDF::Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
        PDF::SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        PDF::setPageMark();
      });

      // set document information
      $pdf::SetCreator(PDF_CREATOR);
      $pdf::SetAuthor($speaker->speaker->name);
      $pdf::SetTitle(PDF_HEADER_TITLE . ' - ' . $training->training->title . ' - ' . $training->training->name);
      $pdf::SetSubject(PDF_HEADER_TITLE);
      $pdf::SetKeywords('PDF, e-certificate, certificate, SIT, Auliya');

      // set margins
      $pdf::SetMargins(PDF_MARGIN_RIGHT, $pengaturan['margin_nomor'], PDF_MARGIN_RIGHT);
      $pdf::SetHeaderMargin(0);
      $pdf::SetFooterMargin(0);

      // remove default footer
      $pdf::setPrintFooter(false);
      $pdf::SetAutoPageBreak(TRUE, 0);

      // set some language-dependent strings (optional)
      if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf::setLanguageArray($l);
      }

      // ---------------------------------------------------------

      $pdf::AddPage();
      // set_time_limit(0);
      // ini_set('memory_limit', '-1');
      if ($collab && count($collab) > 0) {
        // Tentukan posisi awal gambar
        $x = 60;
        $y = 10;
        $jarakGambar = 8;
        $logoITTSAdded = false;

        // Menambahkan gambar ke PDF dengan foreach
        foreach ($collab as $c) {

          // Tambahkan gambar wajib jika belum ditambahkan
          if (!$logoITTSAdded) {
            $logoITTS = 'img/logo/logo-fix-sertifikat.png';
            $pdf::Image(public_path($logoITTS), $x, 14, 85, 85, 'png', '', '', false, 300, '', false, false, 0, true);
            $logoITTSAdded = true; // Set flag menjadi true
            $x += 30 + 70; // Sesuaikan posisi untuk gambar berikutnya
          }

          // tambahkan gambar collaborator dari db
          $pdf::Image(public_path("img/collaboration/" . $c->collaborator->logo), $x, $y, 25, 25, '', '', '', false, 300, '', false, false, 0, true);

          // Sesuaikan posisi untuk gambar berikutnya
          $x += 30 + $jarakGambar; // Misalnya, berikan jarak 5 satuan antara gambar
        }
      } else {
        $logoITTS = 'img/logo/logo-fix-sertifikat.png';
        $pdf::Image(public_path($logoITTS), 108, 13, 85, 85, 'png', '', '', false, 300, '', false, false, 0, true);
      }

      $pdf::SetTextColor(0, 0, 0);
      $pdf::SetFont('helvetica', 'B', $pengaturan['font_size_nomor']);
      $pdf::Write(15, 'NO. ' . $training->certificate_code, '', 0, 'C', true, 0, false, false, 0);
      $pdf::SetFont('helvetica', '', $pengaturan['font_size_untuk']);
      $pdf::Ln((int) $pengaturan['margin_nama']);
      $pdf::SetFont('', '', $pengaturan['font_size_nama']);
      $pdf::Write(0, $speaker->speaker->nameWithTitle, '', 0, 'C', true, 0, false, false, 0);
      $pdf::Ln((int) $pengaturan['margin_pelatihan']);
      $pdf::SetFont('helvetica', 'B', $pengaturan['font_size_pelatihan']);
      $pdf::Write(10, '"' . strtoupper($training->training->title) . '"', '', 0, 'C', true, 0, false, false, 0);
      $pdf::Ln((int) $pengaturan['margin_tanggal']);
      $pdf::SetFont('helvetica', '', $pengaturan['font_size_tanggal']);
      Date::setLocale('id');
      $pdf::Write(0, 'On ' . Date::parse($training->training->t_date)->format('j F Y'), '', 0, 'C', true, 0, false, false, 0);
      $pdf::SetFont('helvetica', 'B', $pengaturan['font_size_ttd']);
      foreach ($signature as $s) {
        $pdf::Ln((int) $pengaturan['margin_jabatan']);
        $pdf::Write(0, $s->signature->position, '', 0, 'C', true, 0, false, false, 0);
        $pdf::Ln((int) $pengaturan['margin_ttd']);
        $pdf::Image(public_path("img/signature/" . $s->signature->image), 125, 168, 35, 35, '', '', '', false, 300, '', false, false, 0, true);
        $pdf::Ln((int) $pengaturan['margin_nameSignature']);
        $pdf::Write(0, $s->signature->prefixes . " " . $s->signature->name . " " . $s->signature->suffixes, '', 0, 'C', true, 0, false, false, 0);
      }

      $pdf::Output($filename . '.pdf', 'I');

      ob_end_flush();
    }
  }

  /**
   * Download Cerificate Moderator.
   */
  public function moderator(Request $request, $certificate_code)
  {

    $training = TrainingModerator::where('certificate_code', $certificate_code)->with('training')->first();
    $moderator = TrainingModerator::where('certificate_code', $certificate_code)->with('moderator')->first();
    // dapatkan data kolaborasi
    $collab = TrainingCollab::where('training_id', $training->training->id)->with('collaborator')->get();
    // dapatkan data ttd
    $signature = TrainingSignature::where('training_id', $training->training->id)->with('signature')->get();

    // return $signature;

    if ($training && $moderator) {

      $pengaturan = collect([
        'margin_nomor' => 66.6,
        'font_size_nomor' => 18,
        'font_size_untuk' => 17,
        'margin_nama' => 10,
        'font_size_nama' => 35,
        'margin_pelatihan' => 15,
        'font_size_pelatihan' => 20,
        'font_size_tanggal' => 14,
        'margin_tanggal' => 1,
        'font_size_ttd' => 16,
        'margin_jabatan' => 13,
        'margin_ttd' => 23,
        'margin_nameSignature' => 5
      ]);

      $filename = 'sertifikat-' . $moderator->moderator->name . '-' . $training->certificate_code;

      // $pdf = PDF::loadView('pdf_view', $data);

      $pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      $pdf::setHeaderCallback(function ($pdf) {
        // get the current page break margin
        $bMargin = PDF::getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = PDF::getAutoPageBreak();
        // disable auto-page-break
        PDF::SetAutoPageBreak(false, 0);
        PDF::setCellPaddings(0, 0, 0, 0);
        // set background image
        $img_file = public_path('img/ecertificate/template-moderator.png');
        if (!File::exists($img_file)) {
          // check in server
          // $img_file = base_path('../sekolah.digiyok.com/img/ecertificate/template.png');
        }
        PDF::Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
        PDF::SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        PDF::setPageMark();
      });

      // set document information
      $pdf::SetCreator(PDF_CREATOR);
      $pdf::SetAuthor($moderator->moderator->name);
      $pdf::SetTitle(PDF_HEADER_TITLE . ' - ' . $training->training->title . ' - ' . $training->training->name);
      $pdf::SetSubject(PDF_HEADER_TITLE);
      $pdf::SetKeywords('PDF, e-certificate, certificate, SIT, Auliya');

      // set margins
      $pdf::SetMargins(PDF_MARGIN_RIGHT, $pengaturan['margin_nomor'], PDF_MARGIN_RIGHT);
      $pdf::SetHeaderMargin(0);
      $pdf::SetFooterMargin(0);

      // remove default footer
      $pdf::setPrintFooter(false);
      $pdf::SetAutoPageBreak(TRUE, 0);

      // set some language-dependent strings (optional)
      if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf::setLanguageArray($l);
      }

      // ---------------------------------------------------------

      $pdf::AddPage();
      // set_time_limit(0);
      // ini_set('memory_limit', '-1');
      if ($collab && count($collab) > 0) {
        // Tentukan posisi awal gambar
        $x = 60;
        $y = 10;
        $jarakGambar = 8;
        $logoITTSAdded = false;

        // Menambahkan gambar ke PDF dengan foreach
        foreach ($collab as $c) {

          // Tambahkan gambar wajib jika belum ditambahkan
          if (!$logoITTSAdded) {
            $logoITTS = 'img/logo/logo-fix-sertifikat.png';
            $pdf::Image(public_path($logoITTS), $x, 14, 85, 85, 'png', '', '', false, 300, '', false, false, 0, true);
            $logoITTSAdded = true; // Set flag menjadi true
            $x += 30 + 70; // Sesuaikan posisi untuk gambar berikutnya
          }

          // tambahkan gambar collaborator dari db
          $pdf::Image(public_path("img/collaboration/" . $c->collaborator->logo), $x, $y, 25, 25, '', '', '', false, 300, '', false, false, 0, true);

          // Sesuaikan posisi untuk gambar berikutnya
          $x += 30 + $jarakGambar; // Misalnya, berikan jarak 5 satuan antara gambar
        }
      } else {
        $logoITTS = 'img/logo/logo-fix-sertifikat.png';
        $pdf::Image(public_path($logoITTS), 108, 13, 85, 85, 'png', '', '', false, 300, '', false, false, 0, true);
      }

      $pdf::SetTextColor(0, 0, 0);
      $pdf::SetFont('helvetica', 'B', $pengaturan['font_size_nomor']);
      $pdf::Write(15, 'NO. ' . $training->certificate_code, '', 0, 'C', true, 0, false, false, 0);
      $pdf::SetFont('helvetica', '', $pengaturan['font_size_untuk']);
      $pdf::Ln((int) $pengaturan['margin_nama']);
      $pdf::SetFont('', '', $pengaturan['font_size_nama']);
      $pdf::Write(0, $moderator->moderator->nameWithTitle, '', 0, 'C', true, 0, false, false, 0);
      $pdf::Ln((int) $pengaturan['margin_pelatihan']);
      $pdf::SetFont('helvetica', 'B', $pengaturan['font_size_pelatihan']);
      $pdf::Write(10, '"' . strtoupper($training->training->title) . '"', '', 0, 'C', true, 0, false, false, 0);
      $pdf::Ln((int) $pengaturan['margin_tanggal']);
      $pdf::SetFont('helvetica', '', $pengaturan['font_size_tanggal']);
      Date::setLocale('id');
      $pdf::Write(0, 'On ' . Date::parse($training->training->t_date)->format('j F Y'), '', 0, 'C', true, 0, false, false, 0);
      $pdf::SetFont('helvetica', 'B', $pengaturan['font_size_ttd']);
      foreach ($signature as $s) {
        $pdf::Ln((int) $pengaturan['margin_jabatan']);
        $pdf::Write(0, $s->signature->position, '', 0, 'C', true, 0, false, false, 0);
        $pdf::Ln((int) $pengaturan['margin_ttd']);
        $pdf::Image(public_path("img/signature/" . $s->signature->image), 125, 168, 35, 35, '', '', '', false, 300, '', false, false, 0, true);
        $pdf::Ln((int) $pengaturan['margin_nameSignature']);
        $pdf::Write(0, $s->signature->prefixes . " " . $s->signature->name . " " . $s->signature->suffixes, '', 0, 'C', true, 0, false, false, 0);
      }

      $pdf::Output($filename . '.pdf', 'I');

      ob_end_flush();
    }
  }
}
