<div class="row g-3 theme_image">

    @foreach ($newpath as $path)
        <div class="col-6">

            <div class="theme-selection border cursor-pointer"><img src='{{ $path }}' alt="" class="w-100">

            </div>

        </div>
    @endforeach

</div>
