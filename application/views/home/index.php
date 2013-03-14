<div class="container">
	<div id="progress_bar_container">
		<h3>Loading...</h3>
		<div class="progress progress-striped active">
  			<div class="bar" style="width: 100%;"></div>
		</div>
	</div>
	<div id="posts_container" class="hide"></div>
</div>

<script type="text/html" id="post_template">
	<div class="row">
		<div class="span6">
			<a href="<%= post.page_url %>" class="container post-image-container img-polaroid" target="_blank">
				<img src="<%= post.image_url %>" />
			</a>		
		</div>
		<div class="span6">
			<h3><a href="/home/user/<%= user.username %>"><%= user.display_name %></a></h2>
			<h2><%= post.image_name %></h2>
			<h2><small><%= post.location %></small></h2>
		</div>
	</div>
	<br />
</script>

<script>
	$(document).ready(function() {
		// get posts
		$.ajax({
			url: "/home/ajax_get_posts<?=isset($nocache)? '/?nocache=1' : '' ?>",
			cache: true,
			async: true,
			dataType: 'json',
			success: function(response) {
				render_posts(response);
			}
		});
	});
	
	function render_posts(posts)
	{
		var template = $('#post_template').html();
		$.each(posts, function(key, value) {
			$('#posts_container').append(_.template(template, {
				post: value.attributes,
				user: value.relationships.user.attributes
			}));
		});
		$('#progress_bar_container').hide();
		$('#posts_container').fadeIn();
		reposition_images();
	}
	
	function reposition_images()
	{
		$.each($('.post-image-container img'), function(key, value) {
			// reposition to center
			if(value.width > 400) {
				$(value).css({position: 'relative', left: -65});
			}
			// expand tall image
			else if(value.naturalHeight > 400) {
				$(value).width(400);
				$(value).height('auto');
			}
		});
	}
</script>
