<?php

/*
Plugin Name: Custom Post Types - Controle de Estoque
Description: Post Types para a aplicação de Controle de Estoque
Author: Arthur Mastropietro
*/
wp_enqueue_style('admin_css_bootstrap', plugins_url('/estoque/css/bootstrap.min.css'), false, '1.0.0', 'all');
wp_enqueue_script('admin_js_bootstrap_hack', plugins_url('/scripts/scripts/bootstrap-hack.js'), false, '1.0.0', false);

add_action( 'init', 'custom_posttypes' );
add_action("admin_init", "admin_init");
add_action('save_post', 'salvar');

function custom_posttypes() {
	register_post_type( 'produtos',
		array(
			'labels' => array(
				'name' => 'Produtos',
				'singular_name' => 'Produto',
				'add_new' => 'Adicionar novo produto',
				'add_new_item' => 'Adicionar novo produto',	
			),
			'description' => 'Produtos',
			'public' => true,
			'show_ui' => true,
			'hierarchical' => false,
			'rewrite' => true,
			'supports' => array('title'),
			'show_in_menu'        => TRUE,
			'show_in_nav_menus'   => TRUE,
		)
	);
	
	register_post_type( 'clientes',
		array(
			'labels' => array(
				'name' => 'Clientes' ,
				'singular_name' => 'Cliente' ,
				'add_new' => 'Adicionar novo cliente',
				'add_new_item' => 'Adicionar novo cliente'
			),
			'description' => 'Clientes',
			'show_ui' => true,
			'public' => true,
			'hierarchical' => false,
			'rewrite' => true,
			'supports' => array('title')
		)
	);
	
	register_post_type( 'pedidos',
		array(
			'labels' => array(
				'name' => 'Pedidos',
				'singular_name' => 'Pedido',
				'add_new' => 'Adicionar novo pedido',
				'add_new_item' => 'Adicionar novo pedido'
			),
			'description' => 'Pedidos',
			'show_ui' => true,
			'public' => true,
			'hierarchical' => false,
			'rewrite' => true,
			'supports' => array('title')
		)
	);
	
}

function admin_init(){
	add_meta_box("produtoInfo-meta", "Dados do produto", "produtos", "produtos", "normal", "low");
	add_meta_box("clienteInfo-meta", "Dados do cliente", "clientes", "clientes", "normal", "low");
	add_meta_box("pedidoInfo-meta", "Dados do pedido", "pedidos", "pedidos", "normal", "low");
}

function pedidos(){
	 global $post;
	 //$custom = get_post_custom($post->ID);
	$produtos = new WP_Query( array( 'post_type' => 'produtos') ); ?>
	<div class="row">
		<div class="col-xs-4">
			<div class="form-group">
				<label for="pedido_produto">Produto:</label>
				<select id="pedido_produto" class="form-control" name="pedido_produto">
				<?php while ( $produtos->have_posts() ) : $produtos->the_post(); ?>
				<?php $produto = get_post_custom($post->ID); ?>
					<option value="<?php echo $post->ID; ?>"><?php echo $produto['nome_produto'][0]; ?></option>
				<?php endwhile;?>
				<?php wp_reset_query();  ?>
				</select>
			</div>
		</div>
	</div>
	<?php $clientes = new WP_Query( array( 'post_type' => 'clientes' ) ); ?>
	<div class="row">
		<div class="col-xs-4">
			<div class="form-group">
				<label for="pedido_cliente">Cliente:</label>
				<select id="pedido_cliente" class="form-control" name="pedido_cliente">
				<?php while ( $clientes->have_posts() ) : $clientes->the_post(); ?>
				<?php $cliente = get_post_custom($post->ID); ?>
					<option value="<?php echo $post->ID; ?>"><?php echo $cliente['nome_cliente'][0]; ?></option>
				<?php endwhile;?>
				<?php wp_reset_query();  ?>
				</select>
			</div>
		</div>
	</div>
	<?php
}


function produtos(){
	global $post;
	$custom = get_post_custom($post->ID);
	$nome_produto = $custom["nome_produto"][0];
	$preco_produto = $custom["preco_produto"][0];
	$descricao_produto = $custom["descricao_produto"][0];
	?>
	<div class="row">
		<div class="col-xs-4">
			<div class="form-group">
				<label for="nome_produto">Nome:</label>
				<input id="nome_produto" class="form-control" name="nome_produto" value="<?php echo $nome_produto; ?>" placeholder="Nome do produto"/>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-4">
			<div class="form-group">
				<label for="descricao_produto">Descrição</label>
				<textarea name="descricao_produto" rows="5" class="form-control" id="descricao_produto" placeholder="Descrição do produto"><?php echo $descricao_produto; ?></textarea>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-2">
			<div class="form-group">
				<label for="preco_produto">Preço:</label>
				 <div class="input-group">
				 	<div class="input-group-addon">$</div>
					<input id="preco_produto" class="form-control" name="preco_produto" placeholder="Preço do produto" value="<?php echo $preco_produto; ?>" />
				</div>
			</div>
		</div>
	</div>
<?php
}

function clientes(){
	global $post;
	$custom = get_post_custom($post->ID);
	$nome_cliente = $custom["nome_cliente"][0];
	$email_cliente = $custom["email_cliente"][0];
	$telefone_cliente = $custom["telefone_cliente"][0];
	?>
	<div class="row">
		<div class="col-xs-4">
			<div class="form-group">
				<label for="nome_cliente">Nome:</label>
				<input id="nome_cliente" class="form-control" name="nome_cliente" value="<?php echo $nome_cliente; ?>" placeholder="Nome do cliente"/>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-4">
			<div class="form-group">
				<label for="email_cliente">Email</label>
				<input id="email_cliente" class="form-control" name="email_cliente" placeholder="Email do cliente" value="<?php echo $email_cliente; ?>" />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-2">
			<div class="form-group">
				<label for="telefone_cliente">Telefone:</label>
				<input id="telefone_cliente" class="form-control" name="telefone_cliente" placeholder="Telefone do cliente" value="<?php echo $telefone_cliente; ?>" />
			</div>
		</div>
	</div>
<?php
}
 
 
function salvar(){
	//print_r($_POST); exit;
    global $post;
	if ( isset( $_POST['nome_produto'] ) ) {
		update_post_meta( $post->ID, 'nome_produto', sanitize_text_field( $_POST['nome_produto'] ) );
	}
	if ( isset( $_POST['descricao_produto'] ) ) {
		update_post_meta( $post->ID, 'descricao_produto', sanitize_text_field( $_POST['descricao_produto'] ) );
	}
	if ( isset( $_POST['preco_produto'] ) ) {
		update_post_meta( $post->ID, 'preco_produto', sanitize_text_field( $_POST['preco_produto'] ) );
	}
	if ( isset( $_POST['nome_cliente'] ) ) {
		update_post_meta( $post->ID, 'nome_cliente', sanitize_text_field( $_POST['nome_cliente'] ) );
	}
	if ( isset( $_POST['telefone_cliente'] ) ) {
		update_post_meta( $post->ID, 'telefone_cliente', sanitize_text_field( $_POST['telefone_cliente'] ) );
	}
	if ( isset( $_POST['email_cliente'] ) ) {
		update_post_meta( $post->ID, 'email_cliente', sanitize_text_field( $_POST['email_cliente'] ) );
	}
	if ( isset( $_POST['pedido_cliente'] ) ) {
		update_post_meta( $post->ID, 'pedido_cliente', sanitize_text_field( $_POST['pedido_cliente'] ) );
	}
	if ( isset( $_POST['pedido_produto'] ) ) {
		update_post_meta( $post->ID, 'pedido_produto', sanitize_text_field( $_POST['pedido_produto'] ) );
	}
}