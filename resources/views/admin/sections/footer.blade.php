
		<footer class="footer">
				<span class="text-right">
				Copyright <a target="_blank" href="#">SK Laravel</a>
				</span>
			<span class="float-right">
				Powered by <a target="_blank" href=""><b>SK Laravel</b></a>
				</span>
		</footer>
	</div>
<!-- END main -->

{{--<script src="{{url('js/modernizr.min.js')}}"></script>--}}
<script src="{{url('js/jquery.min.js')}}"></script>

<script src="{{url('js/popper.min.js')}}"></script>
<script src="{{url('js/bootstrap.min.js')}}"></script>

<script src="{{url('js/detect.js')}}"></script>
<script src="{{url('js/fastclick.js')}}"></script>
{{--<script src="{{url('js/jquery.blockUI.js')}}"></script>--}}
<script src="{{url('js/jquery.nicescroll.js')}}"></script>
{{--<script src="{{url('js/jquery-ui.min.js')}}"></script>--}}

<!-- App js -->
<script src="{{url('js/script.js')}}"></script>

<!-- BEGIN Java Script for this page -->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<!--file manager-->
<script>
	var route_prefix = "{{ url(config('lfm.url_prefix', config('lfm.prefix'))) }}";
	{!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
	$('#lfm2').filemanager('image', {prefix: route_prefix});
	$('#lfm').filemanager('file', {prefix: route_prefix});

	$(document).ready(function(){
		// Define function to open filemanager window
		var lfm = function(options, cb) {
			var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
			window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
			window.SetUrl = cb;
		};
	});
</script>
@yield('scripts')
</body>
</html>