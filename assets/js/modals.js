$('#info').click(function (event) {
	$('#moreinfoTittle').on('shown.bs.modal', function () {
    	$('#myInput').trigger('focus');
	});
});