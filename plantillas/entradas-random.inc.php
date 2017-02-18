	<?php
		include_once 'app/EscritorEntradas.inc.php';
	?>

	<div class="row">
		<div class="col-md-12">
			<hr>
			<h3>Tambien te pueden interesar estas otras entradas</h3>
		</div>

		<?php
			for ($i=0; $i < count($entradasRandom); $i++) 
			{ 
				$entradaActual = $entradasRandom[$i];
		?>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<?php 
							echo $entradaActual -> getTitulo(); 
						?>
					</div>
					<div class="panel-body text-justify" >
						<p>
							<?php 
								echo EscritorEntradas :: resumirTexto(nl2br($entradaActual -> getTexto()));
							?>
						</p>
						<div class = "text-right">
							<a href = "<?php echo RUTA_ENTRADA.'/'.$entradaActual->getURL()?>" class = "btn btn-default" role = "button">Seguir leyendo</a>
						</div>
					</div>
				</div>
			</div>
		<?php
			}
		?>
		<div class="col-md-12">
			<hr>
		</div>
	</div>