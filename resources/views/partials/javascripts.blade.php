<script src="https://cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

{{--<script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>--}}
{{--<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>--}}


<script src="{{ url('adminlte/js') }}/main.js"></script>

<script src="{{ url('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ url('adminlte/js') }}/bootstrap.min.js"></script>
<script src="{{ url('adminlte/js') }}/main.js"></script>
<script src="{{ url('adminlte/js') }}/select2.full.min.js"></script>
<script src="{{ url('layer/layer.js')}}"></script>



<script src="{{ url('adminlte/js/app.min.js') }}"></script>
<script>
    window._token = '{{ csrf_token() }}';
</script>


@yield('javascript')