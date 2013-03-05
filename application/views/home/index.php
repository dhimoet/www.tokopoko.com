<div class="container">
	<noscript>
		<?foreach($posts as $post) {?>
		<div class="row">
			<div class="span12 post">
				<a href="<?=$post->page_url?>" class="image" target="_blank">
					<img src="<?=$post->image_url?>" />
				</a>		
			</div>
		</div>
		<?}?>
	</noscript>
	<div id="progress_bar_container">
		<div class="progress progress-striped active">
  			<div class="bar" style="width: 100%;"></div>
		</div>
	</div>
	<div id="posts_container"></div>
</div>

<script>
	$(document).ready(function() {
		// get posts
		$.ajax({
			url: '/home/ajax_get_posts',
			dataType: 'json',
			success: function(response) {
				render_posts(response);
			}
		});
	});
	
	function render_posts(posts)
	{
		$.each(posts, function(key, value) {
			$('#posts_container').append('<div class="row"><div class="span12 post"><a href="'+value.attributes.page_url+'" class="image" target="_blank"><img src="'+value.attributes.image_url+'" /></a></div></div>');
		});
		$('#progress_bar_container').hide();
		$('#posts_container').fadeIn();
	}
</script>
