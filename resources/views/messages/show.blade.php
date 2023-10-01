<!-- resources/views/messages/show.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Trainer Message Detail') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800">
          <div class="mb-6">
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">LINEユーザーID</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200">
                {{ $messages->line_user_id }}
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">LINEメッセージ</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200">
                {{ $messages->value }}
              </p>
            </div>
           
             <div class="flex flex-col mb-4">
                <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">Created At</p>
                <p class="py-2 px-3 text-gray-800 dark:text-gray-200">
                    {{ $messages->created_at->format('Y-m-d H:i:s') }}
                </p>
            </div>
        
            
 

          <!-- Trainer Input Form -->
          <form action="{{ route('record.store') }}" method="post" class="mt-4" onsubmit="return validateForm()">
            @csrf
            <input type="hidden" name="line_user_id" value="{{ $messages->line_user_id }}">

           <!-- Other form elements -->


<div class="mb-3">
    <label for="record_date" class="block text-sm font-medium text-gray-700">Record Date:</label>
    <input type="date" name="record_date" id="record_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
</div>
  <!-- Time of Day Select -->
    <div class="mb-3">
        <label for="time_of_day" class="block text-sm font-medium text-gray-700">Time of Day:</label>
        <select name="time_of_day" id="time_of_day" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            <option value="morning">Morning</option>
            <option value="afternoon">Afternoon</option>
            <option value="evening">Evening</option>
        </select>
        @error('time_of_day')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
    </div>
    
 <!-- Content Textarea -->
    <div class="mb-3">
        <label for="content" class="block text-sm font-medium text-gray-700">Enter Message:</label>
        <textarea name="content" id="content" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
        @error('content')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
    </div>

<!-- Other form elements -->
            <!-- Nutrients Input Section -->
                        <div class="mb-3">
              <label for="protein" class="block text-sm font-medium text-gray-700">Protein:</label>
              <input type="number" name="protein" id="protein" value="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" step="any">
            </div>
            <div class="mb-3">
              <label for="lipid" class="block text-sm font-medium text-gray-700">Lipid:</label>
              <input type="number" name="lipid" id="lipid" value="0"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" step="any">
            </div>
            <div class="mb-3">
              <label for="carbohydrate" class="block text-sm font-medium text-gray-700">Carbohydrate:</label>
              <input type="number" name="carbohydrate" id="carbohydrate"  value="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" step="any">
            </div>
            <div class="mb-3">
              <label for="vitamin" class="block text-sm font-medium text-gray-700">Vitamin:</label>
              <input type="number" name="vitamin" id="vitamin"  value="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" step="any">
            </div>
            <div class="mb-3">
              <label for="mineral" class="block text-sm font-medium text-gray-700">Mineral:</label>
              <input type="number" name="mineral" id="mineral"  value="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" step="any">
            </div>


            <!-- Message Input -->
        

            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Submit
            </button>
          </form>



          <div class="flex items-center justify-end mt-4">
            <a href="{{ url()->previous() }}">
              <x-secondary-button class="ml-3">
                {{ __('Back') }}
              </x-secondary-button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
  <script>
  function validateForm() {
      const recordDate = document.getElementById('record_date').value;
      const timeOfDay = document.getElementById('time_of_day').value;

      if (!recordDate || !timeOfDay) {
          alert('空欄があります');
          return false;
      }
      return true;
  }
</script>

  
</x-app-layout>