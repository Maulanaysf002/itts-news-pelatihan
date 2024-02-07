	<script>	
	$('.input-group.date.end-today').datepicker({
        format: 'dd MM yyyy',
        autoclose: true,
        todayHighlight: true,
        todayBtn: 'linked',
		endDate: new Date(),
	});
    </script>
