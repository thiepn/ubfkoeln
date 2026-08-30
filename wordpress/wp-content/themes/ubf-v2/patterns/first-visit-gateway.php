<?php
/**
 * Title: First-visit gateway
 * Slug: ubf-v2/first-visit-gateway
 * Categories: featured, call-to-action
 * Keywords: visit, directions, service, first visit
 * Viewport Width: 1280
 * Inserter: true
 */
?>
<!-- wp:group {"align":"full","backgroundColor":"navy","textColor":"white","className":"ubf-section--compact","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull ubf-section--compact has-white-color has-navy-background-color has-text-color has-background">
	<!-- wp:columns {"align":"wide","verticalAlignment":"center"} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"46%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:46%">
			<!-- wp:paragraph {"className":"ubf-eyebrow","style":{"color":{"text":"#FFFFFF"}}} -->
			<p class="ubf-eyebrow has-text-color" style="color:#FFFFFF"><?php esc_html_e( 'Dein erster Besuch', 'ubf-v2' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":2,"textColor":"white","fontSize":"2-xl"} -->
			<h2 class="wp-block-heading has-white-color has-text-color has-2-xl-font-size"><?php esc_html_e( 'Alles Wichtige vor dem Gottesdienst.', 'ubf-v2' ); ?></h2>
			<!-- /wp:heading -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:paragraph {"fontSize":"md"} -->
			<p class="has-md-font-size"><?php esc_html_e( 'Auf der Besuchsseite stehen die verifizierten Informationen zu Zeit, Ort, Anfahrt und Ablauf an einer Stelle.', 'ubf-v2' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button {"backgroundColor":"white","textColor":"navy"} -->
				<div class="wp-block-button"><a class="wp-block-button__link has-navy-color has-white-background-color has-text-color has-background wp-element-button" href="/besuchen/"><?php esc_html_e( 'Gottesdienst besuchen', 'ubf-v2' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
