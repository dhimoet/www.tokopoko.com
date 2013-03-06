<div class="container">
	<div id="progress_bar_container">
		<div class="progress progress-striped active">
  			<div class="bar" style="width: 100%;"></div>
		</div>
	</div>
	<div id="posts_container" class="hide"></div>
</div>

<script type="text/html" id="post_template">
	<div class="row">
		<div class="offset1 span5">
			<a href="<%= post.page_url %>" class="image_container img-polaroid" target="_blank">
				<img src="<%= post.image_url %>" />
			</a>		
		</div>
		<div class="span6">
			<h3><a href="http://www.facebook.com/<%= post.owner_id %>" target="_blank"><%= post.owner_name %></a></h2>
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
			url: '/home/ajax_get_posts',
			cache: true,
			dataType: 'json',
			success: function(response) {
				render_posts(response);
				reposition_images();
			}
		});
	});
	
	function render_posts(posts)
	{
		var template = $('#post_template').html();
		$.each(posts, function(key, value) {
			$('#posts_container').append(_.template(template, {
				post: value.attributes
			}));
		});
		$('#progress_bar_container').hide();
		$('#posts_container').fadeIn();
	}
	
	function reposition_images()
	{
		$.each($('.image_container img'), function(key, value) {
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
