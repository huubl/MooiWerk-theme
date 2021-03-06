<section class="newsdeck">
    <div class="container">
        <h1 class="newsdeck__title">{{$news_title}}</h1>
        <div class="row">
        @if (!empty($news))
            @php 
                $big = $news['big'];
                $small = is_array($news['small'])? array_chunk($news['small'], 2) : [];
            @endphp
             @foreach($small[0] as $item)
			    @if ($loop->first) 
                    <div class="col-lg-6">
                        <div class="card-deck newsdeck__item_margin-bottom">
                            <div class="card newsdeck__item newsdeck__item_small">
                                <div class="card-block newsdeck__item_align d-flex align-items-start flex-column h-100">
                                    <h3 class="card-title">{{wp_trim_words( strip_tags($item['title']), 13, '...' )}}</h3>
                                    @if (str_word_count(strip_tags($item['title'])) < 7)
                                        <p class="card-text">{{wp_kses_post( wp_trim_words( strip_tags( $item['excerpt'] ), 10, '...' ) )}}</p>
                                    @endif
                                    <a href="{{$item['link']}} " class="mt-auto">{{__('lees meer ›', 'mooiwerk-breda-theme')}}</a>
                                </div>
                            </div>
                            <div class="w-100 d-sm-none my-3">
                                <!-- wrap every 1 on xs-->
                            </div>
				@endif
				@if ($loop->iteration == 2)
				            <div class="card border-top newsdeck__item newsdeck__item_small">
                                <div class="card-block newsdeck__item_align d-flex align-items-start flex-column h-100">
                                    <h3 class="card-title">{{wp_trim_words( strip_tags($item['title']), 13, '...' ) }}</h3>
                                    @if (str_word_count(strip_tags($item['title'])) < 7)
                                        <p class="card-text">{{wp_kses_post( wp_trim_words( strip_tags( $item['excerpt'] ), 10, '...' ) )}}</p>
                                    @endif
                                    <a href="{{$item['link']}}" class="mt-auto">{{__('lees meer ›', 'mooiwerk-breda-theme')}}</a>
                                </div>
                            </div>
                        </div>
				@endif
                @endforeach
                @foreach($big as $item)
				@if ($loop->iteration == 1)
                        <div class="card newsdeck__item newsdeck__item_big">
                            <div class="card-block newsdeck__item_align">
                            <img class="card-img w-100" src="{{$item['image_link']}}" alt="{{ $item['title'] }} thumbnail" />
                                <div class="card-img-overlay newsdeck__caption d-flex flex-column justify-content-end text-white">
                                    <h3 class="card-title">{{wp_trim_words( strip_tags($item['title']), 6, '...' )}}</h3>
                                    <p class="card-text">{{wp_kses_post( wp_trim_words( strip_tags( $item['excerpt'] ), 25, '...' ) )}}</p>
                                    <a href="{{$item['link']}}" class="text-white">{{__('lees meer ›', 'mooiwerk-breda-theme')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 d-lg-none my-3">
                        <!-- wrap every 1 on xs-->
                    </div>
				@endif
				@if ($loop->iteration == 2)
                    <div class="col-lg-6">
                        <div class="card newsdeck__item newsdeck__item_big">
                            <div class="card-block">
                                <img class="card-img w-100" src="{{$item['image_link']}}" alt="{{ $item['title'] }} thumbnail" />
                                <div class="card-img-overlay newsdeck__caption d-flex flex-column justify-content-end text-white">
                                    <h3 class="card-title">{{wp_trim_words( strip_tags($item['title']), 6, '...' )}}</h3>
                                    <p class="card-text">{{wp_kses_post( wp_trim_words( strip_tags( $item['excerpt'] ), 25, '...' ) )}}</p>
                                    <a href="{{$item['link']}}" class="text-white">{{__('lees meer ›', 'mooiwerk-breda-theme')}}</a>
                                </div>
                            </div>
                        </div>
                @endif
                @endforeach
                @foreach($small[1] as $item)
				@if ($loop->iteration == 1)
				        <div class="card-deck newsdeck__item_margin-top">
                            <div class="card newsdeck__item newsdeck__item_small">
                                <div class="card-block newsdeck__item_align d-flex align-items-start flex-column h-100">
                                    <h3 class="card-title">{{wp_trim_words( strip_tags($item['title']), 13, '...' ) }}</h3>
                                    @if (str_word_count(strip_tags($item['title'])) < 7)
                                        <p class="card-text">{{wp_kses_post( wp_trim_words( strip_tags( $item['excerpt'] ), 10, '...' ) )}}</p>
                                    @endif
                                    <a href="{{$item['link']}}" class="mt-auto">{{__('lees meer ›', 'mooiwerk-breda-theme')}}</a>
                                </div>
                            </div>
                            <div class="w-100 d-sm-none my-3">
                                <!-- wrap every 1 on xs-->
                            </div>
                @endif
				@if ($loop->iteration == 2)
				        <div class="card newsdeck__item newsdeck__item_small">
                            <div class="card-block newsdeck__item_align d-flex align-items-start flex-column h-100">
                                <h3 class="card-title">{{wp_trim_words( strip_tags($item['title']), 13, '...' ) }}</h3>
                                @if (str_word_count(strip_tags($item['title'])) < 7)
                                    <p class="card-text">{{wp_kses_post( wp_trim_words( strip_tags( $item['excerpt'] ), 10, '...' ) )}}</p>
                                @endif
                                <a href="{{$item['link']}}" class="mt-auto">{{__('lees meer ›', 'mooiwerk-breda-theme')}}</a>
                            </div>
                        </div>
                    </div>
				@endif
        @endforeach
        @endif
         @empty($news)
            <div class="alert alert-warning">{{__('Niet genoeg inhoud om raster te maken', 'mooiwerk-breda-theme')}}</div>
        @endempty
        </div>
    </div>
</section>
