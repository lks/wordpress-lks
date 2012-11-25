				<div id="sidebar2" class="sidebar four columns" role="complementary">

					<div class="panel">
				
						<?php if ( is_active_sidebar( 'sidebarlks' ) ) : ?>

							<?php dynamic_sidebar( 'sidebarlks' ); ?>

						<?php else : ?>

							<!-- This content shows up if there are no widgets defined in the backend. -->
							
							<p>Please activate some Widgets.</p>

						<?php endif; ?>

					</div>

				</div>