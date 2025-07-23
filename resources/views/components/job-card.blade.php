@props(['job'])

<x-panel class="flex flex-col text-center">
    <div class="self-start text-sm break-words">{{ $job->employer->name }}</div>

    <div class="py-8">
        <h3 class="font-bold text-xl max-w-9/12 mx-auto group-hover:text-blue-600 transition-colors duration-300 break-words">
            <a href="{{ $job->url }}" target="_blank">
                {{ $job->title }}
            </a>
        </h3>

        <p class="text-sm mt-4 break-words">{{ $job->salary }}</p>
    </div>

    <div class="flex justify-between items-center mt-auto gap-1">
        <div class="flex items-center flex-wrap gap-1">
            @foreach($job->tags as $tag)
                <x-tag :$tag size="small"/>
            @endforeach
        </div>

        <x-employer-logo :width="42" :employer="$job->employer"/>
    </div>
</x-panel>
