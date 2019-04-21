<div class="container">
    @forelse($locationList as $location)
        <weather-list-item
            location="{{ $location }}">
        </weather-list-item>
    @empty

    @component('components.empty-model')
        There are no weather info
    @endcomponent

    @endforelse
</div>