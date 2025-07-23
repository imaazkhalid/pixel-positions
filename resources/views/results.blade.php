<x-layout>
    <div class="space-y-10">
        <section class="text-center pt-6">
            <x-page-heading>Let's Find Your Next Job</x-page-heading>

            <x-forms.form action="/search" class="mt-6">
                <x-forms.input :label="false" name="q" placeholder="I'm looking for..."/>
            </x-forms.form>
        </section>

        <section class="pt-10">
            <x-section-heading>Results</x-section-heading>

            <div class="mt-6 space-y-6">
                @foreach($jobs as $job)
                    <x-job-card-wide :$job/>
                @endforeach
            </div>
        </section>
    </div>
</x-layout>
