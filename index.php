<?php get_header(); ?>

<body <?php body_class(); ?>>
	<?php get_template_part('content', 'menu'); ?>

	<main class="main main-col" ontouchstart="">
		<section class="block" id="coding">
			<div class="block-head">
				<h2 class="block-head__header">ようこそ</h2>
			</div>

			<div class="block-col post">
				<div class="post__text">
					<h2>index.php</h2>

					<p>このページはindex.phpファイルのページです。</p>
					<p>いわゆるエラーページです。</p>
				</div>
			</div>
		</section>
	</main><!-- /main -->

<?php get_footer(); ?>