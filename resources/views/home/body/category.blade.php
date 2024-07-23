<div class="p-4 sm:ml-64">
      <div class="mb-[4.5rem]"></div>
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                  <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
                        <tr> 
                              <th scope="col" class="px-6 py-3" colspan="2">
                                    Category
                              </th>

                              <th scope="col" class="px-6 py-3" colspan="6" style="text-align: right;">
                                    <button data-modal-target="add-modal" data-modal-toggle="add-modal" type="button" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Add Category</button>
                              </th>
                        </tr>
                  </thead>

                  <thead class="text-md font-mono text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400" style="height: 4rem;">
                        <tr>
                        <th scope="col" class="px-6 py-3">
                              category id
                        </th>
                        <th scope="col" class="px-6 py-3">
                              Name
                        </th>
                        
                        <th scope="col" class="px-6 py-3 text-center">
                              Action
                        </th>
                        </tr>
                  </thead>

                  <tbody>
                        @foreach($category as $categoryData)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$categoryData->id}}
                              </th>

                              <td class="px-6 py-4">
                                    {{$categoryData->name}}
                              </td>

                              <td class="px-6 py-4 text-center flex justify-center">
                                    <button data-modal-target="edit-modal{{$categoryData->id}}" data-modal-toggle="edit-modal{{$categoryData->id}}" type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">edit</button>

                                    <button data-modal-target="delete-modal{{$categoryData->id}}" data-modal-toggle="delete-modal{{$categoryData->id}}" type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">delete</button>
                              </td>
                        </tr>
                        @endforeach
                  </tbody>
            </table>
            <div class="p-3">
                  {{$category->links('pagination::tailwind')}}
            </div>
      </div>
</div>