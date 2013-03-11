<div class="container">
	<div class="row">
		<div class="span3">
			<ul class="nav nav-list">
				<li class="nav-header">What Would You Like to Know?</li>
				<li class="<?=URI::segment(2)=='about'?'active':''?>"><a href="/help/about">About TokoPoko</a></li>
			</ul>
		</div>
		<div class="span9">
			<?=View::make($body, $data)?>
		</div>
	</div>
</div>