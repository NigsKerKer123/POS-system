<div class="p-4 sm:ml-64">
      <div class="mb-[4.5rem]"></div>
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                  <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
                        <tr> 
                              <th scope="col" class="px-6 py-3" colspan="2">
                                    Sales (Under Development!!)
                              </th>
                        </tr>
                  </thead>

                  <thead class="text-md font-mono text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400" style="height: 4rem;">
                        <tr>
                        <th scope="col" class="px-6 py-3">
                              Product ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                              Name
                        </th>

                        <th scope="col" class="px-6 py-3">
                              Category
                        </th>

                        <th scope="col" class="px-6 py-3">
                              Price
                        </th>
                        
                        <th scope="col" class="px-6 py-3 text-center">
                              Action
                        </th>
                        </tr>
                  </thead>

                  <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    adsf
                              </th>
                              <td class="px-6 py-4">
                                    afd
                              </td>
                              <td class="px-6 py-4">
                                    acbtre
                              </td>
                              <td class="px-6 py-4">
                                    acwrtg
                              </td>

                              <td class="px-6 py-4 text-center flex justify-center">
                              </td>
                        </tr>
                  </tbody>
            </table>
            <div class="p-3">
                  {{$sales->links('pagination::tailwind')}}
            </div>
      </div>
</div>