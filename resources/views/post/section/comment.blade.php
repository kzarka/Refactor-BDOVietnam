        <div id="comments" class="commentwrap">
            <div class="comments-wrapper">
            <!-- BEGIN COMMENTS -->
                <!-- BEGIN COMMENT COUNT -->
                <div class="comm-count">
                    <span>{{ $post->comments()->count() }} bình luận</span>
                </div>
                <!-- END COMMENT COUNT -->
                <ol class="commentlist">
                    @forelse($comments as $comment)
                    @php $author = $comment->author; 
                    $author_name = ($author) ? ($author->fullname ?? $author->username) : $comment->name;
                    @endphp
                    @if($children = $comment->children)
                    <li id="comment-{{ $comment->id }}" data-id="{{ $comment->id }}" class="comment byuser comment-author-wohoo @if($author && $author->id == $post->author_id) bypostauthor @endif odd alt thread-odd thread-alt depth-1">
        
                    <!-- begin comment entry -->
                        <div class="comment-entry">
                            <p>{{ $comment->comment }}</p>
                            <div class="comment-author-wrapper">
                                <img alt="" src="{{ asset('assets/images/user/default.png') }}" class="avatar avatar-60 photo" height="60" width="60">                        
                                <div class="comment-author-inner">
                                    <span class="comment-author">{{ ($author) ? ($author->fullname ?? $author->username) : $comment->name }}</span>
                                    <span class="comm-divider">|</span>
                                    <span class="comment-time">{{ $comment->created_from }}</span>
                                    <span class="comm-divider">|</span>
                                    <a rel="nofollow" class="comment-reply-link" href="javascript:void(0)"  aria-label="Reply to {{ ($author) ? ($author->fullname ?? $author->username) : $comment->name }}">Trả lời</a>
                                </div>
                            </div>
                        </div>
                        <!-- end comment entry -->
                        <ul class="children">
                            @foreach($children as $child)
                            @php $chid_author = $child->author; 
                            $child_author_name = ($chid_author) ? ($chid_author->fullname ?? $chid_author->username) : $child->name;
                            @endphp
                            <li id="comment-{{ $comment->id }}" class="comment byuser comment-author-wohoo @if($chid_author && $chid_author->id == $post->author_id) bypostauthor @endif even depth-2">
                            <!-- begin comment entry -->
                                <div class="comment-entry">
                                    <p>{{ $child->comment }}</p>
                                    
                                    <div class="comment-author-wrapper">
                                        <img alt="" src="{{ asset('assets/images/user/default.png') }}" class="avatar avatar-60 photo" height="60" width="60">
                                        <div class="comment-author-inner">
                                            <span class="comment-author">{{ $child_author_name }}</span>
                                            <span class="comm-divider">|</span>
                                            <span class="comment-time">{{ $child->created_from }}</span>
                                            <span class="comm-divider">|</span>
                                        </div>
                                    </div>
                                </div>
                            <!-- end comment entry -->
                            </li><!-- #comment-## -->
                            @endforeach
                        </ul><!-- .children -->
                    </li><!-- #comment-## -->
                    @else
                    <li id="comment-{{ $comment->id }}" data-id="{{ $comment->id }}" class="comment byuser comment-author-wohoo bypostauthor even thread-even depth-1">
                    <!-- begin comment entry -->
                        <div class="comment-entry">
                            <p>{{ $comment->comment }}</p>
                            <div class="comment-author-wrapper">
                                <img alt="" src="{{ asset('assets/images/user/default.png') }}" class="avatar avatar-60 photo" height="60" width="60">                        
                                <div class="comment-author-inner">
                                    <span class="comment-author">{{ ($author) ? ($author->fullname ?? $author->username) : $comment->name }}</span>
                                    <span class="comm-divider">|</span>
                                    <span class="comment-time">{{ $comment->created_from }}</span>
                                    <span class="comm-divider">|</span>
                                    <a rel="nofollow" class="comment-reply-link" href="javascript:void(0)"  aria-label="Reply to {{ ($author) ? ($author->fullname ?? $author->username) : $comment->name }}">Trả lời</a>
                                </div>
                            </div>
                        </div>
                        <!-- end comment entry -->
                    </li><!-- #comment-## -->
                    @endif

                    @empty
                    @endforelse
                </ol>   
                <!-- END COMMENTS -->
        
            <!-- BEGIN COMMENT FORM -->
                        
                <div id="respond" class="comment-respond">
                    <h3 id="reply-title" class="comment-reply-title @if(auth()->user()) logged @endif"> 
                        <small>
                            <a rel="nofollow" id="cancel-comment-reply-link" href="javascript:void(0)" style="display:none;">
                                <span id="cancel-comment-reply"></span>
                            </a>
                        </small>
                    </h3>          
                    <form action="{{ route('comment.store') }}" method="post" id="commentform" class="comment-form">
                        @csrf
                        <div class="commentform-wrapper">
                            <div class="commentform-inner">
                                <div class="commentform-outer-border">
                                    <div class="commentform-inner-border">
                                        <div id="comment-wrapper">
                                            <div class="comment-wrapper-inner">
                                                <textarea name="comment" id="comment" cols="45" rows="10" tabindex="1" placeholder="Bạn nghĩ gì về bài viết này..*" style="height: 112px; overflow: hidden;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="commentform-fields">
                            @if(auth()->user())
                            <div id="author-wrapper"></div>
                            <div id="email-wrapper"></div>
                            <div id="url-wrapper"></div>
                            @else
                            <div id="author-wrapper">
                                <input type="text" name="author" id="author" value="" placeholder="Nickname*" size="22" tabindex="2">
                            </div>
                            <div id="email-wrapper"><input type="text" name="email" id="email" value="" placeholder="E-mail (ẩn)*" size="22" tabindex="3"></div>
                            <div id="url-wrapper"><input name="website" id="url" type="text" value="" placeholder="Website (tùy chọn)" size="22" tabindex="4"></div>
                            @endif
                            @if ($errors->any())
                                <label id="title-error" class="error is-invalid" for="title">{{ $errors->first() }}</label>
                            @endif
                        </div>
                        <div class="form-submit @if(auth()->user()) logged @endif">
                            <button type="button" id="btn_submit" class="btn btn-submit submit" value="">Gửi</button>
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <input type="hidden" name="parent_id" value="">
                        </div>
                    </form>
                </div><!-- #respond -->
            </div>
            <!-- /.commentwrap -->
            <!-- END COMMENT FORM -->
        </div>