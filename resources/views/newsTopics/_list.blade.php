<div class="container">

    @forelse($newsTopics as $newsTopic)
        @include('newsTopics._item')
    @empty

    @component('components.empty-model')
        There are no news topics
    @endcomponent

    @endforelse
</div>