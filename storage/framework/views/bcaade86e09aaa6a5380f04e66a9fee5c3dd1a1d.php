<?php $__env->startSection('content'); ?>


<br><br><br>
<!-- Error page content -->
		<section class="hg_section error404 mb-60">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="error404-content">
							<h2><span>404</span></h2>
							<h3>The page cannot be found.</h3>

							<!-- Search box -->
							<div class="elm-searchbox elm-searchbox--normal elm-searchbox--eff-typing mt-70">
								<!-- Search box wrapper -->
								<div class="elm-searchbox__inner">
									<form class="elm-searchbox__form" action="http://www.google.com/search" method="get" target="_blank">
										<input name="s" maxlength="30" class="elm-searchbox__input" type="text" size="20" value="" placeholder="">
										<span class="elm-searchbox__input-text"></span>
										<button type="submit" id="searchbox_submit" class="elm-searchbox__submit glyphicon glyphicon-search"></button>
										<div class="clearfix">
										</div>
									</form>
								</div>
								<!--/ Search box wrapper -->
							</div>
							<!--/ Search box -->
						</div>
					</div>
					<!--/ col-sm-12 -->
				</div><!-- end row -->
			</div><!-- end container -->
		</section>
		<!--/ Error page content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>