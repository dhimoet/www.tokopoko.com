<div class="container">
	<div id="progress_bar_container">
		<h3>Loading...</h3>
		<div class="progress progress-striped active">
  			<div class="bar" style="width: 100%;"></div>
		</div>
	</div>
	<div id="posts_container"></div>
</div>

<script type="text/html" id="post_template">
	<div class="row hide">
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
				$('#progress_bar_container').hide();
				render_posts(response);
			}
		});
	});
	
	function render_posts(posts)
	{
		var template = $('#post_template').html();
		// put in the template
		$.each(posts, function(key, value) {
			$('#posts_container').append(_.template(template, {
				post: value.attributes,
				user: value.relationships.user.attributes
			}));
			// display and resize
			$('#posts_container').find('.row').last().fadeIn(function() {
				reposition_images($(this).find('img'));
			});
		});
	}
	
	function reposition_images($img)
	{
		// check image size
		if($img.width() > 400) {
			// reposition to center
			to_left = -1*($img.width() - 400)/2;
			$img.css({position: 'relative', left: to_left});
		}
		else if($img[0].naturalHeight > 400) {
			// expand tall image
			$img.width(400);
			$img.height('auto');
		}
	}
</script>
