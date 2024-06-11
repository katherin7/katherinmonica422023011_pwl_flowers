@extends('layouts.app-public')
@section('title', 'Product Detail')
@section('content')
<div class="site-wrapper-reveal">
    <div class="single-product-wrap section-space--pt_90 border-bottom pb-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                    <!-- Product Details Left -->
                    <div class="product-details-left">
                        <div class="product-details-images-2 slider-lg-image-2">
                            <div class="easyzoom-style">
                                <div class="easyzoom easyzoom--overlay">
                                    <a href="{{ asset('assets/images/product/single-product-01.webp') }}" class="poppu-img product-img-main-href">
                                        <img src="{{ asset('https://down-id.img.susercontent.com/file/dbc74cb8bcd9562536e7e20c57daa6af') }}" class="img-fluid product-img-main-src" alt="">
                                    </a>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                @for($i = 0; $i < 4; $i++)
                                <div class="col-3">
                                    <div class="easyzoom-style">
                                        <div class="easyzoom easyzoom--overlay">
                                            <a href="{{ asset('assets/images/product/single-product-02.webp') }}" class="poppu-img">
                                                <img src="{{ asset('https://images.tokopedia.net/img/cache/700/VqbcmM/2022/9/13/2cd5a94f-c770-4eea-b208-ae2b0cafce8f.jpg') }}" class="img-fluid" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <br><br>
                                </div>
                                @endfor
                            </div>
                        </div>
                        <div class="product-details-thumbs-2 slider-thumbs-2">
                            <div class="sm-image"><img_src="{{ asset('assets/images/product/small/1-100x100.webp') }}" alt="product image thumb" class="product-img-main-src"></div>
                            @for($i=0 ; $i < 4; $i++)
                            <div class="sm-image"><img_src="{{ asset('assets/images/product/small/2-100x100.webp') }}" alt="product image thumb"></div>
                            @endfor
                        </div>
                    </div>
                    <br><br>
                    <!--// Product Details Left -->
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                    <div class="product-details-content">
                        <h5 class="font-weight--reguler mb-10" id="product-name">Sun Flower</h5>
                        <div class="quickview-ratting-review mb-10">
                            <div class="quickview-ratting-wrap">
                                <div class="quickview-ratting" id="product-review-stars">
                                    <!-- Review Stars -->
                                    <div class="star-rating">
                                        <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 stars">☆</label>
                                        <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars">☆</label>
                                        <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars">☆</label>
                                        <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars">☆</label>
                                        <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star">☆</label>
                                    </div>
                                    <!--// Review Stars -->
                                </div>
                                <a href="#" id="product-review-body-count"></a>
                            </div>
                        </div>
                        <h3 class="price" id="product-price">IDR 85.000</h3>
                        <div class="stock mt-10" id="product-status-stock">
                            <h6> <b>Available :</b> <p style="color:green;">in stock </h6>
                        </div>
                        <div class="quickview-peragraph mt-10"><p id="product-description"></p></div>
                        <div class="quickview-action-wrap mt-30">
                            <div class="quickview-cart-box">
                                <div class="quickview-quality product-add-to-cart">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="0">
                                    </div>
                                </div>
                                <div class="text-color-primary product-add-to-cart-is-disabled" style="display:none;font-size:10px">
                                    You may cant buy this item now, but keep it on your wishlist so we can remind you when in stock
                                </div>
                                <div class="quickview-button">
                                    <div class="quickview-cart button product-add-to-cart">
                                        <button type="button" class="btn--lg btn--black font-weight--reguler text-white">
                                            Add to cart
                                        </button>
                                    </div>
                                    <div class="quickview-wishlist button">
                                        <a title="Add to wishlist" href="#"><i class="icon-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product_meta mt-30">
                            <div class="posted_in item_meta">
                                <span class="label">Florist: IM NAYEON</span>
                                <span id="product-author" class="text-color-primary"></span>
                            </div>
                            <div class="posted_in item_meta">
                                <span class="label">Jenis_bunga: Matahari</span>
                                <span id="product-publisher"></span>
                            </div>
                            <div class="tagged_as item_meta">
                                <span class="label">Tag: Matahari</span>
                                <span id="product-tags"></span>
                            </div>
                            <div class="tagged_as item_meta">
                                <span class="label">Description: <br>Bunga Matahari melambangkan banyak hal Bunga matahari, dengan tangkainya yang tinggi dan kokoh, melambangkan keberhasilan dan prestasi.
                                    Mereka mengingatkan kita untuk bercita-cita tinggi dan tak takut mengejar impian.
                                    Arti dari bunga matahari tidak hanya tentang keberhasilan, tetapi juga tentang kerja keras
                                    untuk meraihnya.</span>
                                <span id="product-tags"></span>
                            </div>
                        </div>
                        <div class="product_socials section-space--mt_60">
                            <span class="label">Share this items :</span>
                            <ul class="helendo-social-share socials-inline">
                                <li>
                                    <a class="share-facebook helendo-facebook" href="#" target="_blank">
                                        <i class="social_facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="share-twitter helendo-twitter" href="#" target="_blank">
                                        <i class="social_twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="share-instagram helendo-instagram" href="#" target="_blank">
                                        <i class="social_instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('addition_script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star-rating input');
    stars.forEach(star => {
        star.addEventListener('change', () => {
            alert(`You rated this ${star.value} stars.`);
        });
    });
});
</script>
<script src="{{ asset('pages/js/pdp.js') }}"></script>
@endsection
