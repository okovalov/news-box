<div class="container">
    @forelse($pairsList as $pair)
        <exchange-list-item
            pair="{{ $pair }}">
        </exchange-list-item>
    @empty

    @component('components.empty-model')
        There are no exchange info
    @endcomponent

    @endforelse
</div>