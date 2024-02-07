<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Jenssegers\Date\Date;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Admin\TrainingCollab;
use App\Models\Admin\TrainingModerator;
use Illuminate\Support\Facades\File;

use App\Models\Admin\TrainingSpeaker;
use App\Models\Admin\TrainingSignature;
use App\Models\Admin\TrainingSKSignature;

class InvitationController extends Controller
{

  /**
   * Download Cerificate speaker.
   */
  public function speaker(Request $request, $id)
  {

    $training = TrainingSpeaker::where('id', $id)->with('training')->first();
    $speaker = TrainingSpeaker::where('id', $id)->with('speaker')->first();
    // dapatkan data ttd sk
    $signature = TrainingSKSignature::where('training_id', $training->training->id)->with('sksignature')->get();

    // type pelatihan
    $type = '';
    if ($training->training->t_type == 1) {
      $type = 'Webinar';
    } else {
      $type = 'Seminar';
    }

    // return $signature;

    if ($training && $speaker) {

      $pengaturan = collect([
        'margin_nomor' => 24,
        'font_size_nomor' => 12,
        'font_size_untuk' => 17,
        'margin_nama' => 21,
        'font_size_nama' => 14,
        'margin_type' => 45,
        'font_size_type' => 12,
        'margin_pelatihan' => 7,
        'font_size_pelatihan' => 12,
        'font_size_tanggal' => 14,
        'margin_tanggal' => 6,
        'margin_tanggal_now' => 45,
        'font_size_ttd' => 14,
        'margin_jabatan' => 5,
        'margin_ttd' => 23,
        'margin_nameSignature' => 7
      ]);

      $filename = 'sk' . '-' . $speaker->speaker->name . '-' . '0' . $training->id;


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
        $img_file = public_path('img/ecertificate/sk-ittsnews.png');
        if (!File::exists($img_file)) {
          // check in server
          // $img_file = base_path('../sekolah.digiyok.com/img/ecertificate/template.png');
        }
        PDF::Image($img_file, 5, 0, 200, 0, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
        PDF::SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        PDF::setPageMark();
      });

      // set document information
      $pdf::SetCreator(PDF_CREATOR);
      $pdf::SetAuthor($speaker->speaker->name);
      $pdf::SetTitle('Surat Undangan' . ' - ' . $training->training->title . ' - ' . $training->training->name);
      $pdf::SetSubject(PDF_HEADER_TITLE);
      // $pdf::SetKeywords('PDF, e-certificate, certificate, SIT, Auliya');

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

      $pdf::AddPage('P');

      Carbon::setLocale('id');

      $pdf::SetTextColor(0, 0, 0);
      $pdf::Ln((int) $pengaturan['margin_nomor']);
      $pdf::SetFont('helvetica', '', $pengaturan['font_size_nomor']);
      $pdf::SetX(20);
      $pdf::Write(3, 'Kode       : ' . $training->invitation_code, '', 0, 'L', true, 0, false, false, 0);
      $pdf::SetX(20);
      $pdf::Write(1, 'Perihal    : ' . $type, '', 0, 'L', true, 0, false, false, 0);
      $pdf::SetFont('helvetica', '', $pengaturan['font_size_untuk']);
      $pdf::Ln((int) $pengaturan['margin_nama']);
      $pdf::SetFont('helvetica', 'B', $pengaturan['font_size_nama']);
      $pdf::SetX(19);
      $pdf::Write(0, $speaker->speaker->nameWithTitle, '', 0, '', true, 0, false, false, 0);
      $pdf::Ln((int) $pengaturan['margin_type']);
      $pdf::SetFont('helvetica', 'B', $pengaturan['font_size_type']);
      $pdf::SetX(20);
      $pdf::Write(9, $type . '.', '', 0, '', true, 0, false, false, 0);
      $pdf::Ln((int) $pengaturan['margin_pelatihan']);
      $pdf::SetFont('helvetica', 'B', $pengaturan['font_size_pelatihan']);
      $pdf::SetX(19);
      $title = strtoupper($training->training->title);
      $cellWidth = 175;
      $cellHeight = 20;
      $pdf::MultiCell($cellWidth, $cellHeight, '"' . $title . '"', 0, 'L', false, 1, 19, '', true, 0, false, true, $cellHeight);

      // tanggal pelatihan
      $pdf::Ln((int) $pengaturan['margin_tanggal']);
      $pdf::SetFont('helvetica', '', $pengaturan['font_size_tanggal']);
      Date::setLocale('id');
      $tglPelatihan = Carbon::parse($training->training->t_date)->setTimezone('Asia/Jakarta');
      $pdf::setX(52);
      $pdf::Write(1, $tglPelatihan->translatedFormat('l, d F Y'), '', 0, '', true, 0, false, false, 0);

      // tanggal sekarang
      $pdf::Ln((int) $pengaturan['margin_tanggal_now']);
      $nowInIndonesia = Carbon::now()->setTimezone('Asia/Jakarta');
      $pdf::setX(105);
      $pdf::Write(1, 'Tangerang Selatan' . ', ' . $nowInIndonesia->translatedFormat('d F Y'), '', 0, '', true, 0, false, false, 0);

      $pdf::SetFont('helvetica', 'B', $pengaturan['font_size_ttd']);
      foreach ($signature as $s) {
        $pdf::Ln((int) $pengaturan['margin_jabatan']);
        $pdf::setX(105);
        $pdf::Write(0, $s->sksignature->position, '', 0, '', true, 0, false, false, 0);
        $pdf::Ln((int) $pengaturan['margin_ttd']);
        $pdf::Image(public_path("img/sk-signature/" . $s->sksignature->image), 108, 240, 35, 35, '', '', '', false, 300, '', false, false, 0, true);
        $pdf::Ln((int) $pengaturan['margin_nameSignature']);
        $pdf::setX(105);
        $pdf::Write(0, $s->sksignature->prefixes . " " . $s->sksignature->name . " " . $s->sksignature->suffixes, '', 0, '', true, 0, false, false, 0);
      }

      $pdf::Output($filename . '.pdf', 'I');

      ob_end_flush();
    }
  }

  /**
   * Download SK Moderator.
   */
  public function moderator(Request $request, $id)
  {

    $training = TrainingModerator::where('id', $id)->with('training')->first();
    $moderator = TrainingModerator::where('id', $id)->with('moderator')->first();

    // ttd sk
    $signature = TrainingSKSignature::where('training_id', $training->training->id)->with('sksignature')->get();

    // type pelatihan
    $type = '';
    if ($training->training->t_type == 1) {
      $type = 'Webinar';
    } else {
      $type = 'Seminar';
    }

    // return $signature;

    if ($training && $moderator) {

      $pengaturan = collect([
        'margin_nomor' => 24,
        'font_size_nomor' => 12,
        'font_size_untuk' => 17,
        'margin_nama' => 21,
        'font_size_nama' => 14,
        'margin_type' => 45,
        'font_size_type' => 12,
        'margin_pelatihan' => 7,
        'font_size_pelatihan' => 12,
        'font_size_tanggal' => 14,
        'margin_tanggal' => 6,
        'margin_tanggal_now' => 45,
        'font_size_ttd' => 14,
        'margin_jabatan' => 5,
        'margin_ttd' => 23,
        'margin_nameSignature' => 7
      ]);

      $filename = 'sk' . '-' . $moderator->moderator->name . '-' . '0' . $training->id;


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
        $img_file = public_path('img/ecertificate/sk-ittsnews-mod.png');
        if (!File::exists($img_file)) {
          // check in server
          // $img_file = base_path('../sekolah.digiyok.com/img/ecertificate/template.png');
        }
        PDF::Image($img_file, 5, 0, 200, 0, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
        PDF::SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        PDF::setPageMark();
      });

      // set document information
      $pdf::SetCreator(PDF_CREATOR);
      $pdf::SetAuthor($moderator->moderator->name);
      $pdf::SetTitle('Surat Undangan' . ' - ' . $training->training->title . ' - ' . $training->training->name);
      $pdf::SetSubject(PDF_HEADER_TITLE);
      // $pdf::SetKeywords('PDF, e-certificate, certificate, SIT, Auliya');

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

      $pdf::AddPage('P');

      Carbon::setLocale('id');

      $pdf::SetTextColor(0, 0, 0);
      $pdf::Ln((int) $pengaturan['margin_nomor']);
      $pdf::SetFont('helvetica', '', $pengaturan['font_size_nomor']);
      $pdf::SetX(20);
      $pdf::Write(3, 'Kode       : ' . $training->invitation_code, '', 0, 'L', true, 0, false, false, 0);
      $pdf::SetX(20);
      $pdf::Write(1, 'Perihal    : ' . $type, '', 0, 'L', true, 0, false, false, 0);
      $pdf::SetFont('helvetica', '', $pengaturan['font_size_untuk']);
      $pdf::Ln((int) $pengaturan['margin_nama']);
      $pdf::SetFont('helvetica', 'B', $pengaturan['font_size_nama']);
      $pdf::SetX(19);
      $pdf::Write(0, $moderator->moderator->nameWithTitle, '', 0, '', true, 0, false, false, 0);
      $pdf::Ln((int) $pengaturan['margin_type']);
      $pdf::SetFont('helvetica', 'B', $pengaturan['font_size_type']);
      $pdf::SetX(20);
      $pdf::Write(9, $type . '.', '', 0, '', true, 0, false, false, 0);
      $pdf::Ln((int) $pengaturan['margin_pelatihan']);
      $pdf::SetFont('helvetica', 'B', $pengaturan['font_size_pelatihan']);
      $pdf::SetX(19);
      $title = strtoupper($training->training->title);
      $cellWidth = 160;
      $cellHeight = 20;
      $pdf::MultiCell($cellWidth, $cellHeight, $title, 0, 'L', false, 1, 19, '', true, 0, false, true, $cellHeight);

      // tanggal pelatihan
      $pdf::Ln((int) $pengaturan['margin_tanggal']);
      $pdf::SetFont('helvetica', '', $pengaturan['font_size_tanggal']);
      Date::setLocale('id');
      $tglPelatihan = Carbon::parse($training->training->t_date)->setTimezone('Asia/Jakarta');
      $pdf::setX(52);
      $pdf::Write(0, $tglPelatihan->translatedFormat('l, d F Y'), '', 0, '', true, 0, false, false, 0);

      // tanggal sekarang
      $pdf::Ln((int) $pengaturan['margin_tanggal_now']);
      $nowInIndonesia = Carbon::now()->setTimezone('Asia/Jakarta');
      $pdf::setX(105);
      $pdf::Write(2, 'Tangerang Selatan' . ', ' . $nowInIndonesia->translatedFormat('d F Y'), '', 0, '', true, 0, false, false, 0);

      $pdf::SetFont('helvetica', 'B', $pengaturan['font_size_ttd']);
      foreach ($signature as $s) {
        $pdf::Ln((int) $pengaturan['margin_jabatan']);
        $pdf::setX(105);
        $pdf::Write(0, $s->sksignature->position, '', 0, '', true, 0, false, false, 0);
        $pdf::Ln((int) $pengaturan['margin_ttd']);
        $pdf::Image(public_path("img/sk-signature/" . $s->sksignature->image), 108, 240, 35, 35, '', '', '', false, 300, '', false, false, 0, true);
        $pdf::Ln((int) $pengaturan['margin_nameSignature']);
        $pdf::setX(105);
        $pdf::Write(0, $s->sksignature->prefixes . " " . $s->sksignature->name . " " . $s->sksignature->suffixes, '', 0, '', true, 0, false, false, 0);
      }

      $pdf::Output($filename . '.pdf', 'I');

      ob_end_flush();
    }
  }
}
