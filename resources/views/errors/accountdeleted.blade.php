<!doctype html>
<title>Store Not Available</title>
<style>
    body {
        font: 20px Helvetica, sans-serif;
        background-color: rgba(26, 32, 44, 1);
        text-align: center;
        margin: 0;
    }

    article {
        display: flex;
        text-align: center;
        align-items: center;
        width: 650px;
        margin: 0 auto;
        height: 100vh;
    }

    article h1 {
        font-size: 30px;
        margin: 0;
    }

    article h1,
    article p {
        color: #a0aec0;
    }

    article img {
        height: 600px;
    }

    .line-2 {
        text-overflow: ellipsis;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .w-100 {
        width: 100%;
    }

    .object-fit-cover {
        object-fit: cover;
    }
</style>
<article>
    <div>
        <img src="{{ helper::image_path(helper::appdata('')->store_unavailable_image)}}" class="w-100 object-fit-cover" alt="">
        <h1 class="line-2">{{ trans('messages.store_close') }}</h1>
    </div>
</article>