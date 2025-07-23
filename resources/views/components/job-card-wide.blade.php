@props(['job'])

<x-panel class="flex gap-x-6 items-center">
    <div>
        <x-employer-logo :employer="$job->employer"/>
    </div>

    <div class="flex-1 flex flex-col min-w-0">
        <div class="self-start text-sm text-gray-400 break-words">{{ $job->employer->name }}</div>

        <h3 class="font-bold text-xl mt-3 group-hover:text-blue-600 transition-colors duration-300 break-words">
            <a href="{{ $job->url }}" target="_blank">
                {{ $job->title }}
            </a>
        </h3>

        <p class="text-sm text-gray-400 mt-auto break-words">{{ $job->salary }}</p>
    </div>

    <div class="flex items-center flex-wrap gap-1 self-start">
        @foreach($job->tags as $tag)
            <x-tag :$tag/>
        @endforeach
    </div>
</x-panel>
