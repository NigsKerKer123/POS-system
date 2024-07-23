@php
    $logoUrl = isset($custom["logo_pic"]) && $custom["logo_pic"] !== null
        ? asset('images/' . $custom["logo_pic"])
        : asset('images/logo.png');
    $companyName = isset($custom["company_name"]) && $custom["company_name"] !== null
        ? $custom["company_name"]
        : 'JavaVibe';
@endphp

@if($custom["color"] == "1")
<nav class="fixed top-0 z-50 w-full bg-[#C39898] border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
@elseif($custom["color"] == "2")
<nav class="fixed top-0 z-50 w-full bg-green-500 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
@elseif($custom["color"] == "3")
<nav class="fixed top-0 z-50 w-full bg-blue-500 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
@endif

  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">

        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>

        <a href="{{route('products.index')}}" class="flex ms-2 md:me-5">
        
        <!-- dynamic logo ni -->
        <img src="{{ $logoUrl }}" class="h-8 me-3" alt="JavaVibe Logo" style="width: 50px; height:50px;"/>

        <!-- dynamic company name sad ni -->
        <span class="self-center text-xl font-bold sm:text-2xl whitespace-nowrap dark:text-white">
            {{ $companyName }}
        </span>
        
        </a>
      </div>

      <div class="flex items-center">
          <div class="flex items-center ms-3">
            <div>
              <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="{{asset('images/man.png')}}" alt="user photo" style="width: 50px; height:50px;">
              </button>
            </div>
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
              <div class="px-4 py-3" role="none">
                <p class="text-sm text-gray-900 dark:text-white" role="none">
                  {{$user->name}}
                </p>
                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                  {{$user->email}}
                </p>
              </div>
              <ul class="py-1" role="none">
                <li>
                  <a href="{{route('settings.index')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Settings</a>
                </li>
                <li class="flex items-center">
                  <form action="{{route('logout.admin')}}" method="GET">
                    <button type="submit" class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sign out</button>
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </div>
    </div>
  </div>
</nav>