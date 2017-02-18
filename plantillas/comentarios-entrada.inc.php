	<div class="row">
		<div class="col-md-12">
			<button class="btn btn-default form-control" data-toggle="collapse" data-target="#comentarios">
				<?php  
					echo "Ver comentarios (" . count($comentarios) . ")";
				?>
			</button>
			<br>
			<br>
			<div id="comentarios" class="collapse">
				<?php
					for ($i = 0; $i < count($comentarios); $i++) 
					{ 
						$comentario = $comentarios[$i];
						?>
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">
											<?php
												echo $comentario -> getTitulo();
											?>
										</div>
										<div class="panel-body">
											<div class="col-md-2">
												<?php
													echo $comentario -> getAutorID();
												?>
											</div>
											<div class="col-md-10 text-justify">
												<p>
													<?php
														echo $comentario -> getFecha();
													?>
												</p>
												<p>
													<?php
														echo nl2br($comentario -> getTexto());
													?>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php
					}
				?>
			</div>
		</div>
	</div>