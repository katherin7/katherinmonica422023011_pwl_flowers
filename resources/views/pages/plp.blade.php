@extends ('Layouts.app-public')
@section('title', 'Shop') 
@section('content')
<div class="site-wrapper-reveal">
    <!-- Product Area Start -->
<div class="product-wrapper section-space--ptb_90 border-bottom pb-5 mb-5">
    <div class="container">

        <div class="row">
            <div class="col-lg-3 col-md-3 order-md-1 order-2 small-mt__40">
                <div class="shop-widget widget-shop-publishers mt-3">
                    <div class="product-filter">
                        <h6 class="mb-20">Florist</h6>
                        <select class="_filter form-select form-select-sm" name="_publisher" onchange="getData()">
                            <option value="" selected>All</option>
                            <option value="IM NAYEON">IM NAYEON</option>
                            <option value="YOO JEONGYEON">YOO JEONGYEON</option>
                            <option value="HIRAI MOMO">HIRAI MOMO</option>
                            <option value="KIM SANA">KIM SANA</option> 
                            <option value="PARK JIHYO">PARK JIHYO</option>
                            <option value="MYOUI MINA">MYOUI MINA</option> 
                            <option value="KIM DAHYUN">KIM DAHYUN</option>
                            <option value="SON CHAEYOUNG">SON CHAEYOUNG</option>
                            <option value="CHOU TZUYU">CHOU TZUYU</option>
                            </select>
                        </div>
                    </div>
                    <!-- Product Filter -->
                    <div class="shop-widget widget-color">
                        <div class="product-filter">
                    <h6 class="mb-20">Color</h6>
                    <ul class="widget-nav-list">
                        <li><a href="#"><span class="swatch-color black"></span></a></li> 
                        <li><a href="#"><span class="swatch-color green"></span></a></li> 
                        <li><a href="#"><span class="swatch-color grey"></span></a></li> 
                        <li><a href="#"><span class="swatch-color red"></span></a></li>  
                        <li><a href="#"><span class="swatch-color yellow"></span></a></li>
                    </ul>
                </div>
</div>
<!-- Product Filter -->
<div class="shop-widget">
<div class="product-filter widget-price">
<h6 class="mb-20">Price</h6>
<ul class="widget-nav-list">
    <li><a href="#">Under IDR 100K</a></li> 
    <li><a href="#">IDR 100-500k</a></li> 
    <li><a href="#">IDR 501-1000K</a></li> 
    <li><a href="#">Above IDR 1000K</a></li>
</ul>
</div>
</div>

<!-- Product Filter -->
        <div class="shop-widget">
            <div class="product-filter">
                <h6 class="mb-20">Tags</h6> 
                    <div class="blog-tagcloud">
                        <a href="#" class="selected">Flower</a> 
                        <a href="#">Best Seller</a>
                        <a href="#">Tulip</a> 
                        <a href="#">Mawar</a> 
                        <a href="#">Edelweis</a> 
                        <a href="#">Anggrek</a> 
                        <a href="#">Allamanda</a> 
                        <a href="#">Lily</a> 
                        <a href="#">Matahari</a> 
                        <a href="#">Kembang sepatu</a> 
                        <a href="#">Angelonia</a> 
                        <a href="#">Alyssum</a> 
                        <a href="#">Amarilis</a> 
                        <a href="#">Anemone</a> 
                        <a href="#">Ruellia</a> 
                        <a href="#">Askaia</a> 
                        <a href="#">Ammi</a> 
                        <a href="#">Anthurium</a>
                    </div>
                </div>
            </div>
        </div>
    <div class="col-lg-9 col-md-9 order-md-2 order-1"> 
        <div class="row mb-5">
            <div class="col-lg-6 col-md-8">
                <div class="shop-toolbar__items shop-toolbar___item--left"> 
                    <div class="shop-toolbar_item shop-toolbar___item--result"> 
                        <p class="result-count">
                        Showing <span id="products_count_start"></span><span id="products_count_end"></span>
                        of <span id="products_count_total"></span>
                </p> 
            </div>
            <div class="shop-toolbar___item">
                <select class="_filter form-select form-select-sm" name="_sort_by" onchange="getData()">
                <option value="jenis_bunga_asc">Sort by A-Z</option> 
                <option value="jenis_bunga_desc">Sort by Z-A</option> 
                <option value="latest_added">Sort by time added</option> 
                <option value="price_asc">Sort by price: low to high</ option>
                <option value="price_desc">Sort by price: high to low</ option> 
            </select>
        </div>
    </div>
</div>
<div class="col-lg-6 col-md-4">
    <div class="header-right-search">
        <div class="header-search-box">
            <input class="_filter search-field" name="_search" type="text"
                onkeypress="getDataOnEnter(event)"
                placeholder="Search by florist or flower...">
            <button class="search-icon"><i class="icon-magnifier"></i></button>
        </div>
    </div>
</div>
</div>

<div>
    <div class="row" id="product-list"></div> 
        <div class="row">
            <div class="col-12">
                <ul class="page-pagination text-center mt-40" id="product-list-pagination">
                    <li>
                        <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//93/MTA-53700823/oem_oem_full01.jpg" style="width:300px; height:450px; border:4px solid black;"></li>
                    <li><a href="http://127.0.0.1:8000/flower/1">
                        <img src="https://s3.cosmopolitan.co.id/1703058228.webp" style="width:300px; height:450px; border:4px solid black;"></a></li><br><br>
                    <li><img src="https://i.pinimg.com/736x/ab/64/32/ab64327de01919f37604bd2028651bf5.jpg" style="width:300px; height:450px; border:4px solid black;"></li>
                    <li><a href="https://www.google.com/url?sa=i&url=https%3A%2F%2Fid.pinterest.com%2Fpin%2F68744473836%2F&psig=AOvVaw0siWao0lBV2tNhGvsC2yAO&ust=1717646687318000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCIiasubKw4YDFQAAAAAdAAAAABAK" > 
<img src="https://i.pinimg.com/736x/43/4c/8f/434c8f3227f143e77e697711e26fca54.jpg" style="width:300px; height:450px; border:4px solid black;"> </a>
                    </li> 
                </ul>
            </div>
        </div>
    </div>
    <br><br>
           

</div>
</div>
</div>
</div>

<!-- Product Area End-->
</div>
@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script src="{{asset('pages/js/plp.js')}}"></script> 
    @endsection