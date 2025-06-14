@php
$i = 1;
@endphp
@foreach ($userdata as $user)

<div class="col" data-aos="fade-up" data-aos-delay="{{$i++}}00" data-aos-duration="1000">
    <a href="{{URL::to($user->slug . '/')}}" target="_blank">
        <div class="post-slide h-100 card border-0">
            <div class="post-img rounded-3 overflow-hidden">
                <span class="over-layer">
                </span>
                <img src="{{ helper::image_path(@$user->cover_image) }}" alt="">
            </div>
            <div class="card-body pt-3 p-0">
                <p class="hotel-subtitle text-muted fs-7 mb-2">
                    {{ $user->footer_description }}
                </p>
                <h3 class="fs-6 post-title text-capitalize fw-600 line-2 m-0">
                    {{ @$user->web_title }}
                </h3>
            </div>
        </div>
        {{-- <div class="card overflow-hidden rounded-0 view-all-hover h-100 rounded-2">
            <img src="{{ helper::image_path($user->cover_image) }}"
                class="card-img-top rounded-0 object-fit-cover img-fluid object-fit-cover"
                height="185" alt="...">
            <div class="card-body p-sm-3 p-2">
                <h6 class="card-title fs-15 fw-600 hotel-title">{{ $user->web_title }}</h6>
                <p class="hotel-subtitle text-muted fs-8">
                    {{ $user->footer_description }}
                </p>
            </div>
        </div> --}}
    </a>
</div>
@endforeach