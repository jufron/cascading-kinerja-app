<x-guest-layout>
    {{-- <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form> --}}

    <div class="min-h-screen flex fle-col items-center justify-center">
        <div class="py-6 px-4">
            <div class="grid lg:grid-cols-2 items-center gap-6 max-w-6xl w-full">
                <div class="border border-slate-300 rounded-lg p-6 shadow-[0_2px_22px_-4px_rgba(93,96,127,0.2)]">
                    <form action="{{ route('register') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="mb-12">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-14 h-14 object-contain" />
                                <h1 class="text-slate-900 text-3xl font-semibold">Registrasi</h1>
                            </div>

                            <p class="text-slate-600 text-[15px] mt-6 leading-relaxed">
                                Sebelum Masuk Silahkan Registrasi dulu.
                            </p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            {{-- ? nip --}}
                            <div>
                                <label class="text-slate-900 text-sm font-medium mb-2 block">NIP</label>
                                <div class="relative flex items-center">
                                    <div class="w-full">
                                        <input 
                                            name="nip" 
                                            type="text"
                                            class="w-full text-sm text-slate-900 border @error('nip') border-red-500 bg-red-50 @else border-slate-300 @enderror pl-4 pr-10 py-3 rounded-lg outline-blue-600"
                                            placeholder="Masukan NIP" 
                                        />
                                        @error('nip')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- ? name --}}
                            <div>
                                <label class="text-slate-900 text-sm font-medium mb-2 block">Username</label>
                                <div class="relative flex items-center">
                                    <div class="w-full">
                                        <input 
                                            name="name" 
                                            type="text"
                                            class="w-full text-sm text-slate-900 border @error('name') border-red-500 bg-red-50 @else border-slate-300 @enderror pl-4 pr-10 py-3 rounded-lg outline-blue-600"
                                            placeholder="Masukan username" 
                                        />
                                        @error('name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            {{-- ? nama lengkap --}}
                            <div>
                                <label class="text-slate-900 text-sm font-medium mb-2 block">Nama Lengkap</label>
                                <div class="relative flex items-center">
                                    <div class="w-full">
                                        <input 
                                            name="nama_lengkap" 
                                            type="text"
                                            class="w-full text-sm text-slate-900 border @error('nama_lengkap') border-red-500 bg-red-50 @else border-slate-300 @enderror pl-4 pr-10 py-3 rounded-lg outline-blue-600"
                                            placeholder="Masukan Nama Lengkap" 
                                        />
                                        @error('nama_lengkap')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- ? email --}}
                            <div>
                                <label class="text-slate-900 text-sm font-medium mb-2 block">Email</label>
                                <div class="relative flex items-center">
                                    <div class="w-full">
                                        <input 
                                            name="email" 
                                            type="text"
                                            class="w-full text-sm text-slate-900 border @error('email') border-red-500 bg-red-50 @else border-slate-300 @enderror pl-4 pr-10 py-3 rounded-lg outline-blue-600"
                                            placeholder="Masukan Email" 
                                        />
                                        @error('email')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            {{-- ? password --}}
                            <div>
                                <label class="text-slate-900 text-sm font-medium mb-2 block">Password</label>
                                <div class="relative flex items-center">
                                    <div class="w-full">
                                        <input 
                                            name="password" 
                                            type="password"
                                            class="w-full text-sm text-slate-900 border @error('email') border-red-500 bg-red-50 @else border-slate-300 @enderror pl-4 pr-10 py-3 rounded-lg outline-blue-600"
                                            placeholder="Masukan password" 
                                        />
                                        @error('password')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- ? password confim --}}
                            <div>
                                <label class="text-slate-900 text-sm font-medium mb-2 block">Password Konfirmasi</label>
                                <div class="relative flex items-center">
                                    <div class="w-full">
                                        <input 
                                            name="password_confirmation" 
                                            type="password"
                                            class="w-full text-sm text-slate-900 border @error('password_confirmation') border-red-500 bg-red-50 @else border-slate-300 @enderror pl-4 pr-10 py-3 rounded-lg outline-blue-600"
                                            placeholder="Masukan password Konfirmasi" 
                                        />
                                        @error('password_confirmation')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ? jabatan_id --}}
                        <div>
                            <label class="text-slate-900 text-sm font-medium mb-2 block">
                                Jabatan
                            </label>

                            <div class="relative flex items-center">
                                <div class="w-full">
                                    <select 
                                        name="jabatan_id"
                                        class="w-full text-sm text-slate-900 border 
                                            @error('jabatan_id') border-red-500 bg-red-50 
                                            @else border-slate-300 
                                            @enderror 
                                            pl-4 pr-10 py-3 rounded-lg outline-blue-600 appearance-none"
                                    >
                                        <option value="">Pilih Jabatan</option>
                                        @foreach ($jabatan as $j)
                                            <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                                        @endforeach
                                    </select>

                                    @error('jabatan_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            {{-- ? bidang --}}
                            <div>
                                <label class="text-slate-900 text-sm font-medium mb-2 block">Bidang</label>
                                <div class="relative flex items-center">
                                    <div class="w-full">
                                        <input 
                                            name="bidang" 
                                            type="text"
                                            class="w-full text-sm text-slate-900 border @error('bidang') border-red-500 bg-red-50 @else border-slate-300 @enderror pl-4 pr-10 py-3 rounded-lg outline-blue-600"
                                            placeholder="Masukan Bidang" 
                                        />
                                        @error('bidang')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- ? pangkat_golongan --}}
                            <div>
                                <label class="text-slate-900 text-sm font-medium mb-2 block">Pangkat Golongan</label>
                                <div class="relative flex items-center">
                                    <div class="w-full">
                                        <input 
                                            name="pangkat_golongan" 
                                            type="text"
                                            class="w-full text-sm text-slate-900 border @error('pangkat_golongan') border-red-500 bg-red-50 @else border-slate-300 @enderror pl-4 pr-10 py-3 rounded-lg outline-blue-600"
                                            placeholder="Masukan Pangkat Golongan" 
                                        />
                                        @error('pangkat_golongan')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ? nomor telepon --}}
                        <div>
                            <label class="text-slate-900 text-sm font-medium mb-2 block">Nomor Telepon</label>
                            <div class="relative flex items-center">
                                <div class="w-full">
                                    <input 
                                        name="nomor_telepon" 
                                        type="text"
                                        class="w-full text-sm text-slate-900 border @error('nomor_telepon') border-red-500 bg-red-50 @else border-slate-300 @enderror pl-4 pr-10 py-3 rounded-lg outline-blue-600"
                                        placeholder="Masukan Nomor Telepon"
                                    />
                                    @error('nomor_telepon')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- <div class="flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember-me" type="checkbox"
                                    class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-slate-300 rounded" />
                                <label for="remember-me" class="ml-3 block text-sm text-slate-900">
                                    Remember me
                                </label>
                            </div>
                            <div class="text-sm">
                                <a href="jajvascript:void(0);" class="text-blue-600 hover:underline font-medium">
                                    Forgot your password?
                                </a>
                            </div>
                        </div> --}}

                        <div class="!mt-12">
                            <button type="submit" class="w-full shadow-xl py-2.5 px-4 text-[15px] font-medium tracking-wide rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none cursor-pointer">
                                Registrasi
                            </button>
                            <p class="text-sm !mt-6 text-center text-slate-600">Jika sudah Memiliki Akun silahkan<a
                                    href="{{ route('login') }}"
                                    class="text-blue-600 font-medium hover:underline ml-1 whitespace-nowrap">
                                    Login
                                </a>
                            </p>
                        </div>
                    </form>
                </div>

                <div class="max-lg:mt-8">
                    <img src="https://readymadeui.com/login-image.webp"
                        class="w-full aspect-[71/50] max-lg:w-4/5 mx-auto block object-cover" alt="login img" />
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
