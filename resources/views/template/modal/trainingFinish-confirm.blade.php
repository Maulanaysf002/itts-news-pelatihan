<div class="modal fade" id="traininFinish-confirm" role="dialog" aria-labelledby="selesaikanPelatihan" aria-hidden="true"
  tabindex="-1" style="display: none;">
  <div class="modal-dialog modal-confirm" role="document">
    <div class="modal-content">
      <div class="modal-header flex-column">
        <div class="icon-box border-brand-green-dark">
          <i class="material-icons text-brand-green-dark">&#xE5CA;</i>
        </div>
        <h4 class="modal-title w-100">Apakah Anda yakin?</h4>
        <button class="close" data-dismiss="modal" type="button" aria-hidden="true">&times;</button>
      </div>

      <div class="modal-body p-1">
        Apakah Anda yakin ingin menyelesaikan <span class="item font-weight-bold">pelatihan</span>
      </div>
      <div class="modal-body p-1">
        <span class="item font-weight-bold">data pelatihan tidak akan bisa di edit jika Anda klik selesaikan</span>
      </div>

      <div class="modal-footer justify-content-center">
        <button class="btn btn-light mr-1" data-dismiss="modal" type="button">Tidak</button>
        <form id="finishTraining-link" action="#" method="post">
          {{ csrf_field() }}
          {{ method_field('put') }}
          <button class="btn btn-warning" type="submit">Ya, Selesaikan</button>
        </form>
      </div>
    </div>
  </div>
</div>
