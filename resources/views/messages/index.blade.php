<!-- resources/views/tweet/index.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Message Index') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-grey-200 dark:border-gray-800">
          <table class="text-center w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">ID</th>
                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">Message</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($messages as $message)
              <tr class="hover:bg-gray-lighter">
                <td class="py-4 px-6 border-b border-gray-light dark:border-gray-600">{{$message->id}}</td>
                <td class="py-4 px-6 border-b border-gray-light dark:border-gray-600">
                    <a href="{{ route('message.show', $message->id) }}" class="text-blue-500 hover:underline">
                  <h3 class="text-left font-bold text-lg text-gray-dark dark:text-gray-200">{{$message->value}}</h3>
                    </a>
                  <div class="flex">
                    <!-- 更新ボタン -->
                    <!-- 削除ボタン -->
                            <form action="{{ route('message.destroy', $message->id) }}" method="POST" class="text-left" onsubmit="return confirm('本当に削除してもよろしいですか？');">
          @method('delete')
          @csrf
          <button type="submit" class="ml-3 text-red-500 hover:text-red-700">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="gray">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
          </button>
        </form>
                   
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
