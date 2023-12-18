    <script src="{{ URL::asset('public/assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/metismenu.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/waves.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/feather.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/simplebar.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/moment.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script>
        let _token = $('meta[name="csrf-token"]').attr('content');
        function sendMarkRequest(id = null) {
            return $.ajax("{{ route('markNotification') }}", {
                method: 'POST',
                data: {
                    _token,
                    id
                }
            });
        }
        $(function() {
			$('.mark-as-read').click(function() {
				let request = sendMarkRequest($(this).data('id'));
				request.done(() => {
					$(this).parents('div.alert').remove();
				});
			});
			$('#mark-all').click(function() {
				let request = sendMarkRequest();
				request.done(() => {
					$('div.alert').remove();
				})
			});
		});
    </script>
@yield('script')
