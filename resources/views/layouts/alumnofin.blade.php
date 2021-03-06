@include('chat.chat')
<footer class="bg-white text-center text-black-50 py-3 shadow">
       {{ config('app.name')}} | copyright @ {{date('Y')}}
</footer>
</div>
</body>
</html>
<script src="{{asset('admin/js/jquery-3.5.1.js')}}" crossorigin="anonymous"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script>
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
 </script>