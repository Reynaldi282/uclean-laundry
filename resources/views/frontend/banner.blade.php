{{-- Banner --}}
    <div class="bg-cover" id="home">
    <img src="{{asset('frontend/img/banner.jpg')}}" alt="" />
    </div>
    <!-- end bg-cover -->
    <!-- begin container -->
    <div class="container">
        <h1>Welcome to U-Clean Laundry</h1>
        <p>Wet Clean with Personal Care</p>
        <div class="input-group m-b-20">
            <input type="text" class="form-control input-lg" id="search_status" placeholder="Enter Order ID" aria-label="Search Order ID"/>
            <span class="input-group-btn">
                <button type="submit" class="btn btn-lg" id="search-btn"><i class="fa fa-search"></i></button>
            </span>
        </div>
        @include('frontend.modal')
    </div>
{{-- End Header --}}