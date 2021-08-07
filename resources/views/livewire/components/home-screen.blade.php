<div>
    <div
        class="flex flex-col items-center justify-center w-full min-h-screen bg-gradient-to-tr from-primary-100 to-secondary-100"
    >
        <div class="flex flex-col items-center justify-end flex-1 px-10 text-2xl">

            <div class="flex flex-row items-center justify-center p-4 mb-24 space-x-2 text-2xl">
                <img class="w-14 h-14" src="{{ asset('assets/logo-adote-um-dev-white.svg') }}" alt="Logo" />
                <span class="font-bold text-white">AdoteUm.Dev</span>
            </div>

            <p class="text-xs text-center text-white">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa dolor dolorem,
                dolorum eius enim facilis illum magnam mollitia neque nisi optio porro quibusdam
                quis reiciendis soluta suscipit temporibus vero vitae!
            </p>

            <button wire:click="loginWithGoogle" class="flex flex-row items-center justify-center w-full p-4 mt-8 space-x-2 text-sm font-bold duration-150 transform bg-white rounded-full text-grey-100 active:scale-95">
                <img src="{{ asset('assets/logo-google.png') }}" height="15" width="15" />
                <span>Entrar como Recrutador</span>
            </button>

            <button wire:click="loginWithGithub"
                class="flex flex-row items-center justify-center w-full p-4 mt-4 mb-8 space-x-2 text-sm font-bold text-white duration-150 transform border-2 border-white border-solid rounded-full active:scale-95"
            >
                <img src="{{ asset('assets/logo-github.svg') }}" height="15" width="15" alt="Github Logo" />
                <span>Entrar como Dev</span>
            </button>
        </div>
    </div>
</div>
