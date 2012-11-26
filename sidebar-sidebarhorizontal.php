				<div id="sidebarhorizontal" class="sidebar twelve columns" role="complementary">

					<?php if ( is_active_sidebar( 'sidebarhorizontal' ) ) : ?>

						<?php dynamic_sidebar( 'sidebarhorizontal' ); ?>

					<?php else : ?>

						<!-- This content shows up if there are no widgets defined in the backend. -->
						
						<p>Please activate some Widgets.</p>

					<?php endif; ?>
				</div>