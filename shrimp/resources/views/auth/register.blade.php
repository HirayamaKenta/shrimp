<x-top-layout>
  <x-auth-card>
    <x-slot name="logo">
      <a href="/">
        <x-application-logo class="w-20 h-20 fill-current
                text-gray-500" />
      </a>
    </x-slot>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
      @csrf

      <!-- Name -->
      <div>
        <x-input-label for="name" :value="__('Name')" />

        <x-text-input id="name" class="block mt-1 w-full"
        type="text" name="name" :value="old('name')" required
          autofocus />
      </div>

      <!-- Email Address -->
      <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />

        <x-text-input id="email" class="block mt-1 w-full"
        type="email" name="email" :value="old('email')" required />
      </div>

<!-- Avatar -->
<div class="mt-4">
  <x-label for="avatar" :value="__('プロフィール画像（任意・1MBまで）')" />

  <x-input id="avatar" class="block mt-1 w-full rounded-none" type="file" name="avatar" :value="old('avatar')" />
</div>




      <!-- Password -->
      <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />

        <x-text-input id="password" class="block mt-1 w-full"
        type="password" name="password" required
          autocomplete="new-password" />
      </div>

      <!-- Confirm Password -->
      <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

        <x-text-input id="password_confirmation"
        class="block mt-1 w-full" type="password"
        name="password_confirmation"
          required />
      </div>

{{-- ↓追加分passcodeの確認 --}}
<div class="mt-4">
  <x-input-label for="passcode" :value="__('passcode')" />

  <x-text-input id="passcode" class="block mt-1 w-full" type="password" name="passcode"
  required/>
</div>
{{-- ↑追加分passcodeの確認 --}}


      <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600
        hover:text-gray-900" href="{{ route('login') }}">
          {{ __('Already registered?') }}
        </a>

        <x-button class="ml-4 btnsetg">
          {{ __('Register') }}
        </x-button>
      </div>
    </form>
  </x-auth-card>
</x-top-layout>
