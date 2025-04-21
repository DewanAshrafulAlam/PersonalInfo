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
      
    <title>Home</title>
</head>
<body>
    <div class="container">
        <div class="flex justify-between my-5">
        <h2 class="text-red-500 text-xl">Home</h2>
         <a href="/create" class="btn">Add New</a>

         @if(isset($query))
         <a href="{{ route('download.pdf', ['query' => $query]) }}"
         class="btn mb-4 inline-block">
          Download PDF
         </a>
         @endif

         <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn bg-red-600 hover:bg-red-700">Logout</button>
      </form>
        </div>
        <div class="w-full max-w-sm min-w-[200px]">
          <form method="GET" action="{{ route('search') }}" class="flex items-center space-x-2">
            <input
                type="text"
                name="query"
                placeholder="Search..."
                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600"
            />
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-600">
                Search
            </button>
        </form>
        
        </div>
        @if(session('success'))
         <h2 class="text-green-600" py-2 px-4>{{ session('success') }}</h2>  
        @endif
        <div class="">
          <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
              <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                  <table class="min-w-full divide-y divide-gray-200" border border-green-300 my-5>
                    <thead class="bg-green-600">
                      <tr>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-white uppercase">Id</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-white uppercase">Name</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-white uppercase">Designation</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-white uppercase">Mobile</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-white uppercase">Email</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-white uppercase">Image</th>
                        <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-white uppercase">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($posts as $post)
                        
                          <tr class="odd:bg-white even:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $post->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $post->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $post->designation}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $post->mobile}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $post->email}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"><img src="images/{{ $post->image}}" width="80px" alt=""></td>
                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                              <a href="{{ route('edit',$post->id) }}" class="btn">Edit</a>
                              <form method="post" action="{{ route('delete',$post->id) }} " class=inline>
                                @csrf
                                @method('delete')
                               <button class="bg-red-600 text-white rounded py-2 px-4" type="submit">Delete</button>
                            </td>

                              </form>
                          </tr>
                      @endforeach
                       
                    </tbody>
                  </table>
                  {{ $posts->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</body>
</html>