<div class="container">
	<div class="row">
		<div class="span3">
			<ul class="nav nav-list">
				<li class="nav-header">Apa yang ingin anda tahu?</li>
				<li class="<?=URI::segment(2)=='about'?'active':''?>"><a href="/help/about">Tentang TokoPoko</a></li>
				<li class="<?=URI::segment(2)=='howto'?'active':''?>"><a href="/help/howto">Cara Pakai</a></li>
				<li class="<?=URI::segment(2)=='rules'?'active':''?>"><a href="/help/rules">Aturan Pakai</a></li>
				<li class="<?=URI::segment(2)=='contact'?'active':''?>"><a href="/help/contact">Hubungi Kami</a></li>
			</ul>
		</div>
		<div class="span9">
			<?=View::make($body, $data)?>
		</div>
	</div>
</div>