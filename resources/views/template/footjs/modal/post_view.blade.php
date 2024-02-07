<script>
    function viewModal(modal,route,id) {
        $('#'+modal+' .modal-load').show();
        $('#'+modal+' .modal-body').hide();
            
        $.post(route,
        {
           '_token': $('meta[name=csrf-token]').attr('content'),
            id: id
        },
        function(response) {
            $('#'+modal+' .modal-body').html(response);
            $('#'+modal+' .modal-load').hide();
            $('#'+modal+' .modal-body').show();
        });
    }
</script>
