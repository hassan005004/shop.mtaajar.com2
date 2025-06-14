@if (helper::appdata($vendordata->id)->product_ratting_switch == 1)
    <div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
        <div class="row gy-4 gy-md-5 g-4 g-xxl-5">
            <div class="col-md-12 col-lg-5 col-xxl-7 order-2 order-md-1">
                @if (count($review) > 0)
                    @foreach ($review as $review)
                        <!-- review and rating -->
                        <div class="d-md-flex my-4 border-sm-bottom">
                            <!-- review avatar -->
                            <div class="avatar avatar-lg me-md-3 mb-3 flex-shrink-0">
                                <img class="avatar-img rounded-circle"
                                    src="{{ helper::image_path($review->image) }}" alt="avatar">
                            </div>
                            <!-- review avatar -->

                            <!-- review-content -->
                            <div class="review-content w-100">
                                <div class="d-flex justify-content-between mb-2">
                                    <div>
                                        <h6 class="me-3 mb-0 fw-bold text-dark text-truncate">
                                            {{ $review->name }}
                                        </h6>
                                        <!-- Info -->
                                        <p class="text-muted fs-7 text-truncate">
                                            {{ helper::date_formate($review->created_at, $vendordata->id) }}
                                        </p>
                                    </div>
                                    <!-- Review star -->
                                    <p class="icon-md fw-500 d-flex px-2 fs-7">
                                        <i class="fas fa-star fa-fw text-warning me-2"></i>
                                        {{ number_format($review->star, 1) }}
                                    </p>
                                </div>

                                <p class="mb-3 text-muted fs-7 fw-normal line-2">
                                    {{ $review->description }}
                                </p>
                            </div>
                            <!-- review-content -->
                        </div>
                    @endforeach
                @else
                    @include('web.nodata')
                @endif
            </div>

            <div class="col-md-12 col-lg-7 col-xxl-5">
                <div class="card-body pt-4 p-0 sticky">
                    <!-- Customer Review -->
                    <h4 class="heading mb-3 fw-600 text-dark text-truncate">
                        {{ trans('labels.customer_review') }}
                    </h4>
                    <div class="card border-0 bg-light p-4 mb-4">
                        <div class="row g-4 align-items-center">
                            <!-- Rating info -->
                            <div class="col-xl-3 col-md-4">
                                <div class="text-center">
                                    <!-- Info -->
                                    <h2 class="mb-0 fw-bold text-dark">
                                        {{ number_format($averagerating, 1) }}</h2>
                                    <p class="mb-2 fs-15 text-muted">{{ trans('labels.based_on') }}
                                        {{ $totalreview }} {{ trans('labels.reviews') }}</p>
                                    <!-- Star -->
                                    @php
                                        $exploderatting = explode(
                                            '.',
                                            number_format($averagerating, 1),
                                        );
                                        $count = 5;
                                    @endphp
                                    <ul class="list-inline mb-0">
                                        @for ($i = 0; $i < $exploderatting[0]; $i++)
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fa-solid fa-star text-warning"></i>
                                            </li>
                                            @php
                                                $count--;
                                            @endphp
                                            @if ($i == $exploderatting[0] - 1)
                                                @if ($exploderatting[1] != 0)
                                                    <li class="list-inline-item me-0"><i
                                                            class="fa-solid fa-star-half-alt text-warning"></i>
                                                    </li>
                                                    @php
                                                        $count--;
                                                    @endphp
                                                @endif
                                            @endif
                                        @endfor
                                        @for ($i = 0; $i < $count; $i++)
                                            <li class="list-inline-item me-0 small"><i
                                                    class="fa-regular fa-star text-warning"></i>
                                            </li>
                                        @endfor
                                    </ul>
                                </div>
                            </div>

                            <!-- Progress-bar START -->
                            <div class="col-xl-9 col-md-8">
                                <div class="card-body p-0">
                                    <div class="row gx-3 g-2 align-items-center">
                                        <!-- Progress bar and Rating -->
                                        <div class="col-9 col-sm-10">
                                            <!-- Progress item -->
                                            <div class="progress progress-sm bg-warning bg-opacity-15">
                                                <div class="progress-bar bg-warning"
                                                    role="progressbar"
                                                    style="width: {{ $fivestaraverage }}%"
                                                    aria-valuenow="{{ $fivestaraverage }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Percentage -->
                                        <div class="col-3 col-sm-2 text-end">
                                            <span
                                                class="h6 fw-semibold mb-0 text-dark">{{ number_format($fivestaraverage, 1) }}%</span>
                                        </div>

                                        <!-- Progress bar and Rating -->
                                        <div class="col-9 col-sm-10">
                                            <!-- Progress item -->
                                            <div class="progress progress-sm bg-warning bg-opacity-15">
                                                <div class="progress-bar bg-warning"
                                                    role="progressbar"
                                                    style="width: {{ $fourstaraverage }}%"
                                                    aria-valuenow="{{ $fourstaraverage }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Percentage -->
                                        <div class="col-3 col-sm-2 text-end">
                                            <span
                                                class="h6 fw-semibold mb-0 text-dark">{{ number_format($fourstaraverage, 1) }}%</span>
                                        </div>

                                        <!-- Progress bar and Rating -->
                                        <div class="col-9 col-sm-10">
                                            <!-- Progress item -->
                                            <div class="progress progress-sm bg-warning bg-opacity-15">
                                                <div class="progress-bar bg-warning"
                                                    role="progressbar"
                                                    style="width: {{ $threestaraverage }}%"
                                                    aria-valuenow="{{ $threestaraverage }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Percentage -->
                                        <div class="col-3 col-sm-2 text-end">
                                            <span
                                                class="h6 fw-semibold mb-0 text-dark">{{ number_format($threestaraverage, 1) }}%</span>
                                        </div>

                                        <!-- Progress bar and Rating -->
                                        <div class="col-9 col-sm-10">
                                            <!-- Progress item -->
                                            <div class="progress progress-sm bg-warning bg-opacity-15">
                                                <div class="progress-bar bg-warning"
                                                    role="progressbar"
                                                    style="width: {{ $twostaraverage }}%"
                                                    aria-valuenow="{{ $twostaraverage }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Percentage -->
                                        <div class="col-3 col-sm-2 text-end">
                                            <span
                                                class="h6 fw-semibold mb-0 text-dark">{{ number_format($twostaraverage, 1) }}%</span>
                                        </div>

                                        <!-- Progress bar and Rating -->
                                        <div class="col-9 col-sm-10">
                                            <!-- Progress item -->
                                            <div class="progress progress-sm bg-warning bg-opacity-15">
                                                <div class="progress-bar bg-warning"
                                                    role="progressbar"
                                                    style="width: {{ $onestaraverage }}%"
                                                    aria-valuenow="{{ $onestaraverage }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Percentage -->
                                        <div class="col-3 col-sm-2 text-end">
                                            <span
                                                class="h6 fw-semibold mb-0 text-dark">{{ number_format($onestaraverage, 1) }}%</span>
                                        </div>
                                    </div> <!-- Row END -->
                                </div>
                            </div>
                            <!-- Progress-bar END -->
                        </div>
                    </div>
                    <!-- Customer Review -->
                    <!-- comment section -->
                    @if (@helper::checkaddons('customer_login'))
                        @if (helper::appdata($vendordata->id)->checkout_login_required == 1)
                            <form class="pb-5"
                                action="{{ URL::to($vendordata->slug . '/postreview') }}"
                                method="POST">
                                @csrf
                                <!-- rating option -->
                                <div class="rating mb-3">
                                    <input type="hidden" name="product_id" id="product_id"
                                        value="{{ $productdata->id }}">
                                    <select class="form-select border-0 bg-light py-2 px-3"
                                        name="ratting" aria-label="Default select example">
                                        <option selected="" value="5">★★★★★ (5/5)</option>
                                        <option value="4">★★★★☆ (4/5)</option>
                                        <option value="3">★★★☆☆ (3/5)</option>
                                        <option value="2">★★☆☆☆ (2/5)</option>
                                        <option value="1">★☆☆☆☆ (1/5)</option>
                                    </select>
                                </div>
                                <!-- rating option -->
                                <div class="form-control bg-light mb-3 border-0">
                                    <textarea class="form-control border-0 bg-light p-0" id="exampleFormControlTextarea1" placeholder="Your review"
                                        rows="4" name="review" required></textarea>
                                </div>
                                <button type="submit"
                                    class="btn btn-fashion float-end">{{ trans('labels.post_review') }}</button>
                            </form>
                        @endif
                    @endif
                    <!-- comment section -->
                </div>
            </div>
        </div>
    </div>
@endif