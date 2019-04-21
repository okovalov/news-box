<div>
    <div>

        <p>
            <strong>{{ $newsTopic->author }}</strong><br>
        </p>
        <p>
            {{ $newsTopic->title }}
        </p>
        <p>
            {{ $newsTopic->description }}
        </p>

        <p>
            <a href="{{ $newsTopic->description }}">Link</a>
        </p>
        <p>
            {{ $newsTopic->content }}
        </p>
    </div>
</div>