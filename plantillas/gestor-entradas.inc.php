	<div class="row seccion-gestor-entradas">
		<div class="col-md-12">
			<h2>Gestion de las entradas</h2>
			<br>
			<div class = "text-right">
				<a href="<?php echo RUTA_NUEVA_ENTRADA?>" class="btn btn-lg btn-default" role="button">Crear Entrada</a>
			</div>
			<br>
			<br>
		</div>
	</div>
	<div class="row seccion-gestor-entradas">
		<div class="col-md-12">
			<?php
				if(count($arrayEntradas) > 0)
				{
					?>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Fecha</th>
								<th>Título</th>
								<th>Estado</th>
								<th>Comentarios</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody">
							<?php
								for ($i = 0; $i < count($arrayEntradas); $i++) { 
									$entradaActual = $arrayEntradas[$i][0];
									$comentariosEntradaActual = $arrayEntradas[$i][1];
									?>
										<tr>
											<td><?php echo $entradaActual -> getFecha()?></td>
											<td><?php echo $entradaActual -> getTitulo()?></td>
											<td><?php echo $entradaActual -> getActiva()?></td>
											<td><?php echo $comentariosEntradaActual?></td>
											<td>
												<button type="button" class="btn btn-default btn-sm">Editar</button>
												<button type="button" class="btn btn-default btn-sm">Borrar</button>
											</td>
										</tr>
									<?php
								}
							?>
						</tbody>
					</table>
				<?php
				}else{
				?>
					<h3 class="text-center">Todavia no has escrito ninguna entrada</h3>
					<br>
					<br>
				<?php
				}
			?>
			
		</div>
	</div>