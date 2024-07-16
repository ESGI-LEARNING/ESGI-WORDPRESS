jQuery(document).ready(function ($) {
	$(document).on('click', '.pagination a', function (event) {
		event.preventDefault();
		const page_url = $(this).attr('href');
		loadPosts(page_url);
	});

	function loadPosts(page_url) {
		$.ajax({
			url: page_url,
			type: 'get',
			beforeSend: function () {
			},
			success: function (data) {
				const newContent = $(data).find('.articles');

				$('.articles').html(newContent);
				$('.pagination').html($(data).find('.pagination').html());
			},
			complete: function () {
			}
		});
	}
});
  