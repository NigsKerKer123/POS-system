<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="{{route('products.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group" id="candidateBtn">
               <img src="{{asset('images/sidebar/product.png')}}" alt="product" style="width: 20%;">
               <span class="flex-1 ms-3 whitespace-nowrap">Products</span>
            </a>
         </li>

         <li>
            <a href="{{route('category.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group" id="candidateBtn">
               <img src="{{asset('images/sidebar/categories.png')}}" alt="category" style="width: 20%;">
               <span class="flex-1 ms-3 whitespace-nowrap">Products Category</span>
            </a>
         </li>

         <li>
            <a href="{{route('inventory.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group" id="candidateBtn">
               <img src="{{asset('images/sidebar/inventory.png')}}" alt="inventory" style="width: 20%;">
               <span class="flex-1 ms-3 whitespace-nowrap">Inventory</span>
            </a>
         </li>

         <li>
            <a href="{{route('sales.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group" id="candidateBtn">
               <img src="{{asset('images/sidebar/sales.png')}}" alt="sales" style="width: 20%;">
               <span class="flex-1 ms-3 whitespace-nowrap">Sales</span>
            </a>
         </li>

         <div class="flex justify-center p-2">
            <hr style="width:95%; height: 1px; border: none; background-color: gray;">
         </div>

         <li>
            <a href="{{route('settings.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group" id="castBtn">
               <img src="{{asset('images/sidebar/settings.png')}}" alt="settings" style="width: 20%;">
               <span class="flex-1 ms-3 whitespace-nowrap">Settings</span>
            </a>
         </li>

         <li>
            <a href="{{route('addUser.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group" id="castBtn">
               <img src="{{asset('images/sidebar/add-user.png')}}" alt="add user" style="width: 20%;">
               <span class="flex-1 ms-3 whitespace-nowrap">Add Users</span>
            </a>
         </li>

         @if($user["subscription"] == "1")
         <li>
            <button data-modal-target="upgrade-modal" data-modal-toggle="upgrade-modal" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group" id="castBtn">
               <img src="{{asset('images/sidebar/crown.png')}}" alt="premium" style="width: 20%;">
               <span class="flex-1 ms-3 whitespace-nowrap">Upgrade to premium</span>
            </button>
         </li>
         @endif

      </ul>
   </div>
</aside>

<div id="upgrade-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="upgrade-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>

            <form action="{{route('upgrade')}}" method="POST">
               @csrf
               <div class="p-4 md:p-5 text-center">
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Upgrade to premium?</h3>
                <button type="submit" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-200 via-red-300 to-yellow-200 group-hover:from-red-200 group-hover:via-red-300 group-hover:to-yellow-200 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400">
                  <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                  Upgrade
                  </span>
               </button>

                <button data-modal-hide="upgrade-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
               </div>
            </form>
            
        </div>
    </div>
</div>
