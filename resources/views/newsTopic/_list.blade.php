<div class="container">

    @forelse($newsTopics as $newsItem)
        <news-topic-list
            news="{{ $newsItem }}">
        </news-topic-list>
    @empty

    @component('components.empty-model')
        There are no news
    @endcomponent

    @endforelse

</div>