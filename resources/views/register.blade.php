<!DOCTYPE html>
<html lang="en"">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Javavibe: Register</title>
        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon" style="border-radius: 50%;">
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    
    <body>
        <div class="min-w-screen min-h-screen flex items-center justify-center px-5 py-5">
            <div class="bg-gray-100 text-gray-500 rounded-3xl shadow-xl w-full overflow-hidden" style="max-width:1000px">
                <div class="md:flex w-full">
                    <div class="hidden md:block w-1/2 bg-indigo-500">
                        <img src="{{asset('images/register.jpg')}}" alt="img" class="w-full h-full object-cover">
                    </div>
                    <div class="w-full md:w-1/2 py-10 px-5 md:px-10">
                        <div class="text-center mb-10">
                            <h1 class="font-bold text-3xl text-gray-900">REGISTER</h1>
                            <p>Enter your information to register</p>
                        </div>

                        <!-- form here -->
                        <form action="{{route('registerTenant')}}" method="POST">
                        @csrf
                        <div>
                            <div class="flex -mx-3" >
                                <div class="w-full px-3 mb-5">
                                    <label for="" class="text-xs font-semibold px-1">Tenant Name</label>
                                    <div class="flex">
                                        <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-lock-outline text-gray-400 text-lg"></i></div>
                                        <input name="name" type="text" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="Degrees" required>
                                    </div>
                                </div>
                            </div>

                            <div class="flex -mx-3">
                                <div class="w-full px-3 mb-5">
                                    <label for="" class="text-xs font-semibold px-1">Email</label>
                                    <div class="flex">
                                        <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                                        <input name="email" type="email" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="degrees@example.com" required>
                                    </div>
                                </div>
                            </div>

                            <div class="flex -mx-3" >
                                <div class="w-full px-3 mb-5">
                                    <label for="" class="text-xs font-semibold px-1">Sub domain</label>
                                    <div class="flex">
                                        <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-lock-outline text-gray-400 text-lg"></i></div>
                                        <input name="subdomain" type="text" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="degrees">
                                    </div>
                                </div>
                            </div>

                            <div class="flex -mx-3" >
                                <div class="w-full px-3 mb-5">
                                    <label for="" class="text-xs font-semibold px-1">Subcription</label>
                                    <div class="flex">
                                        <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-lock-outline text-gray-400 text-lg"></i></div>

                                        <select name="subscription" id="countries" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500">
                                            <option selected>Select subscription type</option>
                                            <option value="1">Free</option>
                                            <option value="2">Premium</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="flex -mx-3">
                                <div class="w-full px-3 mb-5">
                                    <button type="submit" class="block w-full bg-[#A67B5B] hover:bg-[#6F4E37] max-w-xs mx-auto text-white rounded-lg px-3 py-3 font-semibold">REGISTER NOW</button>
                                </div>
                            </div>
                        </div>
                        </form>

                        <div class="mt-4 flex items-center justify-between">
                            <span class="border-b w-1/5 md:w-1/4"></span>
                            <a href="{{route('login')}}" class="text-xs text-gray-500 uppercase">or login</a>
                            <span class="border-b w-1/5 md:w-1/4"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

@if(Session::has('success'))
    <script>
        alert("{{ Session::get('success') }}");
    </script>
@endif

@if(Session::has('error'))
    <script>
        alert("{{ Session::get('error') }}");
    </script>
@endif

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');

        function validatePasswordConfirmation() {
            if (passwordInput.value !== confirmPasswordInput.value) {
                confirmPasswordInput.setCustomValidity("Passwords do not match");
            } else {
                confirmPasswordInput.setCustomValidity("");
            }
        }

        passwordInput.addEventListener("change", validatePasswordConfirmation);
        confirmPasswordInput.addEventListener("input", validatePasswordConfirmation);
    });
</script>