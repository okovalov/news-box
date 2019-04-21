<div>
    <div>

        <p>
            <strong>{{ $weather->location }}</strong><br>
        </p>
        <p>
            {{ $weather->title }}
        </p>
        <p>
            {{ $weather->type }}
        </p>

        <p>
            {{ $weather->description }}
        </p>
        <p>{{ $weather->created_at->toFormattedDateString() }}</p>

        <div>

        </div>
    </div>
</div>