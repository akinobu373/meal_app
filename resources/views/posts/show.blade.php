
<x-app-layout>
    <div class="container lg:w-3/4 md:w-4/5 w-11/12 mx-auto my-8 px-8 py-4 bg-white shadow-md">

        <x-flash-message :message="session('notice')" />

        <x-validation-errors :messages='$errors' />

        <article class="mb-2">
            <h2 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl">
                {{ $post->title }}</h2>
            <h3>{{ $post->user->name }}</h3>
            <p class="text-sm mb-2 md:text-base font-normal text-gray-600">
                記事作成日:
                {{ $post->date_diff }}
            </p>
            <p class="text-sm mb-2 md:text-base font-normal text-gray-600">
                記事作成日:
                {{ $post->created_at }}
            </p>
            <img src="{{ $post->image_url }}" alt="" class="mb-4 mx-auto">
            <p class="text-gray-700 text-base break-words">{!! nl2br(e($post->body)) !!}</p>

                @if (Auth::check())
                @if ($like)
                <a href="{{ route('unlike', $post) }}"onclick="$(this).click(function(e){ return false });">
                    <x-action-button type="submit" color="pink" text="お気に入り削除" /><br>
                </a>
                <b>お気に入り数:</b>
                <b>{{ $post->likes->count() }}</b>
                @else

                <a href="{{ route('like', $post) }}"onclick="$(this).click(function(e){ return false });" class="btn btn-secondary btn-sm">
                    <x-action-button type="button" color="blue" text="お気に入り" /><br>
                </a>
                <b>お気に入り数:</b>
                <b>{{ $post->likes->count() }}</b>

                @endif
                @endif

            <div class="flex flex-row text-center my-4">
                @can('update', $post)
                <x-action-button type="button" onclick="location.href='{{ route('posts.edit', $post) }}'" color="green"
                    text="編集" class="w-20" />
                @endcan
                @can('delete', $post)
                <form action="{{ route('posts.destroy', $post) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <x-action-button type="submit" onclick="if(!confirm('本当に削除しますか？')){return false}" color="red"
                        text="削除" class="w-20" />
                </form>
                @endcan
            </div>
        </article>
    </div>

</x-app-layout>
