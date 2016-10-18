<?php /* Template Name: Pedidos */ ?>

<?php get_header(); ?>
<?php $loop = new WP_Query( array( 'post_type' => 'pedidos')); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-6">
			<h1>Todos os pedidos</h1>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-12">
			<?php if(!$loop->have_posts()) : ?>
			<div class="alert alert-warning" role="alert">
				<p>Nenhum pedido cadastrado.</p>
			</div>
			<?php endif; ?>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>Produto</th>
							<th>Cliente</th>
						</tr>
					</thead>
					<tbody>
						<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<?php $pedido = get_post_custom($post->ID); ?>
						<?php $produto = get_post($pedido["pedido_produto"][0]); ?>
						<?php $produto = get_post_custom($produto->ID); ?>
						<?php $cliente = get_post($pedido["pedido_cliente"][0]); ?>
						<?php $cliente = get_post_custom($cliente->ID); ?>
						<tr>
							<td><?php echo $produto['nome_produto'][0]; ?></td>
							<td><?php echo $cliente['nome_cliente'][0]; ?></td>
						</tr>
						<?php endwhile;?>
						<?php wp_reset_query();  ?>
					</tbody>
				</table>
			</div><!--end .table-responsive -->
		</div>
	</div>
</div>
