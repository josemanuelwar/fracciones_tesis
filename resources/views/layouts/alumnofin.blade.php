</section>

<footer>
    <a href="http://www.cs.buap.mx/" target="_blank" rel="noopener noreferrer"><h1>Facultad de ciencias de la computacion buap</h1></a>
    Desarrollado por jose manuel sanchez jaures para octener el titulo de ingenieria en ciencias de la computacion
</footer>
        
</body>
</html>
<script src="{{asset('admin/js/jquery-3.5.1.js')}}" crossorigin="anonymous"></script>
<script>
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
 </script>