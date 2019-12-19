		<div class="widget widget_tag_cloud">
            <h4 class="widgettitle">Tags</h4>
            <div class="tagcloud">
            	@forelse($top_tags as $top_tag)
                <a href='{{ $top_tag->url }}' title='{{ $top_tag->posts->count() }} bài viết' style='font-size: 8pt;'>{{ $top_tag->name }}</a>
                @empty
            	@endforelse
            	<a href="{{ route('tag') }}" title="xem thêm" style='font-size: 8pt;'>...</a>
            </div>
        </div>