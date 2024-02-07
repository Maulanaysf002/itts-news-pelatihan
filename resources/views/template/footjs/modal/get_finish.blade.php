<script>
  function finishTrainingModal(title, item, finish_url) {
    $('#finishTraining-confirm').modal('show', {
      backdrop: 'static',
      keyboard: false
    });
    $("finishTraining-confirm .title").text(title);
    $("finishTraining-confirm .item").text(item);
    $('#finishTraining-link').attr("action", finish_url);
  }
</script>
