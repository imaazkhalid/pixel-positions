<x-layout>
    <x-page-heading>New Job</x-page-heading>

    <x-forms.form method="Post" action="/jobs">
        <x-forms.input label="Title" name="title" placeholder="CEO" maxlength="100"/>
        <x-forms.input label="Salary" name="salary" placeholder="$90,000 USD" maxlength="50"/>
        <x-forms.input label="Location" name="location" placeholder="Winter Park, Florida"/>

        <x-forms.select label="Schedule" name="schedule">
            <option>Part Time</option>
            <option>Full Time</option>
            <option>Temporary</option>
        </x-forms.select>

        <x-forms.input label="URL" name="url" placeholder="https://acme.com/jobs/ceo-wanted"/>
        <x-forms.checkbox label="Feature (Costs Extra)" name="featured"/>

        <x-forms.divider/>

        <x-forms.input label="Tags (comma separated, max 3 tags)" name="tags" placeholder="laracasts, video, education" maxlength="50"/>

        <x-forms.button>Publish</x-forms.button>
    </x-forms.form>
</x-layout>
