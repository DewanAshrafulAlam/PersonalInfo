<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <style type="text/tailwindcss">
        @layer utilities {
          .container {
            @apply px-10 mx-auto;
          }
          .btn{
           @apply  bg-green-600 text-white rounded py-2 px-4
          }
        }
      </style>
      
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="flex justify-between my-5">
            <a href="{{ route('home') }}"
            class="fixed top-4 right-4 bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-600 transition">
            Back to Home
         </a>
         
        </div>
       
       <!-- Search Bar -->
<form method="GET" action="{{ route('search') }}" class="flex items-center mb-6 space-x-2">
    <input
        type="text"
        name="query"
        value="{{ request('query') }}"
        placeholder="Search posts..."
        class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600"
    />
    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-600">
        Search
    </button>
</form>

<!-- Show Search Results if there's a query -->
@if(isset($query))
    <h2 class="text-xl font-semibold mb-4">Results for "{{ $query }}"</h2>

    <ul class="space-y-2 mb-6">
        @forelse ($results as $result)
           
        @empty
            <li>No results found.</li>
        @endforelse
    </ul>
@endif

<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Designation</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mobile</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($results as $result)
            <tr class="odd:bg-white even:bg-gray-100">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $result->id }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $result->name  }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $result->designation }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $result->mobile }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $result->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                    <img src="{{ asset('images/' . $result->image) }}" width="80px" alt="">
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

    </div>
</body>
</html>