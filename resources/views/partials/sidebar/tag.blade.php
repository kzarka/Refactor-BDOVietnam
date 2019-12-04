		<div id="tag_cloud-2" class="widget widget_tag_cloud">
            <h4 class="widgettitle">Tags</h4>
            <div class="tagcloud">
            	@forelse($top_tags as $top_tag)
                <a href='{{ $top_tag->url }}' class='tag-link-34 tag-link-position-1' title='1 topic' style='font-size: 8pt;'>{{ $top_tag->name }}</a>
                @empty
            	@endforelse
            </div>
        </div>