<style>
    .title-color {
        color: {{ $ProjectSetting && isset($ProjectSetting['advice_page_title_color']) ? $ProjectSetting['advice_page_title_color'] : '#002B5C' }};
        font-family: {{ $ProjectSetting && isset($ProjectSetting['advice_title_font_family']) ? $ProjectSetting['advice_title_font_family'] : 'overpass' }};
        font-weight: {{ $ProjectSetting && isset($ProjectSetting['advice_title_font_weight']) ? $ProjectSetting['advice_title_font_weight'] : '900' }};
    }

    .advice-description,
    .advice-description>a {
        color: {{ $ProjectSetting && isset($ProjectSetting['advice_page_description_color']) ? $ProjectSetting['advice_page_description_color'] . ' !important' : '#002B5C' }};
        font-family: {{ $ProjectSetting && isset($ProjectSetting['advice_description_font_family']) ? $ProjectSetting['advice_description_font_family'] : 'PT Serif' }};
        font-weight: {{ $ProjectSetting && isset($ProjectSetting['advice_description_font_weight']) ? $ProjectSetting['advice_description_font_weight'] : '400' }};
    }

    /* .advice-detail > p,li{
        color: {{ $ProjectSetting && isset($ProjectSetting['advice_page_description_color']) ? $ProjectSetting['advice_page_description_color'] . ' !important' : '#002B5C' }};

    } */
    .advice-detail ul {
        list-style: disc !important;
        list-style-position: outside !important;
        margin-left: 18px;
    }

    .advice-detail ol {
        list-style: decimal !important;
        list-style-position: outside !important;
        margin-left: 18px;
    }

    li:before {
        content: "";
        margin-left: -0.3rem;
    }

    .title-font {
        font-family: {{ $ProjectSetting && isset($ProjectSetting['advice_title_font_family']) ? $ProjectSetting['advice_title_font_family'] : 'overpass' }};
        font-weight: {{ $ProjectSetting && isset($ProjectSetting['advice_title_font_weight']) ? $ProjectSetting['advice_title_font_weight'] : '900' }};
    }

    .category-title-font {
        font-size: {{ $ProjectSetting && isset($ProjectSetting['category_title_font_size']) ? $ProjectSetting['category_title_font_size'] : '10' }};
        font-family: {{ $ProjectSetting && isset($ProjectSetting['advice_title_font_family']) ? $ProjectSetting['advice_title_font_family'] : 'overpass' }};
        font-weight: {{ $ProjectSetting && isset($ProjectSetting['advice_title_font_weight']) ? $ProjectSetting['advice_title_font_weight'] : '600' }};
    }

    .btn-more-info-container a {
        font-family: {{ $ProjectSetting && isset($ProjectSetting['advice_title_font_family']) ? $ProjectSetting['advice_title_font_family'] : 'overpass' }};
        font-weight: {{ $ProjectSetting && isset($ProjectSetting['advice_title_font_weight']) ? $ProjectSetting['advice_title_font_weight'] : '600' }};
    }

    .start-button-advice {
        color: {{ $ProjectSetting && isset($ProjectSetting['advice_page_button_text_color']) ? $ProjectSetting['advice_page_button_text_color'] : '#ffffff' }};
        background: {{ $ProjectSetting && isset($ProjectSetting['advice_page_button_background_color']) ? $ProjectSetting['advice_page_button_background_color'] : '#D60C8C' }};
    }

    .btn-more-info {
        background: {{ $ProjectSetting && isset($ProjectSetting['meer_informatie_button_background_color']) ? $ProjectSetting['meer_informatie_button_background_color'] : '#D60C8C' }};
        color: {{ $ProjectSetting && isset($ProjectSetting['product_card_button_text_color']) ? $ProjectSetting['product_card_button_text_color'] : '#ffffff' }};
    }

    .btn-more-info:hover {
        background: {{ $ProjectSetting && isset($ProjectSetting['meer_informatie_button_background_hover_color']) ? $ProjectSetting['meer_informatie_button_background_hover_color'] . ' !important' : '#D60C8C' }};
        color: {{ $ProjectSetting && isset($ProjectSetting['product_card_button_hover_text_color']) ? $ProjectSetting['product_card_button_hover_text_color'] . ' !important' : '#ffffff' }};
    }

    .start-button-advice:hover {
        background: {{ $ProjectSetting && isset($ProjectSetting['advice_page_button_hover_color']) ? $ProjectSetting['advice_page_button_hover_color'] : '#002B5C' }};
        color: {{ $ProjectSetting && isset($ProjectSetting['advice_page_button_hover_text_color']) ? $ProjectSetting['advice_page_button_hover_text_color'] : '#ffffff' }};
    }

    .advice-product-title {
        color: {{ $ProjectSetting && isset($ProjectSetting['advice_page_product_title_color']) ? $ProjectSetting['advice_page_product_title_color'] . ' !important' : '#ffffff' }};
        font-size: {{ $ProjectSetting && isset($ProjectSetting['advice_page_product_title_font_size']) ? $ProjectSetting['advice_page_product_title_font_size'] . ' !important' : '10' }};
        font-family: {{ $ProjectSetting && isset($ProjectSetting['advice_product_title_font_family']) ? $ProjectSetting['advice_product_title_font_family'] . ' !important' : 'overpass' }};
        font-weight: {{ $ProjectSetting && isset($ProjectSetting['advice_product_title_font_weight']) ? $ProjectSetting['advice_product_title_font_weight'] . ' !important' : '600' }};
    }

    .advice-product-description>p,
    .advice-product-description>ul>li {
        color: {{ $ProjectSetting && isset($ProjectSetting['advice_page_product_description_color']) ? $ProjectSetting['advice_page_product_description_color'] . ' !important' : '' }};
        font-size: {{ $ProjectSetting && isset($ProjectSetting['advice_page_product_description_font_size']) ? $ProjectSetting['advice_page_product_description_font_size'] . ' !important' : '10' }};
        font-family: {{ $ProjectSetting && isset($ProjectSetting['advice_prduct_description_font_family']) ? $ProjectSetting['advice_prduct_description_font_family'] . ' !important' : 'overpass' }};
        font-weight: {{ $ProjectSetting && isset($ProjectSetting['advice_product_description_font_weight']) ? $ProjectSetting['advice_product_description_font_weight'] . ' !important' : '600' }};
    }

    .read-more,
    .read-less {
        text-decoration: underline !important;
    }

    .btn-more-info-container {
        position: absolute;
        bottom: 0;
        margin-left: auto;
        margin-right: auto;
        left: 0;
        right: 0;
    }

    .slick-slide {
        height: inherit !important;
    }

    .slick-prev {
        left: -80px !important;
    }

    .slick-next {
        right: -80px !important;
    }

    .slick-prev i,
    .slick-next i {
        color: #D60C8C;
        font-size: 36px
    }

    /* .slick-prev:hover i {
        color: #002B5C;
    } */
    .slick-next,
    .slick-prev {
        border-width: 2px !important;
        border-color: #D60C8C !important;
        background: transparent !important;
        border-radius: 50% !important;
        color: #fff !important;
        display: block !important;
        height: 70px !important;
        width: 70px !important;
    }

    /* .slick-next:hover i {
        color: #002B5C;
    } */
    /* .slick-next:hover,
    .slick-prev:hover {
        border-color: #002B5C !important;
    } */
    .slick-next:focus,
    .slick-prev:focus {
        outline: 5px auto #D60C8C !important;
    }

    .mobile-icon {
        display: none;
    }

    .vorige {
        display: none;
    }

    @media(max-width:767px) {
        .slick-prev {
            left: 0px !important;
            top: 543px !important;
        }

        .slick-next {
            right: 0px !important;
            top: 543px !important;
        }

        .slick-next,
        .slick-prev {
            background: transparent !important;
            border: none !important;
            display: none !important;
        }

        .vorige {
            font-size: {{ $ProjectSetting && isset($ProjectSetting['previous_text_font_size']) ? $ProjectSetting['previous_text_font_size'] : '15' }};
            display: block;
            font-family: {{ $ProjectSetting && isset($ProjectSetting['previous_text_font_family']) ? $ProjectSetting['previous_text_font_family'] : 'Poppins' }};
            color: {{ $ProjectSetting && isset($ProjectSetting['previous_button_text_color']) ? $ProjectSetting['previous_button_text_color'] : '#D60C8C' }};
        }

        .mobile-icon {
            display: block;
            color: {{ $ProjectSetting && isset($ProjectSetting['arrow_color']) ? $ProjectSetting['arrow_color'] : '#D60C8C' }} !important;
            font-size: 32px;
        }

        .icons {
            position: fixed;
            bottom: 10px;
            left: 47%;
        }
    }
</style>
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="logo text-center mt-5">
                                <img class="logo_image" src="{{ $project->welcomePage->image ? asset('storage/images/' . $project->welcomePage->image) : asset('images/default.png/') }}" />
                            </div>
                            <div class="title text-center mt-4">
                                <h4 class="title title-text title-color">{{ $ProjectSetting && isset($ProjectSetting['advice_title']) ? $ProjectSetting['advice_title'] : 'Adviezen' }}</h4>
                            </div>
                            <br />
                            <div id="collapsediv">
                                @foreach ($advice->categories as $category)
                                <div class="advice-detail-btn collapse-button d-flex justify-content-center" data-toggle="collapse" data-target="#collapseAdvices_{{ $category->id }}" aria-expanded="false" aria-controls="collapseAdvices">
                                    <span class=" d-flex justify-content-between  align-items-center start-button-advice mt-3">
                                        <span class="category-title-font">{{ $category->title }}</span>
                                        <i class="fas @if ($loop->index == 0) fa-angle-down @else fa-angle-right @endif   sign  text-white" style="font-size: 20px;"></i></span>
                                </div>
                                <div class="collapse mb-5 collapse-div @if ($loop->index == 0) show @endif" data-id="{{ $category->id }}" id="collapseAdvices_{{ $category->id }}" data-parent="#collapsediv">
                                    <div class="description text-center mt-4 mb-5">
                                        <div class="container">
                                            <p class="advice-description text-center read-more-description">
                                                {{ testEllipsis($category->description, $max = 25) }}
                                                <a href="javascript:void(0);" data-text-read-more="{{ $ProjectSetting && isset($ProjectSetting['advice_read_more_button_text']) ? $ProjectSetting['advice_read_more_button_text'] : 'Read more ...' }}" data-text-read-less="{{ $ProjectSetting && isset($ProjectSetting['advice_read_less_button_text']) ? $ProjectSetting['advice_read_less_button_text'] : 'Read less ...' }}" data-id="{{ $category->id }}" data-type="read_more" class="read-more {{ str_word_count($category->description) > 25 ? '' : 'd-none' }}">{{ $ProjectSetting && isset($ProjectSetting['advice_read_more_button_text']) ? $ProjectSetting['advice_read_more_button_text'] : 'Read more ...' }}</a>

                                            </p>
                                        </div>
                                    </div>
                                    <section id="allery">
                                        <div class="container">
                                            <div class="row  justify-content-center  slider-nav">
                                                @if (count($category->products) > 0)
                                                @foreach ($category->products as $product)
                                                @php
                                                if (Illuminate\Support\Str::contains($product->image, 'http')) {
                                                $path = $product->image;
                                                } else {
                                                $path = asset('storage/images/' . $product->image);
                                                }
                                                @endphp
                                                <div class="col-sm-12 mb-4 cart-max-width" data-href='{{ $product->url }}' style="cursor: pointer;">
                                                    <div class="card card-style product-card">
                                                        <img class="card-img-top card_image" id="card_image" src="{{ $product->image ? $path : asset('images/default.png/') }}" alt="card img cap" />
                                                        <div class="card-body p-1 advice-detail advice-product-description">
                                                            <h3 class="card-title px-1 my-3 title-font advice-product-title">
                                                                {{ $product->title }}
                                                            </h3>
                                                            <p class="card-text px-1 advice-description">
                                                                {!! addEllipsis($product->description, $max = 142) !!}
                                                            </p>
                                                            <span class="d-flex justify-content-center my-4 btn-more-info-container">
                                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                <a href="{{ $product->url }}" target="_blank" class="btn btn-more-info text-center text-white btn-bg-pink btn-sm product_id">
                                                                    {{ $ProjectSetting && isset($ProjectSetting['product_card_button_text']) ? $ProjectSetting['product_card_button_text'] : 'Meer informatie' }}
                                                                </a></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @else
                                                <p class="advice-description text-center read-more-description">No Products Available</p>
                                                @endif
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                @endforeach
                                {{-- Additional Adviezen for MCQ Advice Logic --}}
                                @if (sizeof($products) > 0)
                                <div class="title text-center mt-5">
                                    <h4 class="title-text title-color">{{ $ProjectSetting && isset($ProjectSetting['additional_advice_title']) ? $ProjectSetting['additional_advice_title'] : 'Additional Adviezen' }}</h4>
                                </div>
                                <div class="row justify-content-center mt-4">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            @foreach ($products as $product)
                                            <div class="col-sm-12 mb-4">
                                                <div class="card card-style product-card">
                                                    @php
                                                    if (Illuminate\Support\Str::contains($product->image, 'http')) {
                                                    $path = $product->image;
                                                    } else {
                                                    $path = asset('storage/images/' . $product->image);
                                                    }
                                                    @endphp
                                                    <img class="card-img-top card_image" src="{{ $product->image ? $path : asset('images/default.png/') }}" alt="card img cap" />
                                                    <div class="card-body p-1 advice-detail advice-product-description">
                                                        <h3 class="card-title px-1 my-3 title-font advice-product-title">{{ $product->title }}</h3>
                                                        <p class="card-text px-1 advice-description">{!! addEllipsis($product->description, $max = 142) !!}</p>
                                                        <div class="d-flex justify-content-center mt-4 btn-more-info-container">
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                            <a href="{{ $product->url }}" target="_blank" class="btn btn-more-info my-4 text-center text-white btn-bg-pink btn-sm product_id">
                                                                {{ $ProjectSetting && isset($ProjectSetting['product_card_button_text']) ? $ProjectSetting['product_card_button_text'] : 'Meer informatie' }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            {{-- collapse end --}}
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
{{-- @endsection --}}

<script>
    $(document).on('click', '.read-more, .read-less', function() {
        var type = $(this).data('type');
        var id = $(this).data('id');
        var read_more_btn_text = $(this).data('text-read-more');
        var read_less_btn_text = $(this).data('text-read-less');
        $.ajax({
            type: "get",
            url: "{{ route('advice-product-description') }}",
            data: {
                id: id,
                type: type,
                read_more_btn_text: read_more_btn_text,
                read_less_btn_text: read_less_btn_text
            },
            success: function(response) {
                $('.read-more-description').empty().append(response);
            }
        });
    });

    initSliders();

    function initSliders() {
    $(".collapse.show .slider-nav").slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        prevArrow: '<button type="button" class="slick-prev"><i class="far fa-less-than"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="far fa-greater-than"></i></button>',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $(".row.justify-content-center .row").slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        prevArrow: '<button type="button" class="slick-prev"><i class="far fa-less-than"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="far fa-greater-than"></i></button>',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
}





    $('.collapse-div').on('hidden.bs.collapse', function(e) {
        $(e.target)
            .prev('.collapse-button')
            .find(".sign")
            .removeClass('fa-angle-down')
            .addClass('fa-angle-right');
        $('.slider-nav').slick('unslick');
    });

    $('.collapse-div').on('shown.bs.collapse', function(e) {
        let category_id = $(this).attr('data-id');
        // saving product impressions
        $.ajax({
            type: "post",
            url: "{{ route('update-category-impressions') }}",
            data: {
                category_id: category_id
            },
            success: function() {
                console.log('Category impressions updated successfully');
            }
        });
        // end impression saving
        $(e.target)
            .prev('.collapse-button')
            .find(".sign")
            .removeClass('fa-angle-right')
            .addClass('fa-angle-down');
        initSliders();
    });

    // saving product impressions
    $('body').on('click', '.product_id', function() {
        let product_id = $(this).siblings('input[name=product_id]').val();
        $.ajax({
            type: "post",
            url: "{{ route('update-product-impressions') }}",
            data: {
                product_id: product_id
            },
            success: function() {
                console.log('Product impressions updated successfully');
            }
        });
    });

    $('body').on('click', '.cart-max-width', function() {
        let href = $(this).data('href');
        window.open(href);
        return false;
    });
</script>
