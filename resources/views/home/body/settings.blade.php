<div class="p-4 sm:ml-64">
      <div class="mb-[4.5rem]"></div>
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="ml-[50px] w-full max-w-2xl p-4 bg-white sm:p-6 md:p-8 dark:bg-gray-800">

            <!-- form sa change pass -->
            <form class="space-y-6" action="{{route('settings.changePass')}}" method="POST">
                @method('PUT')
                @csrf
                <p class="text-[30px] font-medium text-gray-900 dark:text-white">Settings</p>
                <h5 class="text-lg font-medium text-gray-900 dark:text-white">Change password</h5>
                <div>
                    <label for="current_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current password</label>
                    <input type="password" name="current_password" id="current_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                </div>

                <div>
                    <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New password</label>
                    <input type="password" name="new_password" id="new_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                </div>

                <div>
                    <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                    <input type="password" id="confirm_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                </div>

                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Change password</button>
            </form>


            <!-- form sa customization -->
            <form class="space-y-6 mt-[3rem]" action="{{route('settings.customize')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <h5 class="text-lg font-medium text-gray-900 dark:text-white">Customization</h5>
                <div>
                    <label for="logo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Change Logo</label>
                    <input type="file" name="logo" id="logo"/>
                </div>

                <div>
                    <label for="company_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Change Company Name</label>
                    <input type="text" name="company_name" id="company_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"/>
                </div>

                <div class="flex flex-wrap">

                    <div class="w-full">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Change Theme Color</label>
                    </div>

                    <div class="flex items-center me-4">
                        <input id="default-radio" type="radio" value="1" name="color" class="w-4 h-4 text-[#C39898] bg-gray-100 border-gray-300 focus:ring-[#C39898] dark:focus:ring-[#C39898] dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Default</label>
                    </div>

                    <div class="flex items-center me-4">
                        <input id="green-radio" type="radio" value="2" name="color" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="green-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Green</label>
                    </div>
                    <div class="flex items-center me-4">
                        <input checked id="blue-radio" type="radio" value="3" name="color" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="blue-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">blue</label>
                    </div>
                </div>
                
                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Apply Customization</button>
            </form>
        </div>
      </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const newPasswordInput = document.getElementById('new_password');
        const confirmPasswordInput = document.getElementById('confirm_password');

        function validatePassword() {
            if (newPasswordInput.value !== confirmPasswordInput.value) {
                confirmPasswordInput.setCustomValidity("Passwords don't match");
            } else {
                confirmPasswordInput.setCustomValidity('');
            }
        }

        newPasswordInput.addEventListener('change', validatePassword);
        confirmPasswordInput.addEventListener('input', validatePassword);
    });
</script>