</div>
<!-- Footer -->
<footer class="bg-light text-center text-lg-start">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © Realizado por jose manuel Sanchez juarez
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
        
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