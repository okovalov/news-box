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
        <p>{{ $newsTopic->published_at->toFormattedDateString() }}</p>
    </div>
</div>