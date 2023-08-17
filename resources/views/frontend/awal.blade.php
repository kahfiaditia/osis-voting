@extends('frontend.main')
@section('ft')
    <div class="page-content" style="margin-top: 10px;">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <ul class="nav nav-tabs nav-tabs-custom justify-content-center pt-2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#all-post" role="tab">
                                Slide
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('grafik') }}" role="tab">
                                Grafik
                            </a>
                        </li>
                    </ul>
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">With captions</h4>
                                <p class="card-title-desc">Add captions to your slides easily with the
                                    <code>.carousel-caption</code> element within any
                                    <code>.carousel-item</code>.
                                </p>
                                <div id="carouselExampleCaption" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="carousel-item active">
                                            <img src="assets/images/small/img-8.jpg" alt="..."
                                                class="d-block img-fluid">
                                            <div class="carousel-caption d-none d-md-block text-white-50">
                                                <h5 class="text-white">First slide label</h5>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/images/small/img-9.jpg" alt="..."
                                                class="d-block img-fluid">
                                            <div class="carousel-caption d-none d-md-block text-white-50">
                                                <h5 class="text-white">Second slide label</h5>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/images/small/img-9.jpg" alt="..."
                                                class="d-block img-fluid">
                                            <div class="carousel-caption d-none d-md-block text-white-50">
                                                <h5 class="text-white">Third slide label</h5>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/images/small/img-10.jpg" alt="..."
                                                class="d-block img-fluid">
                                            <div class="carousel-caption d-none d-md-block text-white-50">
                                                <h5 class="text-white">Third slide label</h5>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/images/small/img-11.jpg" alt="..."
                                                class="d-block img-fluid">
                                            <div class="carousel-caption d-none d-md-block text-white-50">
                                                <h5 class="text-white">Third slide label</h5>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleCaption" role="button"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleCaption" role="button"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
