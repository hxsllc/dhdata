<x-guest-layout>
    <div class="pb-12 bg-white block w-full h-screen bg-cover bg-center"
         style="background-image: url('{{ asset('img/background.jpg') }}')">
        <div class="flex items-center text-center h-full justify-center">
            <div class="text-white">
                <h1 class="font-bold text-3xl my-4" style="font-family: Montserrat,serif;">METAscripta Data Manager</h1>
                <p class="leading-8 text-lg mx-auto max-w-3xl" style="font-family: Helvetica,sans-serif;">
                    This is an online research tool which allows any scholar or student to create their own private workspace to annotate and compare Vatican manuscripts. All annotations are private, attached to your user account. Once completed, you will be able to register or log in.
                </p>
                <div class="tempo-header-buttons center mt-8">
                    <a href="/login" title="Login form" class="tempo-btn btn-header btn-2 rounded-sm text-2xl">Log In</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
