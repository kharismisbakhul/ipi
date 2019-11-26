$('.logout').on('click', function () {
	Swal.fire({
		title: 'Anda yakin?',
		text: "",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Logout'
	}).then(function (result) {
		if (result.value) {
			window.location = window.location.origin + "/IpiApps/auth/logout";
		}
	})
});

$('.delete-user').on('click', function () {
	var a = $('.delete-user').attr('value');
	Swal.fire({
		title: 'Anda yakin?',
		text: "",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Hapus'
	}).then(function (result) {
		if (result.value) {
			window.location = window.location.origin + "/IpiApps/admin/deleteUser/" + a;
		}
	})
});
