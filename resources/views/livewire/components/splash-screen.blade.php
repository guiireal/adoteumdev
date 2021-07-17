<div
    x-data="splash()"
    x-init="initSplash"
>
    <div
        x-ref="slideContainer"
        class="absolute top-0 left-0 transform duration-1000 flex flex-col items-center justify-center min-h-screen w-full bg-gradient-to-tr from-primary-100 to-secondary-100">
        <div class="flex flex-col items-center justify-center space-y-2">
            <img class="w-10 h-15" src="{{asset('assets/logo-adote-um-dev-white.svg')}}" alt="Logo">
            <span class="text-white font-bold">AdoteUm.dev</span>
        </div>
    </div>
    <div class="flex flex-col items-center justify-center min-h-screen w-full">
        <img x-ref='logo' class="w-14 h-14 transform scale-0 duration-1000"
             src="{{asset('assets/logo-adote-um-dev.svg')}}" alt="Logo">
        <span x-ref="textLogo"
              class="text-primary-100 font-bold mt-10 transform scale-0 duration-1000">AdoteUm.Dev</span>
    </div>
</div>

<script>
    function splash() {
        return {
            initSplash() {
                document.body.classList.add("overflow-hidden");
                this.animate(this.$refs.slideContainer,
                    ["left-full", "skew-x-12"],
                    "add",
                    1000,
                    () => this.animate(this.$refs.slideContainer,
                        ["skew-x-12"],
                        "remove",
                        400,
                        () => this.animate(this.$refs.logo,
                            ["scale-150"],
                            "add",
                            500,
                            () => this.animate(this.$refs.textLogo,
                                ["scale-100"],
                                "add",
                                500,
                                () => setTimeout(() => window.location.href = "/home", 2000),
                            ),
                        ),
                    ));
            },
            animate(element, classList, type, time, callback) {
                setTimeout(() => {
                    if (type === "add") {
                        element.classList.add(...classList);

                    } else {
                        element.classList.remove(...classList);
                    }
                    if (callback) {
                        callback();
                    }
                }, time || 1000);
            },
        };
    }
</script>

