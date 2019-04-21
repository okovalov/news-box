<div class="container">

    @forelse($newsTopics as $newsTopic)
        @include('newsTopic._item')
    @empty

    @component('components.empty-model')
        There are no news topics
    @endcomponent

    @endforelse
</div>