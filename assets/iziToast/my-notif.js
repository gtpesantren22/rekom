  /* Default Notifications */

const flashData = $('.flash-data').data('flashdata');
const flashDataError = $('.flash-data-error').data('flashdata');

if (flashData) {
	iziToast.success({
		title: 'Berhasil',
		message: flashData,
		position: 'topRight',
	});
}
if (flashDataError) {
	iziToast.error({
		title: 'Gagal',
		message: flashDataError,
		position: 'topRight',
	});
}

$('.tombol-hapus').on('click', function (e) {
	
	e.preventDefault();
	const hreh = $(this).attr('href');

	iziToast.question({
    timeout: 20000,
    close: false,
    overlay: true,
    displayMode: 'once',
    id: 'question',
    zindex: 999,
    title: 'Hapus Data',
    message: 'Yakin data ini akan dihapus?',
    position: 'center',
    buttons: [
        ['<button><b>YES</b></button>', function (instance, toast) {
            document.location.href = hreh
        }, true],
        ['<button>NO</button>', function (instance, toast) {
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
        }],
    ],
});
	
});

$('.tbl-confirm').on('click', function (e) {
	
	e.preventDefault();
	const hreh = $(this).attr('href');
	const isi = $(this).attr('value');

	iziToast.question({
		timeout: 20000,
		close: false,
		overlay: true,
		displayMode: 'once',
		id: 'question',
		zindex: 999,
		title: 'Yakin ?',
		message: isi,
		position: 'center',
		buttons: [
			['<button><b>YES</b></button>', function (instance, toast) {
				document.location.href = hreh
			}, true],
			['<button>NO</button>', function (instance, toast) {
				instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
			}],
		],
	});
	
});