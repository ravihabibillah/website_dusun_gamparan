$(document).ready(function () {
	$('#blog').summernote({
		placeholder: 'Tulis artikel di sini...',
		tabsize: 2,
		callbacks: {
            onImageUpload: function(image) {
                uploadImage(image[0]);
            },
            onMediaDelete : function(target) {
                deleteImage(target[0].src);
            }
        }
	});

	$('.summernote').summernote({
		placeholder: 'Tulis di sini...',
		tabsize: 2,
		height: 300
	});

	// Put foto on canvas
	$('#upload-foto').on('change', function () {
		var img = new Image();
		var canvas = document.getElementById('canvas-foto-preview');

		var ctx = canvas.getContext('2d');
		var fileName = '';
		var file = document.querySelector('#upload-foto').files[0];
		var reader = new FileReader();

		if (file) {
			fileName = file.name;
			reader.readAsDataURL(file);
		}

		reader.addEventListener('load', function () {
			img = new Image();
			img.src = reader.result;
			img.onload = function () {
				canvas.width = 128;
				canvas.height = 128;
				ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
			};
		});
	});

	$('#remove-foto').on('click', function () {
		var img = new Image();
		var canvas = document.getElementById('canvas-foto-preview');
		var ctx = canvas.getContext('2d');
		canvas.width = "128";
		canvas.height = "128";
		ctx.clearRect(img, 0, 0, canvas.width, canvas.height);
	});

	// Put logo on canvas
	$('#upload-logo').on('change', function () {
		var img = new Image();
		var canvas = document.getElementById('canvas-logo-preview');
		var ctx = canvas.getContext('2d');
		var fileName = '';
		var file = document.querySelector('#upload-logo').files[0];
		var reader = new FileReader();

		if (file) {
			fileName = file.name;
			reader.readAsDataURL(file);
		}

		reader.addEventListener('load', function () {
			img = new Image();
			img.src = reader.result;
			img.onload = function () {
				canvas.width = img.width*0.2;
				canvas.height = img.height*0.2;
				ctx.scale(0.2, 0.2);
				ctx.drawImage(img, 0, 0, img.width, img.height);
			};
		});
	});

	$('#remove-logo').on('click', function () {
		var img = new Image();
		var canvas = document.getElementById('canvas-logo-preview');
		var ctx = canvas.getContext('2d');
		canvas.width = "128";
		canvas.height = "128";
		ctx.clearRect(img, 0, 0, canvas.width, canvas.height);
	});

	// date picker
	$('#tanggal_display').datepicker({
		format: "dd/mm/yyyy",
        todayBtn: "linked",
        todayHighlight: true,
        keyboardNavigation: true,
        forceParse: false,
        calendarWeeks: false,
        autoclose: true
    }).on('changeDate', function (e) {
    	$('#tanggal').val(e.format("mm/dd/yyyy"));
    });

    // remove file input from add_more
    $('.remove_file').on('click', function(e) {
	    e.preventDefault();
	    $(this).parent().remove();
	    $(this).fileinput('clear');
	});

	// change status
	$('.toggle_status').on('click', function () {
		var id = $(this).data('id');
		var url = window.location.href + 'toggle_status/';

		if (window.location.pathname != "/polairud_app/menus/") {
			url = window.location.origin + '/polairud_app/menus/toggle_status/';
		}

		$.ajax({
			url: url,
			type: 'post',
			data: {id: id},
			success: function() {
				location.reload(false);
			}
		});
	});

	// chosen select
	$('.chosen-select').chosen({width: "100%"});
});

function uploadImage(image) {
	var id = $(this).data('id');
	var data = new FormData();
    var url = window.location.href + '/../../uploadImage/';
    data.append('image', image);
    $.ajax({
        url: url,
        type: 'post',
        contentType: false,
        processData: false,
        cache: false,
        data: data,
        success: function(url) {
        	var image = $('<img>').attr('src', url);
        	$('#blog').summernote("insertNode", image[0]);
            // $('#blog').summernote("insertImage", url);
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function deleteImage(src) {
	var url = window.location.href + '/../../deleteImage/';
    $.ajax({
        data: {src: src},
        type: "POST",
        url: url,
        cache: false,
        success: function(response) {
            console.log(response);
        }
    });
}