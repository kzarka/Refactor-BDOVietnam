        <div id="powerup_comment_excerpt_widget-2" class="widget powerup_comment_excerpt_widget">
            <h4 class="widgettitle">Bình Luận Mới</h4>            
            <ul class="custom-comments-widget">
                @forelse($recent_comments as $recent_comment)
                @php $this_post = $recent_comment->post; @endphp
                <li>
                    <a href="{{ $this_post->url }}#comment-{{$recent_comment->id}}" rel="external nofollow">
                        <div class="custom-comments-widget-wrapper">
                            <span class="widget-comment-author">{{ $recent_comment->author ? ($recent_comment->author->fullname ?? $recent_comment->author->username) : $recent_comment->name  }}</span>
                            <span class="widget-comment-excerpt">{{ $recent_comment->comment }}</span>
                            <span class="widget-comment-title"><span class="widget-comment-title-prefix">Trong: </span> {{ $this_post->title }}</span>
                        </div>
                    </a>
                </li>
                @empty
                @endforelse
            </ul>
        </div>