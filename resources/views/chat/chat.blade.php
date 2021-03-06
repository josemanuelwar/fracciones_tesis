<div class="container">
	<button  class="btn btn-primary" id="chatid">chat</button>
	<div style="display: none;" id="bodyid">
		holas
	</div>
</div>
<script type="text/javascript">
	let boton=document.getElementById('chatid');
	boton.addEventListener('click',function (a) {
		// body...
		let contenido = document.getElementById('bodyid');
		contenido.style.display="block";
		console.log("jose");
		boton.style.display="none";
	});
</script>
